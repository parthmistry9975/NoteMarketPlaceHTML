<?php ob_start(); ?>
<?php include 'includes/db.php'; ?>
<?php  

    session_start();
    if(isset($_SESSION['ROLE'])){
        if($_SESSION['ROLE'] != 3){
            header("location:../admin/admindashboard.php?admin=1");
        }
    }
    if(isset($_SESSION['reqreg']) and $_SESSION['reqreg'] == 'yes'){
        $_SESSION['status'] = "your request has been registered please wait untill seller allowed to download !!";
        $_SESSION['status_code'] = "info";
        unset($_SESSION['reqreg']);
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
                        if(!empty($image_path['ProfilePicture'])){
                            $pp_file = $image_path['ProfilePicture'];
                        }else{
                            $pp_file = "images/default/profile/dp.jpg";
                        }
                        
                        ?><li class='nav-item dropdown'><a class='nav-link' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><img src='<?php echo $pp_file; ?>' alt='login image'>
                            <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                                <a class='dropdown-item' href='userprofile.php'>My Profile</a>
                                <a class='dropdown-item' href='mydownloads.php'>My Downloads</a>
                                <a class='dropdown-item' href='mysoldnotes.php'>My Sold Notes</a>
                                <a class='dropdown-item' href='myrejectednotes.php'>My Rejected Notes</a>
                                <a class='dropdown-item' href='changepw.php'>Change Password</a>
                                <a class='dropdown-item purple' href='logout.php'>LOGOUT</a>
                            </div>
                        </a></li><li class="nav-item"><a href="logout.php"><button type="button" class="btn btn-primary btn_login">Logout</button></a></li><?php
                    }else{
                        ?>
                        <li class="nav-item"><a href="login.php"><button type="button" class="btn btn-primary btn_login">Login</button></a></li>
                        <?php
                    }
                    
                    ?>
                </ul>
            </div>
        </nav>
    </section>
    
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
                        <p>As this is paid notes - you need to pay to seller <?php if(isset($_SESSION['sellername'])){ echo $_SESSION['sellername'];} ?> offline. We will send him an email that 
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

            if(isset($_GET['noteid'])){

                $noteid = $_GET['noteid'];

                $fetch_note_general_data_query = "SELECT users.FirstName AS sellerfname , users.LastName AS sellerlname , seller_notes.SellerID AS sellerid , seller_notes.DisplayPicture AS displaypicname , seller_notes.Title AS notetitle , note_categories.Name AS notecategory , seller_notes.Description AS notedescription , seller_notes.IsPaid AS sellfor , seller_notes.SellingPrice AS noteprice , seller_notes.UniversityName AS UniversityName , countries.Name AS countryname , seller_notes.Course AS coursename , seller_notes.CourseCode AS coursecode , seller_notes.Professor AS professor , seller_notes.NumberofPages AS pages , seller_notes.PublishedDate AS publisheddate , seller_notes.NotesPreview AS notepreview FROM seller_notes INNER JOIN note_categories ON note_categories.ID = seller_notes.Category INNER JOIN countries ON countries.ID = seller_notes.Country INNER JOIN users ON users.ID = seller_notes.SellerID WHERE seller_notes.ID = $noteid AND seller_notes.IsActive = 1 ";
                $fetch_note_general_data = mysqli_query($connection, $fetch_note_general_data_query);
                $note_general_data = mysqli_fetch_assoc($fetch_note_general_data);
                $_SESSION['sellername'] = $note_general_data['sellerfname'] . " " . $note_general_data['sellerlname'];
                
                
                $fetch_note_rate_data_query = "SELECT AVG(seller_notes_reviews.Ratings) AS ratings , COUNT(seller_notes_reviews.Ratings) AS ratecount , seller_notes_reviews.Comments AS comments FROM seller_notes_reviews WHERE seller_notes_reviews.NoteID = $noteid AND IsActive = 1 ";
                $fetch_note_rate_data = mysqli_query($connection ,$fetch_note_rate_data_query);
                $note_rate_data = mysqli_fetch_assoc($fetch_note_rate_data);
                $note_ratenum_data = $note_rate_data['ratecount'];
                $note_ratestar_data = round($note_rate_data['ratings']);
                
                $fetch_note_report_data_query = "SELECT * FROM seller_notes_reported_issues WHERE NoteID = $noteid";
                $fetch_note_report_data = mysqli_query($connection ,$fetch_note_report_data_query);
                $note_report_data = mysqli_num_rows($fetch_note_report_data);

            }else{
                ?>
                <script>

                    location.replace("userdashboard.php");

                </script>
                <?php
            }

            ?>

            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="row">
                        <div class="col-md-5 col-12">
                            <?php
                            
                                $displaypicname = $note_general_data['displaypicname'];
                                $sellerid = $note_general_data['sellerid'] ;
                                
                                if(!empty($displaypicname)){

                                    $displaypicpath = "../upload/$sellerid/$noteid/$displaypicname";

                                }else{

                                    $displaypicpath = "images/default/note/dnp.jpg";
                                
                                }

                            
                            ?>
                            <img src="<?php echo $displaypicpath; ?>" alt="book" class="img-fluid" style="height: 300px">
                        </div>
                        <div class="col-lg-7 col-md-12 col-sm-12 col-12">
                            <h3><?php echo $note_general_data['notetitle']; ?></h3>
                            <p><span><?php echo $note_general_data['notecategory']; ?></span></p>
                            <p id="review"><?php echo $note_general_data['notedescription']; ?></p>
                            <a href="<?php 
                                        if(isset($_SESSION['ID'])){ 
                                            if($note_general_data['sellfor'] == 1){
                                                echo "makebuyerrequestentry.php?noteid=$noteid";  
                                            }else{ 
                                                echo "download.php?noteid=$noteid&downloadentry=1"; 
                                            } 
                                        } else{ 
                                            echo '#'; 
                                        }
                                    ?>"><button role="button" class="btn btn-primary <?php 
                                        if(isset($_SESSION['ID'])){ 
                                            if($note_general_data['sellfor'] == 1){ 
                                                echo 'sendmailtoseller';   
                                            }
                                        }
                                    ?>"
                                    
                                    <?php 
                                        if(isset($_SESSION['ID'])){ 
                                            if($note_general_data['sellfor'] == 1){ 
                                                echo "data-toggle='modal' data-target='#exampleModal'";
                                                echo 'id="thanks-for-buying-modal-link"';
                                            }else{ 
                                                echo ""; 
                                            } 
                                        } else{ 
                                            echo 'id="openlogin"'; 
                                        }
                                    ?> >
                                    
                                    <?php
                                        if($note_general_data['sellfor'] == 1){
                                            echo "DOWNLOAD / " . $note_general_data['noteprice'];  
                                        }else{
                                            echo "DOWNLOAD";
                                        }
                                    ?>
                            </button></a>
                            
                            
<!--//                          -->
                           
                            
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
                                <p id="uniname"><?php if(!empty($note_general_data['UniversityName'])) {echo $note_general_data['UniversityName']; }else{ echo "-";} ?></p>
                                <p><?php if(!empty($note_general_data['countryname'])) {echo $note_general_data['countryname']; }else{ echo "-";} ?></p>
                                <p><?php if(!empty($note_general_data['coursename'])) {echo $note_general_data['coursename']; }else{ echo "-";} ?></p>
                                <p><?php if(!empty($note_general_data['coursecode'])) {echo $note_general_data['coursecode']; }else{ echo "-";} ?></p>
                                <p><?php if(!empty($note_general_data['professor'])) {echo $note_general_data['professor']; }else{ echo "-";} ?></p>
                                <p><?php echo $note_general_data['pages']; ?></p>
                                <p class="<?php if(empty($note_general_data['publisheddate'])){ echo "text-right";} ?>">
                                    <?php 
                                        if(empty($note_general_data['publisheddate'])){
                                            echo "-";
                                        }else{
                                            echo date("M d Y", strtotime($note_general_data['publisheddate']));
                                        }
                                    ?>
                                </p>
                                <div id="notedetailsrate">
                                    <?php
                                        for ($i = 0; $i < $note_ratestar_data; $i++) {
                                            echo "<img style='width:20px;height:20px;' src='images/note-details/star.png'>&nbsp;";
                                        }
                                        for ($j = 0; $j < (5 - $note_ratestar_data); $j++) {
                                            echo "<img style='width:20px;height:20px;' src='images/note-details/star-white.png'>&nbsp;";
                                        }
                                    ?>
                                    <span style="color: #6255a5;line-height: 16px;text-align: right;font-weight: 600;font-size: 14px;margin-left: 20px;" id="numberreview">
                                    <?php
                                        echo $note_ratenum_data . " reviews";
                                    ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row"> 
                        <p style="color: red;font-size: 14px;margin-left: 140px;">
                        <?php
                            
                            if($note_report_data >= 1){
                                $reportnum = $note_report_data;
                                echo $reportnum;
                                echo " users marked this note as inappropriate";
                            }
                            
                        ?>
                        </p>
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
                    <?php
                    
                        $previewname = $note_general_data['notepreview'];
                        $sellerid = $note_general_data['sellerid'] ;  
                        $previewpath = "../upload/$sellerid/$noteid/$previewname";
                    
                    ?>
                    

                    <!-- responsive iframe -->
                    <!-- ============== -->

                    <div id="Iframe-Cicis-Menu-To-Go" class="set-margin-cicis-menu-to-go set-padding-cicis-menu-to-go set-border-cicis-menu-to-go set-box-shadow-cicis-menu-to-go center-block-horiz">
                        <div class="responsive-wrapper 
     responsive-wrapper-padding-bottom-90pct" style="-webkit-overflow-scrolling: touch; overflow: auto;">
                            <iframe src="<?php echo $previewpath; ?>">
                                <p style="font-size: 110%;"><em><strong>ERROR: </strong>
                                        An &#105;frame should be displayed here but your browser version does not support &#105;frames.</em> Please update your browser to its most recent version and try again, or access the file <a href="http://unec.edu.az/application/uploads/2014/12/pdf-sample.pdf">with this link.</a></p>
                            </iframe>
                        </div>
                    </div>


               
                </div>
                
                
                
                
                <div class="col-lg-7 col-md-12 col-sm-12 col-12">
                    <h4>Customer Review</h4>
                    
                    
                    
                    <div class="container border-black">
                        
                        <?php
                    
                            $fetch_customer_review_query = "SELECT users.ID AS reviewerid , users.FirstName AS reviewerfname , users.LastName AS reviewerlname , user_profile.ProfilePicture AS profilepicname , seller_notes_reviews.Ratings , seller_notes_reviews.Comments AS comments FROM seller_notes_reviews INNER JOIN users ON users.ID = seller_notes_reviews.ReviewedByID INNER JOIN user_profile ON user_profile.UserID = seller_notes_reviews.ReviewedByID WHERE seller_notes_reviews.NoteID = $noteid AND seller_notes_reviews.IsActive = 1";
                            $fetch_customer_review = mysqli_query($connection ,$fetch_customer_review_query);
                            $check_comment = mysqli_num_rows($fetch_customer_review);
                            if($check_comment == 0 ){
                                echo "<h1 class='text-center' style='color:#6255a5;margin-top:150px;font-weight:600;'> 0 Reviews</h1>";
                            }else{
                            while($review_row = mysqli_fetch_assoc($fetch_customer_review)){

                        ?>
                        
                        <div class="row bottom-black">
                            <div class="col-md-2">
                                <?php 
                                
                                if(isset($review_row['profilepicname'])){
                                    $displaypicpath = $review_row['profilepicname'];
                                }else{
                                    $displaypicpath = 'images/default/profile/dp.jpg';
                                }
                                
                                
                                ?>
                                <img class="reviewer-photo" src="<?php echo $displaypicpath; ?>" class="img-fluid rounded-circle" alt="user">
                            </div>
                            <div class="col-md-10">
                               <div class="row">
                               <div class="col-lg-11 col-md-11 col-sm-11 col-10">
                                   <h6><?php echo $review_row['reviewerfname']." ".$review_row['reviewerlname']; ?></h6>
                                <div class="rate1 rate-space">
                                    <div class="rate">&nbsp;&nbsp;
                                        <?php
                                            for ($i = 0; $i <$review_row['Ratings']; $i++) {
                                                echo "<img src='images/note-details/star.png'>&nbsp;";
                                            }
                                            for ($j = 0; $j < (5 - $review_row['Ratings']); $j++) {
                                                echo "<img src='images/note-details/star-white.png'>&nbsp;";
                                            }
                                        ?>
                                    </div>
                                </div>
                               </div>
                               
                                
                                </div>
                            </div>



                            <div class="col-md-2"></div>
                            <div class="col-md-10">
                                <p><?php echo $review_row['comments'];  ?></p>
                            </div>


                        </div>
                        <?php
                            }
                            }
                        ?>

                        
                    </div><br>
                
                </div>
            </div>
        </div>
    </section>
    </div>
	
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

        $(document).on("click", ".sendmailtoseller", function () {
        var mail= $(this).data('id');
        $(".modal-body #reviewpost").val( myBookId );
        });

    </script>
    <?php
    
    if(isset($_SESSION['showmodal'])){
        ?>
        <script>
        
            $(document).ready(function() {
                $('#thanks-for-buying-modal-link').click();
            });
        
        </script>
        <?php
        unset($_SESSION['showmodal']);
    }
    
    ?>

</body>
</html>