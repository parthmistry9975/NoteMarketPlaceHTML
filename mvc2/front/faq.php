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
                        <a class="nav-link" href="login.php">Sell Your Notes</a>
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
                        $fetch_image_path_query = "SELECT ProfilePicture FROM user_profile WHERE UserID = ".$_SESSION['ID'];
                        $fetch_image_path = mysqli_query($connection , $fetch_image_path_query);
                        $image_path = mysqli_fetch_assoc($fetch_image_path);
                        $pp_file = "../upload/".$_SESSION['ID']."/profile/".$image_path['ProfilePicture'];
                        echo "<li class='nav-item dropdown'><a class='nav-link' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><img src='$pp_file' alt='login image'>
                            <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                                <a class='dropdown-item' href='userprofile.php'>My Profile</a>
                                <a class='dropdown-item' href='mydownloads.php'>My Downloads</a>
                                <a class='dropdown-item' href='mysoldnotes.php'>My Sold Notes</a>
                                <a class='dropdown-item' href='myrejectednotes.php'>My Rejected Notes</a>
                                <a class='dropdown-item' href='changepw.php'>Change Password</a>
                                <a class='dropdown-item purple' href='logout.php'>LOGOUT</a>
                            </div>
                        </a></li>";
                        echo '<li class="nav-item"><a href="logout.php"><button type="button" class="btn btn-primary btn_login">Logout</button></a></li>';
                    }else{
                        echo '<li class="nav-item"><a href="login.php"><button type="button" class="btn btn-primary btn_login">Login</button></a></li>';
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
                        <h1 class="text-center">Frequently Asked Questions</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Ends <-->
	
	<!-- faq section -->
	<section class="faq-section">
	    <div class="container">
	        <div class="row">
	            <div class="col-md-12 general-que-heading">
	                <h4>General Questions</h4>
	            </div>
	            <div class="container demo">


	                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

	                    <div class="panel panel-default">
	                        <div class="panel-heading" role="tab" id="headingOne">
	                            <h4 class="panel-title">
	                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
	                                    <i class="more-less fa fa-plus"></i>
	                                    <span>What is Marketplace Notes ?</span>
	                                </a>
	                            </h4>
	                        </div>
	                        <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
	                            <div class="panel-body">
	                                Notes Marketplace is an online marketplace for university students to buy and sell their course notes.
	                            </div>
	                        </div>
	                    </div>

	                    <div class="panel panel-default">
	                        <div class="panel-heading" role="tab" id="headingTwo">
	                            <h4 class="panel-title">
	                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
	                                    <i class="more-less fa fa-plus"></i>
	                                    <span>What do the University say?</span>
	                                </a>
	                            </h4>
	                        </div>
	                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
	                            <div class="panel-body">
	                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor.
	                            </div>
	                        </div>
	                    </div>

	                    <div class="panel panel-default">
	                        <div class="panel-heading" role="tab" id="headingThree">
	                            <h4 class="panel-title">
	                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
	                                    <i class="more-less fa fa-plus"></i>
	                                    <span>Is this legal?</span>
	                                </a>
	                            </h4>
	                        </div>
	                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
	                            <div class="panel-body">
	                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
	                            </div>
	                        </div>
	                    </div>

	                </div><!-- panel-group -->


	            </div><!-- container -->
	            <div class="col-md-12 general-que-heading">
	                <h4>Uploaders</h4>
	            </div>
	            <div class="container demo">


	                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

	                    <div class="panel panel-default">
	                        <div class="panel-heading" role="tab" id="headingFour">
	                            <h4 class="panel-title">
	                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
	                                    <i class="more-less fa fa-plus"></i>
	                                    <span>What can't I Sell?</span>
	                                </a>
	                            </h4>
	                        </div>
	                        <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
	                            <div class="panel-body">
	                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
	                            </div>
	                        </div>
	                    </div>

	                    <div class="panel panel-default">
	                        <div class="panel-heading" role="tab" id="headingFive">
	                            <h4 class="panel-title">
	                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
	                                    <i class="more-less fa fa-plus"></i>
	                                    <span>What notes can I sell?</span>
	                                </a>
	                            </h4>
	                        </div>
	                        <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
	                            <div class="panel-body">
	                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
	                            </div>
	                        </div>
	                    </div>

	                </div><!-- panel-group -->


	            </div><!-- container -->
	            <div class="col-md-12 general-que-heading">
	                <h4>General Questions</h4>
	            </div>
	            <div class="container demo">


	                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

	                    <div class="panel panel-default">
	                        <div class="panel-heading" role="tab" id="headingSix">
	                            <h4 class="panel-title">
	                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
	                                    <i class="more-less fa fa-plus"></i>
	                                    <span>How do I buy notes?</span>
	                                </a>
	                            </h4>
	                        </div>
	                        <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
	                            <div class="panel-body">
	                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
	                            </div>
	                        </div>
	                    </div>

	                    <div class="panel panel-default">
	                        <div class="panel-heading" role="tab" id="headingSeven">
	                            <h4 class="panel-title">
	                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
	                                    <i class="more-less fa fa-plus"></i>
	                                    <span>Can i edit the notes I Purchased?</span>
	                                </a>
	                            </h4>
	                        </div>
	                        <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven">
	                            <div class="panel-body">
	                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica.
	                            </div>
	                        </div>
	                    </div>

	                </div><!-- panel-group -->


	            </div><!-- container -->
            </div>
	    </div>
	</section>
	<!-- faq section ends -->
	
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
	
	<!-- jquery-->
    <script src="js/jquery.min.js"></script>

    <!-- bootstrap js -->
    <script src="js/bootstrap/popper.min.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- custom js -->
    <script src="js/script.js"></script>

</body>
</html>