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
   
    <section class="rejectnote-table">
        <div class="container table1">
            <div class="row">
                <div class="rejectnote-table-intro col-md-6">My Rejected Notes</div>
                <form class="search-part col-md-6 text-right">
                    <input type="text" placeholder="&#x1F50D; Search">
                    <button type="button" class="btn search-btn">Search</button> 
                </form>
            </div>
            <div class="row table-data table-responsive">
                <table class="table">
                    <tr class="table-heading text-center">
                        <th class="rejectedsrno" scope="col">SR NO.</th>
                        <th class="rejectednotetitle" scope="col">NOTE TITLE</th>
                        <th class="rejectedcategory" scope="col">CATEGORY</th>
                        <th class="remarks" scope="col">REMARKS</th>
                        <th class="clone" scope="col">CLONE</th>
                        <th class="rejectmenu" scope="col"></th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td class="purple-color">Data Science</td>
                        <td>Science</td>
                        <td>Lorem ipsum dolor sit amet consectetur adipi.</td>
                        <td class="purple-color">Clone</td>
                        <td class="dropdown">
                            <img class="dropdown-toggle" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="images/mydownloads/dots.png" alt="menu">
                            <div class="dropdown-menu" aria-labelledby="dLabel">
                                <a class="dropdown-item" href="#">Download Note</a>
                            </div>

                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td class="purple-color">Accounts</td>
                        <td>Commerce</td>
                        <td>Lorem ipsum dolor sit amet consectetur adipi.</td>
                        <td class="purple-color">Clone</td>
                        <td class="dropdown">
                            <img class="dropdown-toggle" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="images/mydownloads/dots.png" alt="menu">
                            <div class="dropdown-menu" aria-labelledby="dLabel">
                                <a class="dropdown-item" href="#">Download Note</a>
                            </div>

                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td class="purple-color">Social Studies</td>
                        <td>Social</td>
                        <td>Lorem ipsum dolor sit amet consectetur adipi.</td>
                        <td class="purple-color">Clone</td>
                        <td class="dropdown">
                            <img class="dropdown-toggle" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="images/mydownloads/dots.png" alt="menu">
                            <div class="dropdown-menu" aria-labelledby="dLabel">
                                <a class="dropdown-item" href="#">Download Note</a>
                            </div>

                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td class="purple-color">AI</td>
                        <td>IT</td>
                        <td>Lorem ipsum dolor sit amet consectetur adipi.</td>
                        <td class="purple-color">Clone</td>
                        <td class="dropdown">
                            <img class="dropdown-toggle" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="images/mydownloads/dots.png" alt="menu">
                            <div class="dropdown-menu" aria-labelledby="dLabel">
                                <a class="dropdown-item" href="#">Download Note</a>
                            </div>

                        </td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td class="purple-color">Lorem ipsum</td>
                        <td>Lorem</td>
                        <td>Lorem ipsum dolor sit amet consectetur adipi.</td>
                        <td class="purple-color">Clone</td>
                        <td class="dropdown">
                            <img class="dropdown-toggle" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="images/mydownloads/dots.png" alt="menu">
                            <div class="dropdown-menu" aria-labelledby="dLabel">
                                <a class="dropdown-item" href="#">Download Note</a>
                            </div>

                        </td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td class="purple-color">Data Science</td>
                        <td>Science</td>
                        <td>Lorem ipsum dolor sit amet consectetur adipi.</td>
                        <td class="purple-color">Clone</td>
                        <td class="dropdown">
                            <img class="dropdown-toggle" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="images/mydownloads/dots.png" alt="menu">
                            <div class="dropdown-menu" aria-labelledby="dLabel">
                                <a class="dropdown-item" href="#">Download Note</a>
                            </div>

                        </td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td class="purple-color">Accounts</td>
                        <td>Commerce</td>
                        <td>Lorem ipsum dolor sit amet consectetur adipi.</td>
                        <td class="purple-color">Clone</td>
                        <td class="dropdown">
                            <img class="dropdown-toggle" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="images/mydownloads/dots.png" alt="menu">
                            <div class="dropdown-menu" aria-labelledby="dLabel">
                                <a class="dropdown-item" href="#">Download Note</a>
                            </div>

                        </td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td class="purple-color">Social Studies</td>
                        <td>Social</td>
                        <td>Lorem ipsum dolor sit amet consectetur adipi.</td>
                        <td class="purple-color">Clone</td>
                        <td class="dropdown">
                            <img class="dropdown-toggle" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="images/mydownloads/dots.png" alt="menu">
                            <div class="dropdown-menu" aria-labelledby="dLabel">
                                <a class="dropdown-item" href="#">Download Note</a>
                            </div>

                        </td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td class="purple-color">AI</td>
                        <td>IT</td>
                        <td>Lorem ipsum dolor sit amet consectetur adipi.</td>
                        <td class="purple-color">Clone</td>
                        <td class="dropdown">
                            <img class="dropdown-toggle" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="images/mydownloads/dots.png" alt="menu">
                            <div class="dropdown-menu" aria-labelledby="dLabel">
                                <a class="dropdown-item" href="#">Download Note</a>
                            </div>

                        </td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td class="purple-color">Lorem ipsum</td>
                        <td>Lorem</td>
                        <td>Lorem ipsum dolor sit amet consectetur adipi.</td>
                        <td class="purple-color">Clone</td>
                        <td class="dropdown">
                            <img class="dropdown-toggle" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="images/mydownloads/dots.png" alt="menu">
                            <div class="dropdown-menu" aria-labelledby="dLabel">
                                <a class="dropdown-item" href="#">Download Note</a>
                            </div>

                        </td>
                    </tr>
                </table>
                <ul class="pagination pagination-small">
                    <li class="page-item aeros">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true"><img src="images/dashboard/left-arrow.png" alt="previous"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link on-page" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">4</a></li>
                    <li class="page-item"><a class="page-link" href="#">5</a></li>
                    <li class="page-item aeros">
                        <a class="page-link" href="#" aria-label="Next">
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