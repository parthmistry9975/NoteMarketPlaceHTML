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
    if(isset($_SESSION['deactivatemember']) and $_SESSION['deactivatemember'] == 'yes'){
        $_SESSION['status'] = "member deactivated !!";
        $_SESSION['status_code'] = "success";
        unset($_SESSION['deactivatemember']);
    }
    if(isset($_SESSION['deactivatemember']) and $_SESSION['deactivatemember'] == 'no'){
        $_SESSION['status'] = "member isn't deactivated !!";
        $_SESSION['status_code'] = "error";
        unset($_SESSION['deactivatemember']);
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
        table{
            width: 100% !important;
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
                        <a class="nav-link active" href="members.php?admin=1">Members</a>
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
   
    <section class="members-table">
        <div class="container table1">
            <div class="row">
                <div class="data-table-intro col-md-12 col-sm-12">Members</div>
                <div class="search-part col-md-12 col-sm-12 col-xs-12 text-right">
                    <input type="text" id="searchtext1" placeholder="&#x1F50D; Search">
                    <button type="button" class="btn search1 search-btn">Search</button>
                    <select id="member-month-filter" class="month-filter">
                        <?php                                    
                                    $currentMonthName = date('F');
                                    // $currentMonthValue = date('n');
                                    for ($i = 0; $i < 6; $i++) {
                                        $MonthName = date("F", strtotime(date('Y-m-01')." -$i months"));
                                        $MonthValue = date("-m-Y", strtotime(date('Y-m-01')." -$i months"));
                                        if ($MonthName == $currentMonthName) {
                                            echo "<option value='{$MonthValue}' selected>{$MonthName}</option>";
                                        } else {
                                            echo "<option value='{$MonthValue}'>{$MonthName}</option>";
                                        }                                                                                                                  
                                    }
                                    ?>
                    </select>
                </div>
            </div>
            <div class="row table-data">
                <table class="table table-responsive">
                    <thead>
                        <tr class="table-heading text-center">
                            <th class="msrno" scope="col">SR NO.</th>
                            <th class="firstname" scope="col">FIRST NAME</th>
                            <th class="lastname" scope="col">LAST NAME</th>
                            <th class="email" scope="col">EMAIL</th>
                            <th class="joiningdate" scope="col">JOINING DATE</th>
                            <th class="underreviewnotes" scope="col">UNDER REVIEW NOTES</th>
                            <th class="publishednotes" scope="col">PUBLISHED NOTES</th>
                            <th class="downloadednotes" scope="col">DOWNLOADED NOTES</th>
                            <th class="totalexpenses" scope="col">TOTAL EXPENSES</th>
                            <th class="totalearnings" scope="col">TOTAL EARNINGS</th>
                            <th class="mdropdown" scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                            $loginid = $_SESSION['ID'];
                            $fetch_members_query = "SELECT * FROM users WHERE IsActive = 1 AND RoleID = 3";
                            $fetch_members = mysqli_query($connection,$fetch_members_query);
                            $i=1;

                            while ($members = mysqli_fetch_array($fetch_members)) {
                            $memberid = $members['ID'];
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $members['FirstName']; ?></td>
                            <td><?php echo $members['LastName']; ?></td>
                            <td><?php echo $members['EmailID']; ?></td>
                            <td><?php echo date("d-m-Y, h:i", strtotime($members['CreatedDate'])); ?></td>
                            <td class="purple-color" onclick="window.location.href='underreview.php?admin=1&memberid=<?php echo $memberid;?>'">
                                <?php
                                
                                    $fetch_underreview_query = "SELECT COUNT(ID) AS underreview FROM seller_notes WHERE SellerID = $memberid AND Status IN (7,8) AND IsActive = 1";
                                    $fetch_underreview = mysqli_query($connection, $fetch_underreview_query);
                                    $underreview_count = mysqli_fetch_assoc($fetch_underreview);
                                    echo $underreview_count["underreview"];
                                
                                ?>
                            </td>
                            <td class="purple-color" onclick="window.location.href='publishednotes.php?admin=1&memberid=<?php echo $memberid;?>'">
                                <?php
                                
                                    $fetch_published_query = "SELECT COUNT(ID) AS published FROM seller_notes WHERE SellerID = $memberid AND Status = 9 AND IsActive = 1";
                                    $fetch_published = mysqli_query($connection, $fetch_published_query);
                                    $published_count = mysqli_fetch_assoc($fetch_published);
                                    echo $published_count["published"];
                                ?>
                            </td>
                            <td class="purple-color" onclick="window.location.href='downloadednotes.php?admin=1&memberid=<?php echo $memberid;?>'">
                                <?php
                                
                                    $fetch_downloaded_query = "SELECT DISTINCT(downloads.NoteID) FROM downloads WHERE downloads.Downloader = $memberid";
                                    $fetch_downloaded = mysqli_query($connection, $fetch_downloaded_query);
                                    $downloaded_count = mysqli_num_rows($fetch_downloaded);
                                    echo $downloaded_count;
                                ?>
                            </td>
                            <td class="purple-color" onclick="window.location.href='downloadednotes.php?admin=1&memberid=<?php echo $memberid;?>'">
                                <?php
                                    $fetch_expenses_query  = "SELECT DISTINCT(NoteID),PurchasedPrice AS expenses FROM downloads WHERE Downloader = $memberid";
                                    $fetch_expenses = mysqli_query($connection , $fetch_expenses_query);
                                    $total_expense = 0;
                                    while($expenses = mysqli_fetch_assoc($fetch_expenses)){
                                        $total_expense += $expenses['expenses'];
                                    }
                                    echo $total_expense;
                                ?>
                            </td>
                            <td>
                                <?php
                                
                                    $fetch_earning_query  = "SELECT DISTINCT(NoteID),PurchasedPrice AS earnings FROM downloads WHERE 
                                    seller = $memberid";
                                    $fetch_earning = mysqli_query($connection , $fetch_earning_query);
                                    $total_earning = 0;
                                    while($earnings = mysqli_fetch_assoc($fetch_earning)){
                                        $total_earning += $earnings['earnings'];
                                    }
                                    echo $total_earning;
                                
                                ?>
                            </td>
                            <td class="dropdown">
                                <img class="dropdown-toggle" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="images/mydownloads/dots.png" alt="menu">
                                <div class="dropdown-menu" aria-labelledby="dLabel">
                                    <a class="dropdown-item" href="memberdetails.php?admin=1&memberid=<?php echo $memberid; ?>">View More Details</a>
                                    <a class="dropdown-item" href="#" onclick="deactivatemember('<?php echo $memberid; ?>')">Deactivate</a>
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
                <div class="col-md-4 col-sm-4 col-xs-6 "></div>
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
    <script src="js/sweetalert/sweetalert.min.js"></script>
    <script>
    <?php
        if(isset($_SESSION['status']) && $_SESSION['status'] != ''){
            ?>
            
            swal({
              title: "<?php echo $_SESSION['status']; ?>",
//              text: "You clicked the button!",
              icon: "<?php echo $_SESSION['status_code']; ?>",
              button: "okay !",
            });
        <?php
            unset($_SESSION['status_code']);
            unset($_SESSION['status']);
            
        }
        
        ?>
        
    </script>

    <!-- custom js -->
    <script src="js/script.js"></script>
    <script>
        $(document).ready(function() {
            var table1 = $('table').DataTable({
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

            $('.search1').click(function() {
                var x = $('#searchtext1').val();
                table1.search(x).draw();

            });
            
            $(document).on('change', '#member-month-filter', function () {
            loadPublishedNotesByMonth($(this).val());
            });

            function loadPublishedNotesByMonth(month) {
                let monthVal = month;
                table1.column(4).search(monthVal).draw();
            }

            var currentMonth = $('#member-month-filter').val();
            loadPublishedNotesByMonth(currentMonth);

            

        });
    </script>
    <script>
    
        function deactivatemember(memberid){
            var approvecheck = confirm("Are you sure you want to make this member inactive?");
            if(approvecheck == true){
                location.replace("deactivatemember.php?memberid="+memberid);
            }else{
                
            }
        }
    
    </script>

</body>
</html>