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
    <link rel="stylesheet" href="css/responsive.css">

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
                        <a class="nav-link" href="admindashboard.html">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Notes
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="underreview.html">Notes Under Review</a>
                                <a class="dropdown-item" href="publishednotes.html">Published Notes</a>
                                <a class="dropdown-item" href="downloadednotes.html">Downloaded Notes</a>
                                <a class="dropdown-item" href="rejectednotes.html">Rejected Notes</a>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="members.html">Members</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Reports
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Spam Reports</a>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Settings
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Manage System Configuration</a>
                                <a class="dropdown-item" href="#">Manage Administrator</a>
                                <a class="dropdown-item" href="#">Manage Category</a>
                                <a class="dropdown-item" href="#">Manage Type</a>
                                <a class="dropdown-item" href="#">Manage Countries</a>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="images/user-profile/login-image.png" alt="login image">
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="adminprofile.html">Update Profile</a>
                                <a class="dropdown-item" href="change-admin.html">Change Password</a>
                                <a class="dropdown-item dropdown-purple" href="login.html">Logout</a>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="login.html"><button type="button" class="btn btn-primary btn_login">Login</button></a>
                    </li>
                </ul>
            </div>
        </nav>
    </section>

    <section class="dashboard-counter">
       <div class="container">
            <div class="row dashboard-intro">
                <div class="dashboard-heading col-md-12 col-sm-12">Dashboard</div>
                
            </div>
            <div class="row counter">
                <div class="col-md-4 col-sm-4 col-xs-12 counter1">
                    <div class="review-box text-center">
                        <span class="heading">20</span><br>
                        <span class="sub-heading">Numbers of Notes in Review for Publish</span>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 counter2">
                    <div class="notes-box text-center">
                        <span class="heading">103</span><br>
                        <span class="sub-heading">Numbers of New Notes Downloaded<br>(Last 7 days)</span>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 counter3">
                    <div class="registration-box text-center">
                        <span class="heading">223</span><br>
                        <span class="sub-heading">Numbers of New Registration (Last 7 days)</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
   
    <section class="data-table">
        <div class="container table1">
            <div class="row">
                <div class="data-table-intro col-md-12 col-sm-12">Published Notes</div>
                <form class="search-part col-md-12 col-sm-12 col-xs-12 text-right">
                    <div class="form-group">
                        <input type="text" placeholder="&#x1F50D; Search">
                        <button type="button" class="btn search-btn">Search</button>
                        <select class="month-filter">
                            <option>Select month</option>
                            <option>Male</option>
                            <option>Female</option>
                            <option>Other</option>
                        </select>
                    </div>
                </form>
            </div>
            <div class="row table-data">
                <table class="table table-responsive">
                    <tr class="table-heading text-center">
                        <th class="srno" scope="col">SR NO.</th>
                        <th class="title" scope="col">TITLE</th>
                        <th class="category" scope="col">CATEGORY</th>
                        <th class="attachmentsize" scope="col">ATTACHMENT SIZE</th>
                        <th class="selltype" scope="col">SELL TYPE</th>
                        <th class="price" scope="col">PRICE</th>
                        <th class="publisher" scope="col">PUBLISHER</th>
                        <th class="publisheddate" scope="col">PUBLISHED DATE</th>
                        <th class="downloads" scope="col">NUMBER OF DOWNLOADS</th>
                        <th class="dropdown" scope="col"></th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td class="purple-color">Data Science</td>
                        <td>Science</td>
                        <td>10 KB</td>
                        <td>Free</td>
                        <td>$0</td>
                        <td>Pritesh Panchal</td>
                        <td>09-10-2020, 10:10</td>
                        <td>10</td>
                        <td class="dropdown">
                            <img class="dropdown-toggle" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="images/mydownloads/dots.png" alt="menu">
                            <div class="dropdown-menu" aria-labelledby="dLabel">
                                <a class="dropdown-item" href="#">Download Notes</a>
                                <a class="dropdown-item" data-toggle="modal" data-target="#feedback-modal" href="#">View More Details</a>
                                <a class="dropdown-item" href="#">Unpublish</a>
                            </div>    
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td class="purple-color">Accounts</td>
                        <td>Commerce</td>
                        <td>23 MB</td>
                        <td>Paid</td>
                        <td>$22</td>
                        <td>Rahil Shah</td>
                        <td>10-10-2020, 12:30</td>
                        <td>21</td>
                        <td class="dropdown">
                            <img class="dropdown-toggle" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="images/mydownloads/dots.png" alt="menu">
                            <div class="dropdown-menu" aria-labelledby="dLabel">
                                <a class="dropdown-item" href="#">Download Notes</a>
                                <a class="dropdown-item" data-toggle="modal" data-target="#feedback-modal" href="#">View More Details</a>
                                <a class="dropdown-item" href="#">Unpublish</a>
                            </div>    
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td class="purple-color">Social Studies</td>
                        <td>Social</td>
                        <td>3 MB</td>
                        <td>Paid </td>
                        <td>$56</td>
                        <td>Anish Patel</td>
                        <td>11-10-2020, 01:10</td>
                        <td>13</td>
                        <td class="dropdown">
                            <img class="dropdown-toggle" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="images/mydownloads/dots.png" alt="menu">
                            <div class="dropdown-menu" aria-labelledby="dLabel">
                                <a class="dropdown-item" href="#">Download Notes</a>
                                <a class="dropdown-item" data-toggle="modal" data-target="#feedback-modal" href="#">View More Details</a>
                                <a class="dropdown-item" href="#">Unpublish</a>
                            </div>    
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td class="purple-color">AI</td>
                        <td>IT</td>
                        <td>1 MB</td>
                        <td>Free</td>
                        <td>$0</td>
                        <td>Vijay Vaishnav</td>
                        <td>12-10-2020, 10:10</td>
                        <td>50</td>
                        <td class="dropdown">
                            <img class="dropdown-toggle" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="images/mydownloads/dots.png" alt="menu">
                            <div class="dropdown-menu" aria-labelledby="dLabel">
                                <a class="dropdown-item" href="#">Download Notes</a>
                                <a class="dropdown-item" data-toggle="modal" data-target="#feedback-modal" href="#">View More Details</a>
                                <a class="dropdown-item" href="#">Unpublish</a>
                            </div>    
                        </td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td class="purple-color">Lorem ipsum</td>
                        <td>Lorem</td>
                        <td>105 KB</td>
                        <td>Paid</td>
                        <td>$90</td>
                        <td>Mehul Patel</td>
                        <td>13-10-2020, 11:25</td>
                        <td>20</td>
                        <td class="dropdown">
                            <img class="dropdown-toggle" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="images/mydownloads/dots.png" alt="menu">
                            <div class="dropdown-menu" aria-labelledby="dLabel">
                                <a class="dropdown-item" href="#">Download Notes</a>
                                <a class="dropdown-item" data-toggle="modal" data-target="#feedback-modal" href="#">View More Details</a>
                                <a class="dropdown-item" href="#">Unpublish</a>
                            </div>    
                        </td>
                    </tr>
                </table>
                <ul class="pagination">
                    <li class="page-item">
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
                    <li class="page-item">
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

    <!-- custom js -->
    <script src="js/script.js"></script>

</body>
</html>