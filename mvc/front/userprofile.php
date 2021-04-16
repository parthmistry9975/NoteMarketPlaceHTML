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
    
	<!-- Banner  -->
        <section class="banner">
            <div class="content-box-banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="text-center">User Profile</h1>
                    </div>
                </div>
            </div>
        </div>
        </section>
        <!-- Banner Ends -->
	
	<!-- profile form -->
	<div class="container">
            <div class="row">
                <form class="profile-form col-md-12">
                    <div class="col-md-12 profile-form-heading">
                        <h2>Basic Profile Details</h2>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="firstname">First Name &#42;</label>
                            <input type="text" class="form-control" id="firstname" placeholder="Enter your first name">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="lastname">Last Name &#42;</label>
                            <input type="text" class="form-control" id="lastname" placeholder="Enter your last name">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">Email &#42;</label>
                            <input type="email" class="form-control" id="email" placeholder="Enter your email address">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="dob">Date Of Birth</label>
                            <input type="date" class="form-control" id="dob" placeholder="Enter your date of birth">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="gender">Gender</label>
                            <select id="gender" class="form-control">
                                <option>Select your gender</option>
                                <option>Male</option>
                                <option>Female</option>
                                <option>Other</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2 col-sm-4">
                            <label for="countrycode">Phone Number</label>
                            <select id="countrycode" class="form-control code">
                                <option>+91</option>
                                <option>+61</option>
                                <option>+43</option>
                                <option>+1</option>
                            </select>
                        </div>
                        <div class="form-group col-md-4 col-sm-8">
                            <label for="phonenumber">&nbsp;</label>
                            <input type="tel" class="form-control phone" id="phonenumber" placeholder="Enter your phone number">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="pp">Profile Picture</label>
                            <input type="file" class="form-control pp-upload" id="pp" name="Upload a picture">
                        </div>
                        <div class="form-group col-md-6">
                            
                        </div>
                    </div>
                
                    <div class="col-md-12 profile-form-heading">
                        <h2>Address Details</h2>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="address1">Address Line 1 &#42;</label>
                            <input type="text" class="form-control" id="address1" placeholder="Enter your address">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="address2">Address Line 2</label>
                            <input type="text" class="form-control" id="address2" placeholder="Enter your address">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="city">City &#42;</label>
                            <input type="text" class="form-control" id="city" placeholder="Enter your city">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="state">State &#42;</label>
                            <input type="text" class="form-control" id="state" placeholder="Enter your state">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="zipcode">ZipCode &#42;</label>
                            <input type="text" class="form-control" id="zipcode" placeholder="Enter your zipcode">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="country">Country &#42;</label>
                            <select id="country" class="form-control">
                                <option>Select your country</option>
                                <option>India</option>
                                <option>USA</option>
                                <option>UK</option>
                                <option>Canada</option>
                                <option>Russia</option>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-12 profile-form-heading">
                        <h2>University and College Information</h2>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="university">University</label>
                            <input type="text" class="form-control" id="university" placeholder="Enter your university">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="college">College</label>
                            <input type="text" class="form-control" id="college" placeholder="Enter your college">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-profile">Submit</button>
                </form>
            </div>
        </div>
	<!-- profile form ends -->
	
	<!-- footer -->
	<section class="footer">
        <div class="container-fluid">
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