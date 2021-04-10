<?php ob_start(); ?>
<?php include 'includes/db.php'; ?>
<?php  

    session_start();
    if($_GET['admin'] != 1){
        header("location:../front/login.php");
    }
    if(!isset($_SESSION['ID'])){
        header("location:../front/login.php");
    }
    if(!isset($_GET['memberid'])){
        header("location:admindashboard.php?admin=1");
    }
?>
<?php
    
    $memberid = $_GET['memberid'];
    $fetch_information_query = "SELECT * FROM user_profile WHERE UserID = $memberid";
    $fetch_information = mysqli_query($connection , $fetch_information_query);
    $information = mysqli_fetch_assoc($fetch_information);
    
    $fetch_name_query = "SELECT * FROM users WHERE ID = $memberid";
    $fetch_name = mysqli_query($connection , $fetch_name_query);
    $names = mysqli_fetch_assoc($fetch_name);

?>
<!DOCTYPE html>
<html lang="en">
<head>

	<!-- meta tags -->
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">

	<!-- Title -->
	<title>Notes MarketPlace</title>
	
	<!-- Website Logo -->
    <link rel="shortcut icon" href="images/dashboard/favicon.ico">

	<!-- google fonts -->
	<link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <!-- font awesome css -->
    <link rel="stylesheet" href="css/fontawesome/css/font-awesome.min.css">   
    
    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

    <!-- custom css -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    
    <!-- responsive css -->
    <link rel="stylesheet" href="css/responsive.css">
    
    <style>
        
        table.dataTable thead th {
            padding: 2px 18px;
            border-bottom: none !important;
        }
        table.dataTable thead td{
            padding: 0px 0px;
            border-bottom: none !important;
        }

        table.dataTable.no-footer {
            border-bottom: 1px solid #dee2e6 !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background: none !important;
            background-color: #6255a5 !important;
            border-radius: 50% !important;
            color: white !important;
            font-family: "open sans", sans-serif;
            font-weight: 400;
            font-size: 16px;
            line-height: 20px;
        }

        .dataTables_wrapper .dataTables_paginate {
            display: table !important;
            width: 100% !important;
            text-align: center;
            margin-top: 10px !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: none;
            background-color: white;
            color: #333 !important;
            border-radius: 50%;
            border: 1px solid white;
            font-family: "open sans", sans-serif;
            font-weight: 400;
            font-size: 16px;
            line-height: 20px;
            outline: none;
        }

        .dataTables_wrapper .dataTables_info {
            display: none;
        }
        
        table.dataTable thead .sorting {
            background-image: none;
        }
        
        .left-table{
            width: 120% !important;
        }
        #maintable{
            width: 101% !important;
            margin-left: 7px;
        }
        h2{
            margin-left: 7px;
        }
    
    </style>

</head>
<body>
    
    <!--
	<!-- preloader -->
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    
    
    <!-- navigation -->
    <section id="nav-bar">
        <nav class="navbar navbar-expand-lg bottom-box-effect container-fluid">
            <a class="navbar-brand" href="index.html"><img src="images/user-profile/logo.png" alt="logo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"><i class="fa fa-bars" aria-hidden="true"></i></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="admindashboard.php?admin=1">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Notes
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="underreview.php?admin=1">Notes Under Review</a>
                                <a class="dropdown-item" href="publishednotes.php?admin=1">Published Notes</a>
                                <a class="dropdown-item" href="downloadednotes.php?admin=1">Downloaded Notes</a>
                                <a class="dropdown-item" href="rejectednotes.php?admin=1">Rejected Notes</a>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="members.php?admin=1">Members</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Reports
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="spam-reports.php?admin=1">Spam Reports</a>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Settings
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <?php 
                                    $fetch_role_query = "SELECT RoleID FROM users WHERE ID = ".$_SESSION['ID'];
                                    $fetch_role = mysqli_query($connection , $fetch_role_query);
                                    $role = mysqli_fetch_assoc($fetch_role);
                                    $check_role = $role['RoleID'];
                                    if($check_role == 1){
                                        echo '<a class="dropdown-item" href="managesystemconfiguration.php?admin=1">Manage System Configuration</a>
                                <a class="dropdown-item" href="manageadministrator.php?admin=1">Manage Administrator</a>
                                <a class="dropdown-item" href="managecategory.php?admin=1">Manage Category</a>
                                <a class="dropdown-item" href="managetype.php?admin=1">Manage Type</a>
                                <a class="dropdown-item" href="managecountry.php?admin=1">Manage Countries</a>';
                                    }else{
                                        echo '<a class="dropdown-item" href="managecategory.php?admin=1">Manage Category</a>
                                <a class="dropdown-item" href="managetype.php?admin=1">Manage Type</a>
                                <a class="dropdown-item" href="managecountry.php?admin=1">Manage Countries</a>';
                                    }
                                ?>
                                
                            </div>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <?php
                        
                            $fetch_image_path_query = "SELECT ProfilePicture FROM user_profile WHERE UserID = ".$_SESSION['ID'];
                            $fetch_image_path = mysqli_query($connection , $fetch_image_path_query);
                            $fetch_image_num = mysqli_num_rows($fetch_image_path);
                            if($fetch_image_num == 0 ){
                                $pp_file="images/note-details/close.png";
                            }else{
                                $image_path = mysqli_fetch_assoc($fetch_image_path);
                                $pp_file = "../upload/admin/".$_SESSION['ID']."/".$image_path['ProfilePicture'];
                            }
                        
                        ?>
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo $pp_file; ?>" alt="login image">
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="adminprofile.php?admin=1">Update Profile</a>
                                <a class="dropdown-item" href="change-admin.php?admin=1">Change Password</a>
                                <a class="dropdown-item dropdown-purple" href="logout.php">Logout</a>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="logout.php"><button type="button" class="btn btn-primary btn_login">Logout</button></a>
                    </li>
                </ul>
            </div>
        </nav>
    </section>
    
    <section class="member-details">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="member-details-heading">
                        <h2>Member Details</h2>
                    </div>
                </div>
                <div class="col-md-2 col-sm-12 member-info text-center">
                    <div class="member-image">
                        <?php
                            $profilepicpath = "../upload/".$memberid."/profile/".$information['ProfilePicture'];
                        ?>
                        <img src="<?php echo $profilepicpath; ?>" alt="member">
                    </div>
                </div>
                <div class="info-table col-md-4 col-sm-6">
                    <table class="table table-responsive table-borderless left-table">
                        <tr>
                            <td>First Name:</td>
                            <td class="purple-member-details"><?php echo $names['FirstName']; ?></td>
                        </tr>
                        <tr>
                            <td>Last Name:</td>
                            <td class="purple-member-details"><?php echo $names['LastName']; ?></td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td class="purple-member-details"><?php echo $names['EmailID']; ?></td>
                        </tr>
                        <tr>
                            <td>DOB:</td>
                            <td class="purple-member-details"><?php echo  $information['DOB']; ?></td>
                        </tr>
                        <tr>
                            <td>Phone Number:</td>
                            <td class="purple-member-details"><?php echo $information['CountryCode'].$information['PhoneNumber']; ?></td>
                        </tr>
                        <tr>
                            <td>College/University:</td>
                            <td class="purple-member-details"><?php echo $information['University']; ?></td>
                        </tr>
                    </table>
                </div>
                <div class="info-table col-md-4 col-sm-6">
                    <table class="table table-responsive right-table table-borderless">
                        <tr>
                            <td>Address 1:</td>
                            <td class="purple-member-details"><?php echo $information['AddressLine1']; ?></td>
                        </tr>
                        <tr>
                            <td>Address 2:</td>
                            <td class="purple-member-details"><?php echo $information['AddressLine2']; ?></td>
                        </tr>
                        <tr>
                            <td>City:</td>
                            <td class="purple-member-details"><?php echo $information['City']; ?></td>
                        </tr>
                        <tr>
                            <td>State:</td>
                            <td class="purple-member-details"><?php echo $information['State']; ?></td>
                        </tr>
                        <tr>
                            <td>Country:</td>
                            <td class="purple-member-details"><?php echo $information['Country']; ?></td>
                        </tr>
                        <tr>
                            <td>Zipcode:</td>
                            <td class="purple-member-details"><?php echo $information['ZipCode']; ?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-12">
                    <hr>
                </div>
            </div>
        </div>
    </section>
    
    <section class="members-table members-details-table">
        <div class="container table1">
            <div class="row">
                <div class="col-md-12 member-notes-table-heading">
                    <h2>Notes</h2>
                </div>
            </div>
            <div class="row table-data">
                <table id="maintable" class="table table-responsive">
                    <thead>
                        <tr class="table-heading text-center">
                            <th class="mnsrno" scope="col">SR NO.</th>
                            <th class="mnnotetitle" scope="col">NOTE TITLE</th>
                            <th class="mncategory" scope="col">CATEGORY</th>
                            <th class="mnstatus" scope="col">STATUS</th>
                            <th class="mndownloadednotes" scope="col">DOWNLOADED NOTES</th>
                            <th class="mntotalearnings" scope="col">TOTAL EARNINGS</th>
                            <th class="mndateadded" scope="col">DATE ADDED</th>
                            <th class="mnpublisheddate" scope="col">PUBLISHED DATE</th>
                            <th class="mndropdown" scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  
                    
                        $loginid = $_SESSION['ID'];
                        $fetch_notes_query = "SELECT seller_notes.ID AS noteid, seller_notes.Title AS notetitle,seller_notes.CreatedDate AS dateadded , seller_notes.PublishedDate AS publishdate , note_categories.Name AS notecategory,reference_data.Value AS notestatus FROM seller_notes INNER JOIN note_categories ON note_categories.ID = seller_notes.Category INNER JOIN reference_data on reference_data.ID = seller_notes.Status WHERE SellerID = $memberid AND seller_notes.IsActive = 1 AND seller_notes.Status IN (7,8,9,10) ORDER BY seller_notes.CreatedDate DESC";
                        $fetch_notes = mysqli_query($connection,$fetch_notes_query);
                        $i=1;

                        while ($notes = mysqli_fetch_array($fetch_notes)) {  
                            $noteid = $notes['noteid'];
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td class="purple-color" onclick="window.location.href='adminnotedetail.php?admin=1&noteid=<?php echo $noteid;?>'"><?php echo $notes['notetitle']; ?></td>
                            <td><?php echo $notes['notecategory']; ?></td>
                            <td><?php echo $notes['notestatus']; ?></td>
                            <td class="purple-color" onclick="window.location.href='downloadednotes.php?admin=1&noteid=<?php echo $noteid;?>'">
                                <?php
                            
                                    $fetch_download_count_query = "SELECT DISTINCT(Downloader) FROM downloads WHERE NoteID = $noteid";
                                    $fetch_download_count = mysqli_query($connection , $fetch_download_count_query);
                                    $download_count = mysqli_num_rows($fetch_download_count);
                                    echo $download_count;
                            
                                ?>
                            </td>
                            <td>
                                <?php
                            
                                    $fetch_earning_query = "SELECT DISTINCT(Downloader), PurchasedPrice FROM downloads WHERE NoteID = $noteid";
                                    $fetch_earning = mysqli_query($connection , $fetch_earning_query);
                                    $notetotalearning = 0 ;
                                    while($earning = mysqli_fetch_assoc($fetch_earning)){
                                        $notetotalearning += $earning['PurchasedPrice'];
                                    }
                                    echo $notetotalearning;
                            
                                ?>
                            </td>
                            <td><?php echo $notes['dateadded']; ?></td>
                            <td><?php if(empty($notes['publishdate'])){ echo "NA";}else{ echo $notes['publishdate']; }; ?></td>
                            <td class="dropdown">
                                <img class="dropdown-toggle" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="images/mydownloads/dots.png" alt="menu">
                                <div class="dropdown-menu" aria-labelledby="dLabel">
                                    <a class="dropdown-item" href="download.php?noteid=<?php echo $noteid; ?>">Download Notes</a>
                                </div>    
                            </td>
                        </tr>
                        <?php  
                            $i++;
                        };  
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    
    <!-- footer -->
    <section class="footer footer-admin">
        <div class="container-fluid">
            <hr>
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-6 text-right"><p>Version : 1.1.24</p></div>
                <div class="col-md-4 col-sm-4 col-xs-6"></div>
                <div class="col-md-4 col-sm-4 col-xs-6 text-right"><p>Copyright &#169; Tatvasoft All right reserved.</p></div>
            </div>
        </div>
    </section>
	<!-- footer ends -->
	
	<!-- jquery-->
    <script src="js/jquery.min.js"></script>

    <!-- bootstrap js -->
    <script src="js/bootstrap/popper.min.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>

    <!-- custom js -->
    <script src="js/script.js"></script>
    <script>
        $(document).ready(function() {
            var table1 = $('#maintable').DataTable({
                'sDom': '"top"i',
                'bInfo': true,
                "iDisplayLength": 5,
                language: {
                    paginate: {
                        next: '<img src="images/dashboard/right-arrow.png">',
                        previous: '<img src="images/dashboard/left-arrow.png">'
                    }
                }
            });

        });
    </script>


</body>
</html>