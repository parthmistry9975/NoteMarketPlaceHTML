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
            <a class="navbar-brand" href="index.html"><img src="images/user-profile/logo.png" alt="logo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"><i class="fa fa-bars" aria-hidden="true"></i></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="searchnotes.html">Search Notes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="addnote.html">Sell Your Notes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="buyerrequest.html">Buyer Requests</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="faq.html">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contactus.html">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><img src="images/user-profile/login-image.png" alt="login image"></a>
                    </li>
                    <li class="nav-item">
                        <a href="logout.php"><button type="button" class="btn btn-primary btn_login">Logout</button></a>
                    </li>
                </ul>
            </div>
        </nav>
    </section>
   
    <section class="download-table">
        <div class="container table1">
            <div class="row">
                <div class="download-table-intro col-md-6 col-sm-12">My Downloads</div>
                <form class="search-part col-md-6 col-sm-12 text-right">
                    <input type="text" placeholder="&#x1F50D; Search">
                    <button type="button" class="btn search-btn">Search</button> 
                </form>
            </div>
            <div class="row table-data">
                <table class="table table-responsive">
                    <tr class="table-heading text-center">
                        <th class="srno" scope="col">SR NO.</th>
                        <th class="notetitle" scope="col">NOTE TITLE</th>
                        <th class="downloadcategory" scope="col">CATEGORY</th>
                        <th class="buyer" scope="col">BUYER</th>
                        <th class="downloadselltype" scope="col">SELL TYPE</th>
                        <th class="downloadprice" scope="col">PRICE</th>
                        <th class="date-time" scope="col">DOWNLOAD DATE/TIME</th>
                        <th class="downloadeye" scope="col"></th>
                        <th class="downloadmenu" scope="col"></th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td class="purple-color">Data Science</td>
                        <td>Science</td>
                        <td>testting123@gmail.com</td>
                        <td>Paid</td>
                        <td>$250</td>
                        <td>27 NOV 2020, 11:24:34</td>
                        <td><a href="#"><img src="images/dashboard/eye.png" alt="view"></a></td>
                        <td class="dropdown">
                            <img class="dropdown-toggle" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="images/mydownloads/dots.png" alt="menu">
                            <div class="dropdown-menu" aria-labelledby="dLabel">
                                <a class="dropdown-item" href="#">Download Note</a>
                                <a class="dropdown-item" data-toggle="modal" data-target="#feedback-modal" href="#">Add Reviews/Feedback</a>
                                <a class="dropdown-item" href="#">Report as inappropriate</a>
                            </div>

                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td class="purple-color">Accounts</td>
                        <td>Commerce</td>
                        <td>testting123@gmail.com</td>
                        <td>Free</td>
                        <td>$0</td>
                        <td>27 NOV 2020, 11:24:34</td>
                        <td><a href="#"><img src="images/dashboard/eye.png" alt="view"></a></td>
                        <td class="dropdown">
                            <img class="dropdown-toggle" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="images/mydownloads/dots.png" alt="menu">
                            <div class="dropdown-menu" aria-labelledby="dLabel">
                                <a class="dropdown-item" href="#">Download Note</a>
                                <a class="dropdown-item" data-toggle="modal" data-target="#feedback-modal" href="#">Add Reviews/Feedback</a>
                                <a class="dropdown-item" href="#">Report as inappropriate</a>
                            </div>

                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td class="purple-color">Social Studies</td>
                        <td>Social</td>
                        <td>testting123@gmail.com</td>
                        <td>Free</td>
                        <td>$0</td>
                        <td>27 NOV 2020, 11:24:34</td>
                        <td><a href="#"><img src="images/dashboard/eye.png" alt="view"></a></td>
                        <td class="dropdown">
                            <img class="dropdown-toggle" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="images/mydownloads/dots.png" alt="menu">
                            <div class="dropdown-menu" aria-labelledby="dLabel">
                                <a class="dropdown-item" href="#">Download Note</a>
                                <a class="dropdown-item" data-toggle="modal" data-target="#feedback-modal" href="#">Add Reviews/Feedback</a>
                                <a class="dropdown-item" href="#">Report as inappropriate</a>
                            </div>

                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td class="purple-color">AI</td>
                        <td>IT</td>
                        <td>testting123@gmail.com</td>
                        <td>Paid</td>
                        <td>$158</td>
                        <td>27 NOV 2020, 11:24:34</td>
                        <td><a href="#"><img src="images/dashboard/eye.png" alt="view"></a></td>
                        <td class="dropdown">
                            <img class="dropdown-toggle" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="images/mydownloads/dots.png" alt="menu">
                            <div class="dropdown-menu" aria-labelledby="dLabel">
                                <a class="dropdown-item" href="#">Download Note</a>
                                <a class="dropdown-item" data-toggle="modal" data-target="#feedback-modal" href="#">Add Reviews/Feedback</a>
                                <a class="dropdown-item" href="#">Report as inappropriate</a>
                            </div>

                        </td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td class="purple-color">Lorem ipsum</td>
                        <td>Lorem</td>
                        <td>testting123@gmail.com</td>
                        <td>Free</td>
                        <td>$0</td>
                        <td>27 NOV 2020, 11:24:34</td>
                        <td><a href="#"><img src="images/dashboard/eye.png" alt="view"></a></td>
                        <td class="dropdown">
                            <img class="dropdown-toggle" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="images/mydownloads/dots.png" alt="menu">
                            <div class="dropdown-menu" aria-labelledby="dLabel">
                                <a class="dropdown-item" href="#">Download Note</a>
                                <a class="dropdown-item" data-toggle="modal" data-target="#feedback-modal" href="#">Add Reviews/Feedback</a>
                                <a class="dropdown-item" href="#">Report as inappropriate</a>
                            </div>

                        </td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td class="purple-color">Data Science</td>
                        <td>Science</td>
                        <td>testting123@gmail.com</td>
                        <td>Paid</td>
                        <td>$555</td>
                        <td>27 NOV 2020, 11:24:34</td>
                        <td><a href="#"><img src="images/dashboard/eye.png" alt="view"></a></td>
                        <td class="dropdown">
                            <img class="dropdown-toggle" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="images/mydownloads/dots.png" alt="menu">
                            <div class="dropdown-menu" aria-labelledby="dLabel">
                                <a class="dropdown-item" href="#">Download Note</a>
                                <a class="dropdown-item" data-toggle="modal" data-target="#feedback-modal" href="#">Add Reviews/Feedback</a>
                                <a class="dropdown-item" href="#">Report as inappropriate</a>
                            </div>

                        </td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td class="purple-color">Accounts</td>
                        <td>Commerce</td>
                        <td>testting123@gmail.com</td>
                        <td>Free</td>
                        <td>$0</td>
                        <td>27 NOV 2020, 11:24:34</td>
                        <td><a href="#"><img src="images/dashboard/eye.png" alt="view"></a></td>
                        <td class="dropdown">
                            <img class="dropdown-toggle" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="images/mydownloads/dots.png" alt="menu">
                            <div class="dropdown-menu" aria-labelledby="dLabel">
                                <a class="dropdown-item" href="#">Download Note</a>
                                <a class="dropdown-item" data-toggle="modal" data-target="#feedback-modal" href="#">Add Reviews/Feedback</a>
                                <a class="dropdown-item" href="#">Report as inappropriate</a>
                            </div>

                        </td>
                    </tr>
                    <tr>
                        <td>8</td>
                        <td class="purple-color">Social Studies</td>
                        <td>Social</td>
                        <td>testting123@gmail.com</td>
                        <td>Free</td>
                        <td>$0</td>
                        <td>27 NOV 2020, 11:24:34</td>
                        <td><a href="#"><img src="images/dashboard/eye.png" alt="view"></a></td>
                        <td class="dropdown">
                            <img class="dropdown-toggle" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="images/mydownloads/dots.png" alt="menu">
                            <div class="dropdown-menu" aria-labelledby="dLabel">
                                <a class="dropdown-item" href="#">Download Note</a>
                                <a class="dropdown-item" data-toggle="modal" data-target="#feedback-modal" href="#">Add Reviews/Feedback</a>
                                <a class="dropdown-item" href="#">Report as inappropriate</a>
                            </div>

                        </td>
                    </tr>
                    <tr>
                        <td>9</td>
                        <td class="purple-color">AI</td>
                        <td>IT</td>
                        <td>testting123@gmail.com</td>
                        <td>Paid</td>
                        <td>$250</td>
                        <td>27 NOV 2020, 11:24:34</td>
                        <td><a href="#"><img src="images/dashboard/eye.png" alt="view"></a></td>
                        <td class="dropdown">
                            <img class="dropdown-toggle" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="images/mydownloads/dots.png" alt="menu">
                            <div class="dropdown-menu" aria-labelledby="dLabel">
                                <a class="dropdown-item" href="#">Download Note</a>
                                <a class="dropdown-item" data-toggle="modal" data-target="#feedback-modal" href="#">Add Reviews/Feedback</a>
                                <a class="dropdown-item" href="#">Report as inappropriate</a>
                            </div>

                        </td>
                    </tr>
                    <tr>
                        <td>10</td>
                        <td class="purple-color">Lorem ipsum</td>
                        <td>Lorem</td>
                        <td>testting123@gmail.com</td>
                        <td>Free</td>
                        <td>$115</td>
                        <td>27 NOV 2020, 11:24:34</td>
                        <td><a href="#"><img src="images/dashboard/eye.png" alt="view"></a></td>
                        <td class="dropdown">
                            <img class="dropdown-toggle" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="images/mydownloads/dots.png" alt="menu">
                            <div class="dropdown-menu" aria-labelledby="dLabel">
                                <a class="dropdown-item" href="#">Download Note</a>
                                <a class="dropdown-item" data-toggle="modal" data-target="#feedback-modal" href="#">Add Reviews/Feedback</a>
                                <a class="dropdown-item" href="#">Report as inappropriate</a>
                            </div>

                        </td>
                    </tr>
                </table>
                <ul class="pagination">
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
    
    <!-- Modal -->
    <div class="modal fade review-modal" id="feedback-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <div class="modal-head col-md-12">
        <div class="modal-heading col-md-6">Add Review</div>
      <div class="modal-close col-md-6">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    </div>
     
      <div class="modal-body">
        <div class="container">
            <div class="row">
             <div class="rate">
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
         </div>
          
          <div class="comment-box">
              <label for="exampleInputfname">Comments &#42;</label>
                     <textarea class="form-control" id="exampleInputfname" placeholder="Comments..." rows="5"></textarea>
          </div>
          <div class="submit-button">
              <button type="button" class="btn btn-primary submit-btn">Submit</button>
          </div>
        </div>
      </div>
    </div>
  </div>
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

<li class="nav-item">
    <a class="nav-link" href="searchnotes.html">Search Notes</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="#">Sell Your Notes</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="faq.html">FAQ</a>
</li>
<li class="nav-item">
    <a class="nav-link" href="contactus.html">Contact Us</a>
</li>
<li class="nav-item">
    <a href="#"><button type="button" class="btn btn-primary btn_login">Login</button></a>
</li>