<?php ob_start(); ?>
<?php include 'includes/db.php'; ?>
<?php  

    session_start();
    if(!isset($_SESSION['ID'])){
        header("location:login.php");
    }
    if($_SESSION['ROLE'] != 3){
        header("location:../admin/admindashboard.php?admin=1");
    }
    if(isset($_SESSION['showsetpassword']) and $_SESSION['showsetpassword'] == 'yes'){
        $_SESSION['status'] = "Password Updated !!";
        $_SESSION['status_code'] = "success";
        unset($_SESSION['showsetpassword']);
    }
    if(isset($_SESSION['download_error']) and $_SESSION['download_error'] == 'yes'){
        $_SESSION['status'] = "note file is deleted";
        $_SESSION['status_code'] = "error";
        unset($_SESSION['download_error']);
    }
    
?>
<?php
//    
//    $fetch_id = $_SESSION['ID'];
//    $just_login = $_SESSION['justlogin'];
//    $check_query = "SELECT * FROM user_profile WHERE UserID = $fetch_id";
//    $check = mysqli_query($connection, $check_query);
//    $check_status = mysqli_num_rows ( $check );
//    if($check_status == 0 && $just_login == 1){
//    
//        header("location:userprofile.php");
//    }
//

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
    <link rel="stylesheet" type="text/css" href="css/responsive.css">
    
    <!-- data table css -->
    <style>

        table.dataTable thead th,
        table.dataTable thead td {
            padding: 10px 18px;
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
        <nav class="navbar1 navbar-expand-lg">
            <a class="navbar-brand" href="index.php"><img src="images/user-profile/logo.png" alt="logo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"><i class="fa fa-bars" aria-hidden="true"></i></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="searchnotes.php">Search Notes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="userdashboard.php">Sell Your Notes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="buyerrequest.php">Buyer Requests</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="faq.php">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contactus.php">Contact Us</a>
                    </li>
                    <li class="nav-item dropdown">
                        <?php
                        $fetch_image_path_query = "SELECT ProfilePicture FROM user_profile WHERE UserID = ".$_SESSION['ID'];
                        $fetch_image_path = mysqli_query($connection , $fetch_image_path_query);
                        $image_path = mysqli_fetch_assoc($fetch_image_path);
                        if(!empty($image_path['ProfilePicture'])){
                            $pp_file = $image_path['ProfilePicture'];
                        }else{
                            $pp_file = "images/default/profile/dp.jpg";
                        }
                        
                        ?>
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo $pp_file; ?>" alt="login image">
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="userprofile.php">My Profile</a>
                                <a class="dropdown-item" href="mydownloads.php">My Downloads</a>
                                <a class="dropdown-item" href="mysoldnotes.php">My Sold Notes</a>
                                <a class="dropdown-item" href="myrejectednotes.php">My Rejected Notes</a>
                                <a class="dropdown-item" href="changepw.php">Change Password</a>
                                <a class="dropdown-item purple" style="color:#6255a5;" href="logout.php">LOGOUT</a>
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

    <!-- Stats -->
    <div id="dashboard-stats" class="box">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-6">
                    <h2>Dashboard</h2>
                </div>
                <div class="col-md-6 col-6 text-right">
                    <a href="addnote.php"><button>Add Note</button></a>
                </div>
            </div>

            <div class="row" id="stats">
                <div class="col-lg-6 col-md-12">
                    <div id="stats-left">
                        <div class="row">
                            <div class="col-md-4 state-head stats-text">
                                <div>
                                    <img src="images/dashboard/earning-icon.svg" alt="icon">
                                    <h4>My Earning</h4>
                                </div>
                            </div>
                            <div class="col-md-4 text-center stats-text">
                                <div>
                                    <h4 onclick="window.location.href='mysoldnotes.php'">
                                        <?php
                                            $loginid = $_SESSION['ID'];
                                            $sold_notes_count = mysqli_query($connection,"SELECT * FROM downloads WHERE Seller = $loginid AND IsSellerHasAllowedDownload = 1 GROUP BY downloads.NoteID , downloads.Downloader");
                                            $sold_count = mysqli_num_rows($sold_notes_count);
                                            echo $sold_count;
                                        ?>
                                    </h4>
                                    <h6>Number of Notes Sold</h6>
                                </div>
                            </div>
                            <div class="col-md-4 text-center stats-text">
                                <div>
                                    <h4 onclick="window.location.href='mysoldnotes.php'">
                                        <?php
                                            $earn_query = mysqli_query($connection,"SELECT SUM(PurchasedPrice) AS earned FROM downloads WHERE Seller = $loginid AND IsSellerHasAllowedDownload=1 GROUP BY downloads.NoteID , downloads.Downloader");
                                            $earned = mysqli_fetch_assoc($earn_query);
                                            if(empty($earned['earned'])){
                                                echo "₹  0";
                                            }else{
                                                echo "₹ ".$earned['earned'];   
                                            }
                                        ?>
                                    </h4>
                                    <h6>Money Earned</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-4 text-center">
                    <div class="stat-item stats-text">
                        <div>
                            <h4 onclick="window.location.href='mydownloads.php'">
                                <?php
                                    $download_query = mysqli_query($connection , "SELECT * from downloads WHERE Downloader=$loginid AND IsSellerHasAllowedDownload = 1 GROUP BY downloads.NoteID,downloads.Downloader");
                                    $download_count = mysqli_num_rows($download_query);
                                    echo $download_count;
                                ?>
                            </h4>
                            <h6>My Downloads</h6>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-4 text-center">
                    <div class="stat-item stats-text">
                        <div>
                            <h4 onclick="window.location.href='myrejectednotes.php'">
                                <?php
                                    $reject_query = mysqli_query($connection,"SELECT COUNT(ID) AS rejected FROM seller_notes WHERE SellerID = $loginid AND Status = 10");
                                    $reject = mysqli_fetch_assoc($reject_query);
                                    echo $reject['rejected'];
                                ?>
                            </h4>
                            <h6>My Rejected Notes</h6>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-4 text-center">
                    <div class="stat-item stats-text">
                        <div>
                            <h4 onclick="window.location.href='buyerrequest.php'">
                                <?php
                                    $buy_request = mysqli_query($connection,"SELECT * FROM downloads WHERE Seller = $loginid AND IsSellerHasAllowedDownload = 0 GROUP BY downloads.NoteID,downloads.Downloader");
                                    $bcount = mysqli_num_rows($buy_request);
                                    echo $bcount;
                                ?>
                            </h4>
                            <h6>Buyer Requests</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Stats Ends-->
   
    
    <section class="data-table dashboard-table">
        <div class="container table1">
            <div class="row">
                <div class="data-table-intro col-md-6">In Progress Notes</div>
                <div class="search-part col-md-6 text-right">
                    <input name="search_value" type="text" id="searchtext1" placeholder="&#x1F50D; Search">
                    <button name="search" type="button" class="btn search1 search-btn">Search</button> 
                </div>
            </div>
            <div class="row table-data table-responsive">
                <table class="table progress-table">
                    <thead>
                        <tr class="table-heading text-center">
                            <th class="addeddate" scope="col">ADDED DATE</th>
                            <th class="title" scope="col">TITLE</th>
                            <th class="category" scope="col">CATEGORY</th>
                            <th class="status" scope="col">STATUS</th>
                            <th class="actions" scope="col">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                    
                    <?php  
                    
                    $loginid = $_SESSION['ID'];
                    $fetch_progress_query = "SELECT seller_notes.ID,seller_notes.Status AS s_id,seller_notes.CreatedDate AS added_date,seller_notes.Title AS title,note_categories.Name AS category,reference_data.Value AS status FROM seller_notes,reference_data,note_categories WHERE seller_notes.SellerID = $loginid AND seller_notes.Status = reference_data.ID AND seller_notes.Category = note_categories.ID AND seller_notes.Status IN ( 6, 7 ,8) ORDER BY seller_notes.CreatedDate DESC";
                    $progress_notes = mysqli_query($connection,$fetch_progress_query);
                  
                    while ($progress_row = mysqli_fetch_array($progress_notes)) {  
                    ?>
                        <tr><?php $addeddatestr = strtotime($progress_row["added_date"]); ?>
                            <td data-sort='<?php echo $addeddatestr; ?>'><?php echo $progress_row["added_date"]; ?></td>
                            <td><?php echo $progress_row["title"]; ?></td>
                            <td><?php echo $progress_row["category"]; ?></td>
                            <td><?php echo $progress_row["status"]; ?></td>
                            <td><?php 
                        
                                if( $progress_row["s_id"] == 6 ){ echo '&nbsp;<a href="editnote.php?noteid='.$progress_row["ID"].'"><img src="images/dashboard/edit.png" alt="edit"></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="deletenote.php?delete_id='.$progress_row["ID"].'"><img src="images/dashboard/delete.png" alt="delete"></a>'; }
                                else{

                                echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="notedetails.php?noteid='.$progress_row["ID"].'"><img src="images/dashboard/eye.png" alt="view"></a>';

                                }?></td>
                        </tr>
                    <?php  
                    };  
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="container table2">
            <div class="row">
                <div class="data-table-intro col-md-6">Published Notes</div>
                <div class="search-part col-md-6 text-right">
                    <input type="text" id="searchtext2" placeholder="&#x1F50D; Search">
                    <button type="button" class="btn search2 search-btn">Search</button>
                </div>
            </div>
            <div class="row table-data table-responsive">
                <table class="table publish-table ">
                    <thead>
                        <tr class="table-heading text-center">
                            <th class="addeddate" scope="col">ADDED DATE</th>
                            <th class="title" scope="col">TITLE</th>
                            <th class="category" scope="col">CATEGORY</th>
                            <th class="selltype" scope="col">SELL TYPE</th>
                            <th class="price" scope="col">PRICE</th>
                            <th class="actions2" scope="col">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php  
                    
                    
                    $fetch_progress_query1 = "SELECT seller_notes.ID,seller_notes.CreatedDate AS added_date , seller_notes.Title AS title , note_categories.Name AS category , seller_notes.IsPaid AS ispaid , seller_notes.SellingPrice AS price FROM seller_notes, note_categories WHERE seller_notes.SellerID = $loginid AND seller_notes.Category = note_categories.ID AND seller_notes.Status = 9";
                    $progress_notes1 = mysqli_query($connection,$fetch_progress_query1);
                    
                    while ($progress_row1 = mysqli_fetch_array($progress_notes1)) {  
                    ?>
                        <tr>
                            <td><?php echo $progress_row1["added_date"]; ?></td>
                            <td><?php echo $progress_row1["title"]; ?></td>
                            <td><?php echo $progress_row1["category"]; ?></td>
                            <td><?php if($progress_row1["ispaid"] == 1)
                                        { 
                                            echo "Paid";
                                        }else
                                        {
                                            echo "Free";
                                        }
                                ?>
                            </td>
                            <td><?php echo $progress_row1["price"]; ?></td>
                            <td><a href="notedetails.php?noteid=<?php echo $progress_row1['ID'] ; ?>"><img src="images/dashboard/eye.png" alt="view"></a></td>
                        </tr>
                    <?php  
                    };  
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
        
    </section>
    <!-- footer -->
    <section class="footer container-fluid">
           <div class="container-fluid">
            <hr>
            <div class="row">
                <div class="col-md-6 footer_content">
                    <p>Copyright © <a href="https://www.tatvasoft.com/">TatvaSoft</a> All Rights Reserved.</p>
                </div>
                <div class="col-md-6 footer_social text-right">
                    <ul class="social-list">
                        <li>
                            <?php
                                
                                $fetch_furl = mysqli_query($connection,"SELECT Value FROM system_configurations WHERE ID = 6");
                                $furl = mysqli_fetch_assoc($fetch_furl);
                            
                            ?>
                            <a href="<?php echo $furl['Value']; ?>">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>
                        <li>
                            <?php
                            
                                $fetch_turl = mysqli_query($connection,"SELECT Value FROM system_configurations WHERE ID = 7");
                                $turl = mysqli_fetch_assoc($fetch_turl);
                            
                            ?>
                            <a href="<?php echo $turl['Value']; ?>">
                                <i class="fa fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <?php
                           
                                $fetch_lurl = mysqli_query($connection,"SELECT Value FROM system_configurations WHERE ID = 8");
                                $lurl = mysqli_fetch_assoc($fetch_lurl);     
                           
                            ?>
                            <a href="<?php echo $lurl['Value']; ?>">
                                <i class="fa fa-google-plus"></i>
                            </a>
                        </li>
                    </ul>
                </div>
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
        if(isset($_SESSION['status']) and $_SESSION['status'] != ''){
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
            var table = $('table.progress-table').DataTable({
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
                var x = $('#searchtext1').val();
                table.search(x).draw();

            });

        });
        
        $(document).ready(function() {
            var table = $('table.publish-table').DataTable({
                'sDom': '"top"i',
                "iDisplayLength": 5,
                language: {
                    paginate: {
                        next: '<img src="images/dashboard/right-arrow.png">',
                        previous: '<img src="images/dashboard/left-arrow.png">'
                    }
                }
            });

            $('.search2').click(function() {
                var x = $('#searchtext2').val();
                table.search(x).draw();

            });

        });
        
    </script>
    

</body>
</html>