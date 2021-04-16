<?php ob_start(); ?>
<?php include 'includes/db.php'; ?>
<?php  

    session_start();
    if(!isset($_SESSION['ID'])){
        header("location:login.php");
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

    <!-- custom css -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    
    <!-- responsive css -->
    <link rel="stylesheet" type="text/css" href="css/responsive.css">

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
                    <li class='nav-item dropdown'>
                        <a class='nav-link' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            <img src='images/user-profile/login-image.png' alt='login image'>
                            <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                                <a class='dropdown-item' href='userprofile.php'>My Profile</a>
                                <a class='dropdown-item' href='mydownloads.php'>My Downloads</a>
                                <a class='dropdown-item' href='mysoldnotes.php'>My Sold Notes</a>
                                <a class='dropdown-item' href='myrejectednotes.php'>My Rejected Notes</a>
                                <a class='dropdown-item' href='changepw.php'>Change Password</a>
                                <a class='dropdown-item purple' href='logout.php'>LOGOUT</a>
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
   
    <section class="buyerrequest-table">
        <div class="container table1">
            <div class="row">
                <div class="buyerrequest-table-intro col-md-6">Buyer Requests</div>
                <form class="search-part col-md-6 text-right">
                    <input type="text" placeholder="&#x1F50D; Search">
                    <button type="button" class="btn search-btn">Search</button> 
                </form>
            </div>
            <div class="row table-data">
                <table class="table table-responsive">
                    <tr class="table-heading text-center">
                        <th class="bsrno" scope="col">SR NO.</th>
                        <th class="bnotetitle" scope="col">NOTE TITLE</th>
                        <th class="bcategory" scope="col">CATEGORY</th>
                        <th class="bbuyer" scope="col">BUYER</th>
                        <th class="phoneno" scope="col">PHONE NO.</th>
                        <th class="bselltype" scope="col">SELL TYPE</th>
                        <th class="bprice" scope="col">PRICE</th>
                        <th class="bdate-time" scope="col">DOWNLOAD DATE/TIME</th>
                        <th class="buyereye" scope="col"></th>
                        <th class="buyermenu" scope="col"></th>
                    </tr>
                    <?php  
                    
                    if(isset($_GET['page'])){
                        $page = $_GET['page'];
                        $page =mysqli_real_escape_string($connection,$page);
                        $page = htmlentities($page);
                    }else{
                        $page = 1;
                    }
                    
                    $num_per_page = 10;
                    $start_from = ($page-1) * $num_per_page;
                    
                    
                    
                    $fetch_progress_query = "SELECT downloads.ID,downloads.NoteTitle AS note_title, downloads.NoteCategory AS note_category, users.EmailID AS buyer_id , downloads.IsPaid AS sell_type, downloads.PurchasedPrice AS price, downloads.AttachmentDownloadedDate AS download_date FROM downloads , users WHERE downloads.Downloader = users.ID AND `IsSellerHasAllowedDownload` = 0 AND IsEmailVerified = 1 ORDER BY downloads.CreatedDate DESC LIMIT $start_from,$num_per_page";
                    $progress_notes = mysqli_query($connection,$fetch_progress_query);
                    
                    $fetch_num_query = "SELECT * FROM downloads , users WHERE downloads.Downloader = users.ID AND `IsSellerHasAllowedDownload` = 0 AND IsEmailVerified = 1";
                    $fetch_num = mysqli_query($connection,$fetch_num_query);
                    $total_records = mysqli_num_rows($fetch_num);
                    $total_pages = ceil($total_records / $num_per_page);
                    $i=1;
                   
                    
                    
                    while ($progress_row = mysqli_fetch_array($progress_notes)) {  
                        
                    ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $progress_row["note_title"]; ?></td>
                            <td><?php echo $progress_row["note_category"]; ?></td>
                            <td><?php echo $progress_row["buyer_id"]; ?></td>
                            <td>+91<?php echo rand(1111111111,9999999999); ?></td>
                            <td><?php if($progress_row["sell_type"] == 1){ echo "Paid"; }else{ echo "Free"; } ?></td>
                            <td><?php echo $progress_row["price"]; ?></td>
                            <td><?php if(empty($progress_row["download_date"])){ echo "-" ; }else { echo $progress_row["download_date"];} ?></td>
                            <td><?php echo '<a href="notedetails.php?note_id="'.$progress_row["ID"].'><img src="images/dashboard/eye.png" alt="view"></a>'; ?></td>
                            <td class="dropdown"><?php echo '<img class="dropdown-toggle" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="images/mydownloads/dots.png" alt="menu">
                            <div class="dropdown-menu" aria-labelledby="dLabel">
                                <a class="dropdown-item" href="allowdownload.php?allow='.$progress_row["ID"].'">Allow Download</a>
                            </div>' ?></td>
                        </tr>
                    <?php  
                        $i++;
                    };  
                    ?>
                </table>
                <ul class="pagination">
                    <li class="<?php if($page == 1){ echo 'disabled'; }?> page-item">
                        <a class="page-link" href="buyerrequest.php?page=<?php echo $page-1 ; ?>" aria-label="Previous">
                            <span aria-hidden="true"><img src="images/dashboard/left-arrow.png" alt="previous"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    
                    <?php
                    
                        for($i=1;$i<=$total_pages;$i++){
                            ?>
                                
                                <li class="<?php if($page == $i) { echo 'active'; }
                                ?> page-item"><a class="page-link" href="buyerrequest.php?page=<?php echo $i ; ?>"><?php echo $i ;?></a></li>
                            
                            <?php
                        }
                    
                    ?>
                    
                    <li class="<?php if($page == $total_pages){ echo 'disabled'; }?> page-item">
                        <a class="page-link" href="buyerrequest.php?page=<?php echo $page+1 ; ?>" aria-label="Next">
                            <span aria-hidden="true"><img src="images/dashboard/right-arrow.png" alt="next"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    
    <!-- footer -->
    <section class="footer">
        <div class="container">
            <hr>
            <div class="row">
                <div class="col-md-6 footer_content">
                    <p>Copyright © <a href="https://www.tatvasoft.com/">TatvaSoft</a> All Rights Reserved.</p>
                </div>
                <div class="col-md-6 footer_social text-right">
                    <ul class="social-list">
                        <li><a href="#">
                                <i class="fa fa-facebook"></i>
                            </a></li>
                        <li><a href="#">
                                <i class="fa fa-twitter"></i>
                            </a></li>
                        <li><a href="#">
                                <i class="fa fa-google-plus"></i>
                            </a></li>
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
    

    <!-- custom js -->
    <script src="js/script.js"></script>

</body>
</html>