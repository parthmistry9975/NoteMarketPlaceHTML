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
    
    <!-- Modal -->
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="downloadmodaltitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-close-button">    
                        <input type="image" id="image" alt="popup" class="close" data-dismiss="modal" aria-label="Close" src="images/note-details/close.png">
                    </div>   
                    <div class="head-modal text-center">
                        <img src="images/note-details/SUCCESS.png" alt="success">
                        <h3>Thank you for purchasing</h3>
                    </div> 
                    <div class="text-modal text-left">
                        <h6><span>Dear <?php if(isset($_SESSION['FNAME'])){ echo $_SESSION['FNAME'];} ?>,</span></h6>
                        <p>As this is paid notes - you need to pay to seller Rahil Shah offline. We will send him an email that 
                        you want to download this note. He may contact you further for payment process completion.</p>
                        <p>In case, you have urgency,<br>Please contact us on +9195377345959.</p>
                        <p>Once he receives the payment and acknowledge us - selected notes you can see over my downloads tab 
                        for download.</p>
                        <p>Have a good day.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
	<section id="notedetails">

        <div class="container line">

            <div class="row">
                <div class="col-md-12">
                    <h4>Note Details</h4>
                </div>
            </div>
            
            <?php 
            
                
            
            ?>

            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="row">
                        <div class="col-md-5 col-12">
                            <img src="images/note-details/first.jpg" alt="book" class="img-fluid" style="height: 300px">
                        </div>
                        <div class="col-lg-7 col-md-12 col-sm-12 col-12">
                            <h3>Computer Science</h3>
                            <p><span>Science</span></p>
                            <p id="review">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatum facilis quo dolorum maiores, vel mollitia ullam sunt quaerat qui quasi inventore perferendis incidunt?</p>
                            <button role="button" class="btn btn-primary" <?php if(isset($_SESSION['ID'])){ echo 'data-toggle="modal" data-target="#exampleModal"';} else{ echo 'id="openlogin"'; }?>>DOWNLOAD / $15</button>
                            <script>
                            
                                document.getElementById("openlogin").onclick = function (){
                                  location.href ="login.php";  
                                };
                            
                            </script>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="row">
                        <div class="col-md-7 col-6">
                            <div class="details">
                                <p>Institution:</p>
                                <p>Country:</p>
                                <p>Course Name:</p>
                                <p>Course Code:</p>
                                <p>Professor:</p>
                                <p>Number of Pages:</p>
                                <p>Approved Date:</p>
                                <p>Rating:</p>
                            </div>
                        </div>
                        <div class="col-md-5 col-6">
                            <div class="details-info">
                                <p>University of California:</p>
                                <p>United State</p>
                                <p>Computer Engineering</p>
                                <p>248705</p>
                                <p>Mr.Richard Brown</p>
                                <p>277</p>
                                <p>November 25 2020</p>
                                <div class="rate star-margin">
                                    <input type="radio" id="star5" name="rate" value="5" />
                                    <label for="star5" title="text">5 stars</label>
                                    <input type="radio" id="star4" name="rate" value="4" />
                                    <label for="star4" title="text">4 stars</label>
                                    <input type="radio" id="star3" name="rate" value="3" />
                                    <label for="star3" title="text">3 stars</label>
                                    <input type="radio" id="star2" name="rate" value="2" />
                                    <label for="star2" title="text">2 stars</label>
                                    <input type="radio" id="star1" name="rate" value="1" />
                                    <label for="star1" title="text">1 star</label>
                                </div>
                                <p id="star-review">100 Review</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <p id="red-text">5 users marked this note as inappropriate</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="general-height">
    <section id="notepreview">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-12 col-sm-12 col-12">
                    <h4>Notes Preview</h4>
                    

                    <!-- responsive iframe -->
                    <!-- ============== -->

                    <div id="Iframe-Cicis-Menu-To-Go" class="set-margin-cicis-menu-to-go set-padding-cicis-menu-to-go set-border-cicis-menu-to-go set-box-shadow-cicis-menu-to-go center-block-horiz">
                        <div class="responsive-wrapper 
     responsive-wrapper-padding-bottom-90pct" style="-webkit-overflow-scrolling: touch; overflow: auto;">
                            <iframe src="http://unec.edu.az/application/uploads/2014/12/pdf-sample.pdf">
                                <p style="font-size: 110%;"><em><strong>ERROR: </strong>
                                        An &#105;frame should be displayed here but your browser version does not support &#105;frames.</em> Please update your browser to its most recent version and try again, or access the file <a href="http://unec.edu.az/application/uploads/2014/12/pdf-sample.pdf">with this link.</a></p>
                            </iframe>
                        </div>
                    </div>


               
                </div>
                
                
                
                
                <div class="col-lg-7 col-md-12 col-sm-12 col-12">
                    <h4>Customer Review</h4>
                    
                    
                    <div class="container border-black">
                        <div class="row bottom-black">
                            <div class="col-md-2">
                                <img src="images/user-profile/login-image.png" class="img-fluid rounded-circle" alt="user">
                            </div>
                            <div class="col-md-10">
                               <div class="row">
                               <div class="col-lg-11 col-md-11 col-sm-11 col-10">
                                   <h6>Richard Brown</h6>
                                <div class="rate1 rate-space">
                                    <div class="rate"></div>
                                </div>
                               </div>
                               
                                
                                </div>
                            </div>



                            <div class="col-md-2"></div>
                            <div class="col-md-10">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem optio, ullam dolor iure hic laboriosam tempora quae, vero incidunt, quia illum deleniti, asperiores.</p>
                            </div>


                        </div>

                        <div class="row bottom-black">
                            <div class="col-md-2">
                                <img src="images/note-details/reviewer-3.png" class="img-fluid rounded-circle" alt="user">
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                               <div class="col-lg-11 col-md-11 col-sm-11 col-10">
                                   <h6>Alice Ortiaz</h6>
                                <div class="rate1 rate-space">
                                    <div class="rate"></div>
                                </div>
                               </div>
                               
                                
                                </div>
                            </div>

                            <div class="col-md-2"></div>
                            <div class="col-md-10">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem optio, ullam dolor iure hic laboriosam tempora quae, vero incidunt, quia illum deleniti, asperiores.</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-2">
                                <img src="images/note-details/reviewer-2.png" class="img-fluid rounded-circle" alt="user">
                            </div>
                            <div class="col-md-10">
                                <div class="row">
                               <div class="col-lg-11 col-md-11 col-sm-11 col-10">
                                   <h6>Sara Passmore</h6>
                                <div class="rate1 rate-space">
                                    <div class="rate"></div>
                                </div>
                               </div>
                               
                                
                                </div>
                            </div>



                            <div class="col-md-2"></div>
                            <div class="col-md-10">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Rem optio, ullam dolor iure hic laboriosam tempora quae, vero incidunt, quia illum deleniti, asperiores.</p>
                            </div>
                        </div>
                    </div><br>
                
                </div>
            </div>


            
        </div>
    </section>
    </div>
	
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