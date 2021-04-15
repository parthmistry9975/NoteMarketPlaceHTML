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
    
    <!-- data table css -->
    <style>

        table.dataTable thead th{
            padding: 10px 18px;
            border-bottom: none !important;
        }
        table.dataTable thead td{
/*            padding: 0px !important;*/
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
        
/*
        .members-table table{
            width: 100% !important;
            margin-left: 8px !important;
        }
*/
        #downloaded-table{
            width: 99% !important;
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
   
    <section class="members-table downloaded-table">
        <div class="container table1">
            <div class="row">
                <div class="data-table-intro col-md-12 col-sm-12 col-xs-12">Downloaded Notes</div>
                <div class="form-row search-download-part col-md-12 col-sm-12 col-xs-12 text-left">
                    <div class="form-group col-lg-2 col-md-2 col-sm-4 col-xs-6">
                        <label for="note">Note</label>
                        <select id="note" class="form-control">
                            <option value="">Select note</option>
                            <?php
                                $fetch_notename_query = "SELECT DISTINCT(downloads.NoteID), downloads.NoteTitle AS notetitle FROM downloads WHERE downloads.IsSellerHasAllowedDownload = 1";
                                $fetch_notename = mysqli_query($connection , $fetch_notename_query);
                                while($row = mysqli_fetch_assoc($fetch_notename)){
                                    echo "<option value='".$row['notetitle']."'>".$row['notetitle']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-4 col-xs-6">
                        <label for="seller">Seller</label>
                        <select id="seller" class="form-control">
                            <option value="">Select seller</option>
                            <?php
                                $fetch_sellername_query = "SELECT DISTINCT(users.ID),users.FirstName AS firstname , users.LastName AS lastname FROM downloads INNER JOIN users ON users.ID = downloads.Seller WHERE downloads.IsSellerHasAllowedDownload = 1";
                                $fetch_sellername = mysqli_query($connection , $fetch_sellername_query);
                                while($row = mysqli_fetch_assoc($fetch_sellername)){
                                    echo "<option value='".$row['firstname']." ".$row['lastname']."'>".$row['firstname']." ".$row['lastname']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-4 col-xs-6">
                        <label for="buyer">Buyer</label>
                        <select id="buyer" class="form-control">
                            <option value="">Select buyer</option>
                            <?php
                                $fetch_buyername_query = "SELECT DISTINCT(users.ID),users.FirstName AS firstname , users.LastName AS lastname FROM downloads INNER JOIN users ON users.ID = downloads.Downloader WHERE downloads.IsSellerHasAllowedDownload = 1";
                                $fetch_buyername = mysqli_query($connection , $fetch_buyername_query);
                                while($row = mysqli_fetch_assoc($fetch_buyername)){
                                    echo "<option value='".$row['firstname']." ".$row['lastname']."'>".$row['firstname']." ".$row['lastname']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12 text-right">
                        <label for="search">&nbsp;</label>
                        <input type="text" class="form-control searchtext search-input" id="search" placeholder="&#x1F50D; Search">
                        <input type="button" value="Search" id="button" class="form-control btn search1 search-download-btn">
                    </div>
                </div>
            </div>
            <div class="row table-responsive table-data">
                <table id="downloaded-table" class="table table-responsive">
                    <thead>
                        <tr class="table-heading text-center">
                            <th class="dsrno" scope="col">SR NO.</th>
                            <th class="dnotetitle" scope="col">NOTE TITLE</th>
                            <th class="dcategory" scope="col">CATEGORY</th>
                            <th class="dbuyer" scope="col">BUYER</th>
                            <th class="reye" scope="col"></th>
                            <th class="dseller" scope="col">SELLER</th>
                            <th class="reye" scope="col"></th>
                            <th class="dselltype" scope="col">SELL TYPE</th>
                            <th class="dprice" scope="col">PRICE</th>
                            <th class="ddate-time" scope="col">DOWNLOADED DATE/TIME</th>
                            <th class="ddropdown" scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  
                        
                            $loginid = $_SESSION['ID'];
                            $fetch_downloads_query = "SELECT downloads.NoteID AS noteid , downloads.Seller AS seller , downloads.Downloader AS downloader , downloads.NoteTitle AS notetitle , downloads.NoteCategory AS notecategory, downloads.AttachmentDownloadedDate AS downloadedtime , downloads.IsPaid AS selltype ,downloads.PurchasedPrice AS noteprice FROM downloads WHERE downloads.IsSellerHasAllowedDownload = 1";
                            if(isset($_GET['memberid'])){
                                
                                $memberid = $_GET['memberid'];
                                $fetch_downloads_query .= " AND downloads.Downloader = $memberid";
                                
                            }
                            if(isset($_GET['noteid'])){
                                
                                $membernoteid = $_GET['noteid'];
                                $fetch_downloads_query .= " AND downloads.NoteID = $membernoteid";
                                
                            }
                            $fetch_downloads_query .= " GROUP BY downloads.NoteID";
                            $fetch_downloads = mysqli_query($connection , $fetch_downloads_query);
                            $i=1;
                            
                            while($row = mysqli_fetch_assoc($fetch_downloads)){
                            $noteid = $row['noteid'];
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td class="purple-color" onclick="window.location.href='adminnotedetail.php?admin=1&noteid=<?php echo $noteid;?>'"><?php echo $row['notetitle']; ?></td>
                            <td><?php echo $row['notecategory']; ?></td>
                            <td><?php
                                $buyer =  $row['downloader']; 
                                $fetch_buyer_query = "SELECT * FROM users WHERE ID = $buyer";
                                $fetch_buyer = mysqli_query($connection , $fetch_buyer_query);
                                $buyer_info = mysqli_fetch_assoc($fetch_buyer);
                                echo $buyer_info['FirstName']." ".$buyer_info['LastName'];
                                ?>
                            </td>
                            <td><img src="images/dashboard/eye.png" onclick="window.location.href='memberdetails.php?admin=1&memberid=<?php echo $buyer; ?>'" alt="view"></td>
                            <td><?php
                                $seller =  $row['seller']; 
                                $fetch_seller_query = "SELECT * FROM users WHERE ID = $seller";
                                $fetch_seller = mysqli_query($connection , $fetch_seller_query);
                                $seller_info = mysqli_fetch_assoc($fetch_seller);
                                echo $seller_info['FirstName']." ".$seller_info['LastName'];
                                ?>
                            </td>
                            <td><img src="images/dashboard/eye.png" onclick="window.location.href='memberdetails.php?admin=1&memberid=<?php echo $seller; ?>'" alt="view"></td>
                            <td><?php if( $row['selltype'] == 1 ){ echo "PAID"; }else{ echo "FREE"; } ?></td>
                            <td><?php echo $row['noteprice'];  ?></td>
                            <td><?php if(empty($row['downloadedtime'])){ echo "-"; }else{ echo $row['downloadedtime']; }?></td>
                            <td class="dropdown">
                                <img class="dropdown-toggle" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="images/mydownloads/dots.png" alt="menu">
                                <div class="dropdown-menu" aria-labelledby="dLabel">
                                    <a class="dropdown-item" href="download.php?noteid=<?php echo $noteid; ?>">Download Notes</a>
                                    <a class="dropdown-item" href="adminnotedetail.php?admin=1&noteid=<?php echo $noteid;?>">View More Details</a>
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
            var table = $('table').DataTable({
                'sDom': '"top"i',
                "iDisplayLength": 5,
                language: {
                    paginate: {
                        next: '<img src="images/dashboard/right-arrow.png">',
                        previous: '<img src="images/dashboard/left-arrow.png">'
                    }
                }
            });

            $('.search1').click(function() {
                var x = $('.searchtext').val();
                table.search(x).draw();

            });
            
            $('#note').change(function(){
                var y = $(this).val();
//                alert(y);
                table.columns(1).search(y).draw();
            });
            $('#seller').change(function(){
                var y = $(this).val();
//                alert(y);
                table.columns(5).search(y).draw();
            });
            $('#buyer').change(function(){
                var y = $(this).val();
//                alert(y);
                table.columns(3).search(y).draw();
            });
            
            


        });
    </script>

</body>
</html>