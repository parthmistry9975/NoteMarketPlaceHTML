<?php ob_start(); ?>
<?php include 'includes/db.php'; ?>
<?php  

    session_start();
    if($_GET['admin'] != 1){
        header("location:../front/login.php");
    }
    if(!isset($_SESSION['ID'])){
        header("location:../front/login.php");
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
        <nav class="navbar navbar-expand-lg bottom-box-effect container-fluid">
            <a class="navbar-brand" href="index.html"><img src="images/user-profile/logo.png" alt="logo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"><i class="fa fa-bars" aria-hidden="true"></i></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="admindashboard.php?admin=1">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Notes
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="underreview.php?admin=1">Notes Under Review</a>
                                <a class="dropdown-item" href="publishednotes.php?admin=1">Published Notes</a>
                                <a class="dropdown-item" href="downloadednotes.php?admin=1">Downloaded Notes</a>
                                <a class="dropdown-item" href="rejectednotes.php?admin=1">Rejected Notes</a>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="members.php?admin=1">Members</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Reports
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="spam-reports.php?admin=1">Spam Reports</a>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Settings
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <?php 
                                    $fetch_role_query = "SELECT RoleID FROM users WHERE ID = ".$_SESSION['ID'];
                                    $fetch_role = mysqli_query($connection , $fetch_role_query);
                                    $role = mysqli_fetch_assoc($fetch_role);
                                    $check_role = $role['RoleID'];
                                    if($check_role == 1){
                                        echo '<a class="dropdown-item" href="managesystemconfiguration.php?admin=1">Manage System Configuration</a>
                                <a class="dropdown-item" href="manageadministrator.php?admin=1">Manage Administrator</a>
                                <a class="dropdown-item" href="managecategory.php?admin=1">Manage Category</a>
                                <a class="dropdown-item" href="managetype.php?admin=1">Manage Type</a>
                                <a class="dropdown-item" href="managecountry.php?admin=1">Manage Countries</a>';
                                    }else{
                                        echo '<a class="dropdown-item" href="managecategory.php?admin=1">Manage Category</a>
                                <a class="dropdown-item" href="managetype.php?admin=1">Manage Type</a>
                                <a class="dropdown-item" href="managecountry.php?admin=1">Manage Countries</a>';
                                    }
                                ?>
                                
                            </div>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <?php
                        
                            $fetch_image_path_query = "SELECT ProfilePicture FROM user_profile WHERE UserID = ".$_SESSION['ID'];
                            $fetch_image_path = mysqli_query($connection , $fetch_image_path_query);
                            $fetch_image_num = mysqli_num_rows($fetch_image_path);
                            if($fetch_image_num == 0 ){
                                $pp_file="images/note-details/close.png";
                            }else{
                                $image_path = mysqli_fetch_assoc($fetch_image_path);
                                $pp_file = "../upload/admin/".$_SESSION['ID']."/".$image_path['ProfilePicture'];
                            }
                        
                        ?>
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo $pp_file; ?>" alt="login image">
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="adminprofile.php?admin=1">Update Profile</a>
                                <a class="dropdown-item" href="change-admin.php?admin=1">Change Password</a>
                                <a class="dropdown-item dropdown-purple" href="logout.php">Logout</a>
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

                    alert('note is deleted');
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
                                $displaypicpath = "../upload/$sellerid/$noteid/$displaypicname";
                            
                            ?>
                            <img src="<?php echo $displaypicpath; ?>" alt="book" class="img-fluid" style="height: 300px">
                        </div>
                        <div class="col-lg-7 col-md-12 col-sm-12 col-12">
                            <h3><?php echo $note_general_data['notetitle']; ?></h3>
                            <p><span><?php echo $note_general_data['notecategory']; ?></span></p>
                            <p id="review"><?php echo $note_general_data['notedescription']; ?></p>
                            <a class="download-button" href="download.php?noteid=<?php echo $noteid; ?>"><button role="button" class="btn btn-primary">DOWNLOAD</button></a>
                            
                            
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
                                <p><?php echo $note_general_data['UniversityName']; ?></p>
                                <p><?php echo $note_general_data['countryname']; ?></p>
                                <p><?php echo $note_general_data['coursename']; ?></p>
                                <p><?php echo $note_general_data['coursecode']; ?></p>
                                <p><?php echo $note_general_data['professor']; ?></p>
                                <p><?php echo $note_general_data['pages']; ?></p>
                                <p class="<?php if(empty($note_general_data['publisheddate'])){ echo "text-right";} ?>">
                                    <?php 
                                        if(empty($note_general_data['publisheddate'])){
                                            echo "-";
                                        }else{
                                            echo $note_general_data['publisheddate'];
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
                                    <span style="color: #6255a5;line-height: 16px;text-align: right;font-weight: 600;font-size: 14px;margin-left: 15px;" id="numberreview">
                                    <?php
                                        echo $note_ratenum_data . " reviews";
                                    ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row"> 
                        <p id="red-text">
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
                    
                            $fetch_customer_review_query = "SELECT seller_notes_reviews.ID AS reviewid, users.ID AS reviewerid , users.FirstName AS reviewerfname , users.LastName AS reviewerlname , user_profile.ProfilePicture AS profilepicname , seller_notes_reviews.Ratings , seller_notes_reviews.Comments AS comments FROM seller_notes_reviews INNER JOIN users ON users.ID = seller_notes_reviews.ReviewedByID INNER JOIN user_profile ON user_profile.UserID = seller_notes_reviews.ReviewedByID WHERE seller_notes_reviews.NoteID = $noteid AND seller_notes_reviews.IsActive = 1";
                            $fetch_customer_review = mysqli_query($connection ,$fetch_customer_review_query);
                            while($review_row = mysqli_fetch_assoc($fetch_customer_review)){

                        ?>
                        
                        <div class="row bottom-black">
                            <div class="col-md-2">
                                <?php 
                                
                                $reviewid = $review_row['reviewid'];
                                $profilepicname = $review_row['profilepicname'];
                                $reviewerid = $review_row['reviewerid'] ;  
                                $displaypicpath = "../upload/$reviewerid/profile/$profilepicname";
                                
                                
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
                               <img style="width:20px;height:25px;" onclick="window.location.href='deletereview.php?admin=1&reviewid=<?php echo $reviewid;?>&noteid=<?php echo $noteid; ?>'" src="images/note-details/delete.png" class="text-right" alt="delete">
                                
                                </div>
                            </div>



                            <div class="col-md-2"></div>
                            <div class="col-md-10">
                                <p><?php echo $review_row['comments'];  ?></p>
                            </div>


                        </div>
                        <?php
                            }
                        ?>

                        
                    </div><br>
                
                </div>
            </div>
        </div>
    </section>
    </div>
	
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
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- custom js -->
    <script src="js/script.js"></script>
    

</body>
</html>