<?php ob_start(); ?>
<?php include 'includes/db.php'; ?>
<?php  

    session_start();
    
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
                    <?php
                    if(isset($_SESSION['ID'])){
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="buyerrequest.php">Buyer Requests</a>
                        </li>
                        <?php
                    }
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="faq.php">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contactus.php">Contact Us</a>
                    </li>
                    <?php
                    
                    if(isset($_SESSION['ID'])){
                        ?><li class='nav-item dropdown'>
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
                        <li class="nav-item"><a href="logout.php"><button type="button" class="btn btn-primary btn_login">Logout</button></a></li><?php
                    }else{
                        ?>
                        <li class="nav-item"><a href="login.php"><button type="button" class="btn btn-primary btn_login">Login</button></a></li><?php
                    }
                    
                    ?>
                </ul>
            </div>
        </nav>
    </section>
    
	<!-- Banner  -->
	<section class="banner">
	    <div class="content-box-banner">
	        <div class="container">
	            <div class="row">
	                <div class="col-md-12">
	                    <h1 class="text-center">Search Notes</h1>
	                </div>
	            </div>
	        </div>
	    </div>
	</section>
	<!-- Banner Ends -->
	
	<!-- filter -->
    <section class="profile">
        <div class="container">
            <div class="row">
                <div class="col-md-12 serch-heading">
                    <h2>Search and Filter notes</h2>
                </div>
            </div>
            <form class="search-form col-md-12">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <input type="search" class="form-control" name="search" placeholder="&#128269; Serch notes here">
                    </div>
                </div>
                <div class="form-row filter-tab">
                    <div class="form-group col-md-2">
                        <select class="form-control">
                                <option>Select type</option>
                                <option>Male</option>
                                <option>Female</option>
                                <option>Other</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <select class="form-control">
                                <option>Select category</option>
                                <option>Male</option>
                                <option>Female</option>
                                <option>Other</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <select class="form-control">
                                <option>Select university</option>
                                <option>Male</option>
                                <option>Female</option>
                                <option>Other</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <select class="form-control">
                                <option>Select course</option>
                                <option>Male</option>
                                <option>Female</option>
                                <option>Other</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <select class="form-control">
                                <option>Select country</option>
                                <option>Male</option>
                                <option>Female</option>
                                <option>Other</option>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <select class="form-control">
                                <option>Select rating</option>
                                <option>Male</option>
                                <option>Female</option>
                                <option>Other</option>
                        </select>
                    </div>
                </div>
            </form>
            <div class="row">
                <div class="col-md-12 serch-heading">
                    <h2>Total 19 Notes</h2>
                </div>
            </div>
            <div class="row">
                <!-- 1 -->
                <div class="note col-md-4 col-sm-6">
                    <div class="border">
                    <div class="note-poster">
                        <img src="images/search/1.jpg" alt="poster">
                    </div>
                    <div class="note-heading">
                        <a href="notedetails.php"><p>Computer Operating System - Final Exam Book With Paper Solution</p></a>
                    </div>
                    <div class="note-info">
                        <ul>
                            <li><i class="fa fa-university" aria-hidden="true"></i>  University of California, US</li>
                            <li><i class="fa fa-columns" aria-hidden="true"></i>  204 Pages</li>
                            <li><i class="fa fa-calendar" aria-hidden="true"></i>  Thu, Nov 26 2020</li>
                            <li><i class="fa fa-flag-o" aria-hidden="true"></i>  5 Users marked this note as inappropriate</li>
                            <li><span>100 Review</span>
                                <div class="rate">
                                    <input type="radio" id="star5" name="rate" value="5" />
                                    <label for="star5" title="5 star">5 stars</label>
                                    <input type="radio" id="star4" name="rate" value="4" />
                                    <label for="star4" title="4 star">4 stars</label>
                                    <input type="radio" id="star3" name="rate" value="3" />
                                    <label for="star3" title="3 star">3 stars</label>
                                    <input type="radio" id="star2" name="rate" value="2" />
                                    <label for="star2" title="2 star">2 stars</label>
                                    <input type="radio" id="star1" name="rate" value="1" />
                                    <label for="star1" title="1 star">1 star</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                    
                    </div>
                </div>
                <!-- 2 -->
                <div class="note col-md-4 col-sm-6">
                    <div class="border">
                    <div class="note-poster">
                        <img src="images/search/2.jpg" alt="poster">
                    </div>
                    <div class="note-heading">
                        <a href="notedetails.php"><p>Computer Operating System - Final Exam Book With Paper Solution</p></a>
                    </div>
                    <div class="note-info">
                        <ul>
                            <li><i class="fa fa-university" aria-hidden="true"></i>  University of California, US</li>
                            <li><i class="fa fa-columns" aria-hidden="true"></i>  204 Pages</li>
                            <li><i class="fa fa-calendar" aria-hidden="true"></i>  Thu, Nov 26 2020</li>
                            <li><i class="fa fa-flag-o" aria-hidden="true"></i>  5 Users marked this note as inappropriate</li>
                            <li><span>100 Review</span>
                                <div class="rate">
                                    <input type="radio" id="star5" name="rate" value="5" />
                                    <label for="star5" title="5 star">5 stars</label>
                                    <input type="radio" id="star4" name="rate" value="4" />
                                    <label for="star4" title="4 star">4 stars</label>
                                    <input type="radio" id="star3" name="rate" value="3" />
                                    <label for="star3" title="3 star">3 stars</label>
                                    <input type="radio" id="star2" name="rate" value="2" />
                                    <label for="star2" title="2 star">2 stars</label>
                                    <input type="radio" id="star1" name="rate" value="1" />
                                    <label for="star1" title="1 star">1 star</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                    
                    </div>
                </div>
                <!-- 3 -->
                <div class="note col-md-4 col-sm-6">
                    <div class="border">
                    <div class="note-poster">
                        <img src="images/search/3.jpg" alt="poster">
                    </div>
                    <div class="note-heading">
                        <a href="notedetails.php"><p>Computer Operating System - Final Exam Book With Paper Solution</p></a>
                    </div>
                    <div class="note-info">
                        <ul>
                            <li><i class="fa fa-university" aria-hidden="true"></i>  University of California, US</li>
                            <li><i class="fa fa-columns" aria-hidden="true"></i>  204 Pages</li>
                            <li><i class="fa fa-calendar" aria-hidden="true"></i>  Thu, Nov 26 2020</li>
                            <li><i class="fa fa-flag-o" aria-hidden="true"></i>  5 Users marked this note as inappropriate</li>
                            <li><span>100 Review</span>
                                <div class="rate">
                                    <input type="radio" id="star5" name="rate" value="5" />
                                    <label for="star5" title="5 star">5 stars</label>
                                    <input type="radio" id="star4" name="rate" value="4" />
                                    <label for="star4" title="4 star">4 stars</label>
                                    <input type="radio" id="star3" name="rate" value="3" />
                                    <label for="star3" title="3 star">3 stars</label>
                                    <input type="radio" id="star2" name="rate" value="2" />
                                    <label for="star2" title="2 star">2 stars</label>
                                    <input type="radio" id="star1" name="rate" value="1" />
                                    <label for="star1" title="1 star">1 star</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                    </div>
                </div>
                <!-- 4 -->
                <div class="note col-md-4 col-sm-6">
                    <div class="border">
                    <div class="note-poster">
                        <img src="images/search/4.jpg" alt="poster">
                    </div>
                    <div class="note-heading">
                        <a href="notedetails.php"><p>Computer Operating System - Final Exam Book With Paper Solution</p></a>
                    </div>
                    <div class="note-info">
                        <ul>
                            <li><i class="fa fa-university" aria-hidden="true"></i>  University of California, US</li>
                            <li><i class="fa fa-columns" aria-hidden="true"></i>  204 Pages</li>
                            <li><i class="fa fa-calendar" aria-hidden="true"></i>  Thu, Nov 26 2020</li>
                            <li><i class="fa fa-flag-o" aria-hidden="true"></i>  5 Users marked this note as inappropriate</li>
                            <li><span>100 Review</span>
                                <div class="rate">
                                    <input type="radio" id="star5" name="rate" value="5" />
                                    <label for="star5" title="5 star">5 stars</label>
                                    <input type="radio" id="star4" name="rate" value="4" />
                                    <label for="star4" title="4 star">4 stars</label>
                                    <input type="radio" id="star3" name="rate" value="3" />
                                    <label for="star3" title="3 star">3 stars</label>
                                    <input type="radio" id="star2" name="rate" value="2" />
                                    <label for="star2" title="2 star">2 stars</label>
                                    <input type="radio" id="star1" name="rate" value="1" />
                                    <label for="star1" title="1 star">1 star</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                    </div>
                </div>
                <!-- 5 -->
                <div class="note col-md-4 col-sm-6">
                    <div class="border">
                    <div class="note-poster">
                        <img src="images/search/5.jpg" alt="poster">
                    </div>
                    <div class="note-heading">
                        <a href="notedetails.php"><p>Computer Operating System - Final Exam Book With Paper Solution</p></a>
                    </div>
                    <div class="note-info">
                        <ul>
                            <li><i class="fa fa-university" aria-hidden="true"></i>  University of California, US</li>
                            <li><i class="fa fa-columns" aria-hidden="true"></i>  204 Pages</li>
                            <li><i class="fa fa-calendar" aria-hidden="true"></i>  Thu, Nov 26 2020</li>
                            <li><i class="fa fa-flag-o" aria-hidden="true"></i>  5 Users marked this note as inappropriate</li>
                            <li><span>100 Review</span>
                                <div class="rate">
                                    <input type="radio" id="star5" name="rate" value="5" />
                                    <label for="star5" title="5 star">5 stars</label>
                                    <input type="radio" id="star4" name="rate" value="4" />
                                    <label for="star4" title="4 star">4 stars</label>
                                    <input type="radio" id="star3" name="rate" value="3" />
                                    <label for="star3" title="3 star">3 stars</label>
                                    <input type="radio" id="star2" name="rate" value="2" />
                                    <label for="star2" title="2 star">2 stars</label>
                                    <input type="radio" id="star1" name="rate" value="1" />
                                    <label for="star1" title="1 star">1 star</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                    </div>
                </div>
                <!-- 6 -->
                <div class="note col-md-4 col-sm-6">
                    <div class="border">
                    <div class="note-poster">
                        <img src="images/search/6.jpg" alt="poster">
                    </div>
                    <div class="note-heading">
                        <a href="notedetails.php"><p>Computer Operating System - Final Exam Book With Paper Solution</p></a>
                    </div>
                    <div class="note-info">
                        <ul>
                            <li><i class="fa fa-university" aria-hidden="true"></i>  University of California, US</li>
                            <li><i class="fa fa-columns" aria-hidden="true"></i>  204 Pages</li>
                            <li><i class="fa fa-calendar" aria-hidden="true"></i>  Thu, Nov 26 2020</li>
                            <li><i class="fa fa-flag-o" aria-hidden="true"></i>  5 Users marked this note as inappropriate</li>
                            <li><span>100 Review</span>
                                <div class="rate">
                                    <input type="radio" id="star5" name="rate" value="5" />
                                    <label for="star5" title="5 star">5 stars</label>
                                    <input type="radio" id="star4" name="rate" value="4" />
                                    <label for="star4" title="4 star">4 stars</label>
                                    <input type="radio" id="star3" name="rate" value="3" />
                                    <label for="star3" title="3 star">3 stars</label>
                                    <input type="radio" id="star2" name="rate" value="2" />
                                    <label for="star2" title="2 star">2 stars</label>
                                    <input type="radio" id="star1" name="rate" value="1" />
                                    <label for="star1" title="1 star">1 star</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                    </div>
                </div>
                <!-- 7 -->
                <div class="note col-md-4 col-sm-6">
                    <div class="border">
                    <div class="note-poster">
                        <img src="images/search/1.jpg" alt="poster">
                    </div>
                    <div class="note-heading">
                        <a href="notedetails.php"><p>Computer Operating System - Final Exam Book With Paper Solution</p></a>
                    </div>
                    <div class="note-info">
                        <ul>
                            <li><i class="fa fa-university" aria-hidden="true"></i>  University of California, US</li>
                            <li><i class="fa fa-columns" aria-hidden="true"></i>  204 Pages</li>
                            <li><i class="fa fa-calendar" aria-hidden="true"></i>  Thu, Nov 26 2020</li>
                            <li><i class="fa fa-flag-o" aria-hidden="true"></i>  5 Users marked this note as inappropriate</li>
                            <li><span>100 Review</span>
                                <div class="rate">
                                    <input type="radio" id="star5" name="rate" value="5" />
                                    <label for="star5" title="5 star">5 stars</label>
                                    <input type="radio" id="star4" name="rate" value="4" />
                                    <label for="star4" title="4 star">4 stars</label>
                                    <input type="radio" id="star3" name="rate" value="3" />
                                    <label for="star3" title="3 star">3 stars</label>
                                    <input type="radio" id="star2" name="rate" value="2" />
                                    <label for="star2" title="2 star">2 stars</label>
                                    <input type="radio" id="star1" name="rate" value="1" />
                                    <label for="star1" title="1 star">1 star</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                    </div>
                </div>
                <!-- 8 -->
                <div class="note col-md-4 col-sm-6">
                    <div class="border">
                    <div class="note-poster">
                        <img src="images/search/2.jpg" alt="poster">
                    </div>
                    <div class="note-heading">
                        <a href="notedetails.php"><p>Computer Operating System - Final Exam Book With Paper Solution</p></a>
                    </div>
                    <div class="note-info">
                        <ul>
                            <li><i class="fa fa-university" aria-hidden="true"></i>  University of California, US</li>
                            <li><i class="fa fa-columns" aria-hidden="true"></i>  204 Pages</li>
                            <li><i class="fa fa-calendar" aria-hidden="true"></i>  Thu, Nov 26 2020</li>
                            <li><i class="fa fa-flag-o" aria-hidden="true"></i>  5 Users marked this note as inappropriate</li>
                            <li><span>100 Review</span>
                                <div class="rate">
                                    <input type="radio" id="star5" name="rate" value="5" />
                                    <label for="star5" title="5 star">5 stars</label>
                                    <input type="radio" id="star4" name="rate" value="4" />
                                    <label for="star4" title="4 star">4 stars</label>
                                    <input type="radio" id="star3" name="rate" value="3" />
                                    <label for="star3" title="3 star">3 stars</label>
                                    <input type="radio" id="star2" name="rate" value="2" />
                                    <label for="star2" title="2 star">2 stars</label>
                                    <input type="radio" id="star1" name="rate" value="1" />
                                    <label for="star1" title="1 star">1 star</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                    </div>
                </div>
                <!-- 9 -->
                <div class="note col-md-4 col-sm-6">
                    <div class="border">
                    <div class="note-poster">
                        <img src="images/search/3.jpg" alt="poster">
                    </div>
                    <div class="note-heading">
                        <a href="notedetails.php"><p>Computer Operating System - Final Exam Book With Paper Solution</p></a>
                    </div>
                    <div class="note-info">
                        <ul>
                            <li><i class="fa fa-university" aria-hidden="true"></i>  University of California, US</li>
                            <li><i class="fa fa-columns" aria-hidden="true"></i>  204 Pages</li>
                            <li><i class="fa fa-calendar" aria-hidden="true"></i>  Thu, Nov 26 2020</li>
                            <li><i class="fa fa-flag-o" aria-hidden="true"></i>  5 Users marked this note as inappropriate</li>
                            <li><span>100 Review</span>
                                <div class="rate">
                                    <input type="radio" id="star5" name="rate" value="5" />
                                    <label for="star5" title="5 star">5 stars</label>
                                    <input type="radio" id="star4" name="rate" value="4" />
                                    <label for="star4" title="4 star">4 stars</label>
                                    <input type="radio" id="star3" name="rate" value="3" />
                                    <label for="star3" title="3 star">3 stars</label>
                                    <input type="radio" id="star2" name="rate" value="2" />
                                    <label for="star2" title="2 star">2 stars</label>
                                    <input type="radio" id="star1" name="rate" value="1" />
                                    <label for="star1" title="1 star">1 star</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true"><img src="images/dashboard/left-arrow.png" alt="previous"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link on-page active" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true"><img src="images/dashboard/right-arrow.png" alt="next"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- footer -->
    <section class="footer">
        <div class="container-fluid">
            <hr>
            <div class="row">
                <div class="col-md-6 col footer_content">
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
    </section>
	<!-- filter ends -->
	
	
	
	
	
	<!-- jquery-->
    <script src="js/jquery.min.js"></script>

    <!-- bootstrap js -->
    <script src="js/bootstrap/popper.min.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- custom js -->
    <script src="js/script.js"></script>

</body>
</html>