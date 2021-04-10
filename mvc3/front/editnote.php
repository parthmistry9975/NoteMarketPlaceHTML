<?php ob_start(); ?>
<?php include 'includes/db.php'; ?>
<?php 
    session_start();
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;

    if(!isset($_SESSION['ID'])){
        header("location:login.php");
    }
    if($_SESSION['ROLE'] != 3){
            header("location:../admin/admindashboard.php?admin=1");
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
                    <li class="nav-item dropdown">
                        <?php
                        $fetch_image_path_query = "SELECT ProfilePicture FROM user_profile WHERE UserID = ".$_SESSION['ID'];
                        $fetch_image_path = mysqli_query($connection , $fetch_image_path_query);
                        $image_path = mysqli_fetch_assoc($fetch_image_path);
                        if(isset($image_path['ProfilePicture'])){
                            $pp_file = $image_path['ProfilePicture'];
                        }else{
                            $pp_file = "images/dashboard/eye.png";
                        }
                        
                        ?>
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo $pp_file; ?>" alt="login image">
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="userprofile.php">My Profile</a>
                                <a class="dropdown-item" href="mydownloads.php">My Downloads</a>
                                <a class="dropdown-item" href="mysoldnotes.php">My Sold Notes</a>
                                <a class="dropdown-item" href="myrejectednotes.php">My Rejected Notes</a>
                                <a class="dropdown-item" href="changepw.php">Change Password</a>
                                <a class="dropdown-item purple" href="logout.php">LOGOUT</a>
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
                        <h1 class="text-center">Edit Note</h1>
                    </div>
                </div>
            </div>
        </div>
        </section>
        <!-- Banner Ends -->
	
	<?php  
                    
                    if(isset($_GET['id_note'])){
                        
                        $noteid = $_GET['id_note'];
                        $fetch_note_details_query = "SELECT * FROM seller_notes WHERE ID = $noteid";
                        $fetch_note_details = mysqli_query($connection , $fetch_note_details_query);
                        $notedetails = mysqli_fetch_assoc($fetch_note_details);
                    
                    }
                    if(isset($_POST['update'])){
                        
                        $title= mysqli_real_escape_string($connection,$_POST['notetitle'] );

                        $category= mysqli_real_escape_string($connection,$_POST['notecategory'] );

                        $type= mysqli_real_escape_string($connection,$_POST['notetype'] );

                        $pages= mysqli_real_escape_string($connection,$_POST['numberofpages'] );

                        $description= mysqli_real_escape_string($connection,$_POST['description'] );

                        $country= mysqli_real_escape_string($connection,$_POST['country'] );

                        $institution= mysqli_real_escape_string($connection,$_POST['institutename'] );

                        $course= mysqli_real_escape_string($connection,$_POST['coursename'] );

                        $coursecode= mysqli_real_escape_string($connection,$_POST['coursecode'] );

                        $professor= mysqli_real_escape_string($connection,$_POST['author'] );

                        $sellfor= mysqli_real_escape_string($connection,$_POST['sellfor'] );

                        $price= mysqli_real_escape_string($connection,$_POST['sellprice'] );
                        if($sellfor == 0){
                            $price = 0;
                        }
                        
                        $update = "UPDATE seller_notes SET Title = '$title' , Category = $category , NoteType = $type , NumberofPages = $pages , Description = '$description' , Country = $country , UniversityName = '$institution' , Course ='$course' , CourseCode = $coursecode , Professor = '$professor' , IsPaid = $sellfor , SellingPrice = $price , ModifiedBy =".$_SESSION['ID']." , ModifiedDate = NOW() WHERE ID = ".$_POST['update'];
                        $updatequery = mysqli_query($connection,$update);
                        
                        if($updatequery){
                            ?>
                            <script>
                                alert("note details updated");
                            </script>
                            <?php
                            $noteid = $_POST['update'];
                            $fetch_note_details_query = "SELECT * FROM seller_notes WHERE ID = $noteid";
                            $fetch_note_details = mysqli_query($connection , $fetch_note_details_query);
                            $notedetails = mysqli_fetch_assoc($fetch_note_details);
                        }
                        else{
                            ?>
                            <script>
                                alert("note details not updated");
                            </script>
                            <?php
                            $noteid = $_POST['update'];
                            $fetch_note_details_query = "SELECT * FROM seller_notes WHERE ID = $noteid";
                            $fetch_note_details = mysqli_query($connection , $fetch_note_details_query);
                            $notedetails = mysqli_fetch_assoc($fetch_note_details);
                        }
                        
                    }
                    if(isset($_POST['publish'])){
                        
                        $noteid = $_POST['publish'];
                        $seller = $_SESSION['LNAME']." ".$_SESSION['LNAME'];
                        $fetch_note_title_query = "SELECT Title FROM seller_notes WHERE ID = $noteid";
                        $fetch_note_title = mysqli_query($connection , $fetch_note_title_query);
                        $note_title = mysqli_fetch_assoc($fetch_note_title);
                        $title = $note_title['Title'];
                        
                        
                        $publish_note_query = "UPDATE seller_notes SET Status = 7 WHERE ID = $noteid";
                        $publish_note = mysqli_query($connection , $publish_note_query);
                        
                        if($publish_note){
                            
                            require 'src/Exception.php';
                            require 'src/PHPMailer.php';
                            require 'src/SMTP.php';

                            $mail = new PHPMailer(true);

                            try{

                                $mail->isSMTP();
                                $mail->Host = 'smtp.gmail.com';
                                $mail->SMTPAuth = true;
                                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                                $mail->Port = 587;

                                $config_email = '170320116025.it.parth@gmail.com';
                                $mail->Username = $config_email;
                                $mail->Password = 'Parth@1234';

                                $mail->setFrom($config_email, 'NotesMarketPlace');  // This email address and name will be visible as sender of email

                                $mail->addAddress('parthmistry7227843533@gmail.com', 'Receiver name');  // This email is where you want to send the email
                                $mail->addReplyTo($config_email, 'NotesMarketPlace');   // If receiver replies to the email, it will be sent to this email address

                                // Setting the email content
                                $mail->IsHTML(true);  
                                $mail->Subject = "varification of NotesMarketPlace account";    
                                $mail->Body ="<table style='height:60%;width: 60%; position: absolute;margin-left:10%;font-family:Open Sans !important;background: white;border-radius: 3px;padding-left: 2%;padding-right: 2%;'>
                                    <thead>
                                        <th>
                                            <img src='https://i.ibb.co/HVyPwqM/top-logo1.png' alt='logo' style='margin-top: 5%;'>
                                        </th>
                                    </thead>
                                    <tbody>
                                        <br>
                                        <tr style='height: 60px;font-family: Open Sans;font-size: 26px;font-weight: 600;line-height: 30px;color: #6255a5;'>
                                            <td class='text-1'>New Note Published</td>
                                        </tr>
                                        <tr style='height: 40px;font-family: Open Sans;font-size: 18px;font-weight: 600;line-height: 22px;color: #333333;margin-bottom: 20px;'>
                                            <td class='text-2'>Hello Admin,</td>
                                        </tr>
                                        <tr style='height: 60px;'>
                                            <td class='text-3'>
                                                We want to inform you that, <b>$seller</b> sent his note <br> <b>$title</b> for review. Please look at the notes and take required actions.
                                            </td>
                                        </tr>
                                        <tr style='height: 60px;'>
                                            <td class='text-3'>
                                                Regards <br>
                                                NotesMarketPlace
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>";   //Email body
                                $mail->AltBody = ' ';   //Alternate body of email

                                $mail->send();
                                header("location:userdashboard.php");

                            } catch (Exception $e) {
                                echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
                            }
                            
                        }else{
                            ?>
                            <script>   
                                alert("not isn't published");
                            </script>
                            <?php
                            $fetch_note_details_query = "SELECT * FROM seller_notes WHERE ID = $noteid";
                            $fetch_note_details = mysqli_query($connection , $fetch_note_details_query);
                            $notedetails = mysqli_fetch_assoc($fetch_note_details);
                        }
                       
                    }
                    
                    ?>
	
	<!-- profile form -->
	<div class="container">
            <div class="row">
                <form class="profile-form col-md-12" action="editnote.php" method="post" enctype="multipart/form-data">
                    <div class="col-md-12 profile-form-heading">
                        <h2>Basic Note Details</h2>
                    </div>
                    
                    
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="title">Title &#42;</label>
                            <input type="text" title="must have 3 characters" name="notetitle" class="form-control" id="title" placeholder="Enter your notes title" value="<?php echo $notedetails['Title']; ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="category">Category &#42;</label>
                            <?php 
                            
                                $category_query = "SELECT ID,Name FROM note_categories";
                                $cquery = mysqli_query($connection, $category_query);
                                $cqueryrows = mysqli_num_rows($cquery);
                            
                            ?>
                            <select id="category" name="notecategory" class="form-control" required>
                                <option value="">Select your category</option>
                                <?php
                                
                                    for($i=1;$i<=$cqueryrows;$i++){
                                        $categoryrow = mysqli_fetch_array($cquery);
                                        ?>
                                        <option value="<?php echo $categoryrow['ID'];?>" <?php if( $categoryrow['ID'] == $notedetails['Category'] ){echo "selected";}?>><?php echo $categoryrow['Name'] ?></option>
                                <?php
                            }
                            ?>

                               
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 file-upload">
                            <label for="displaypicture">Display Picture</label>
                            <input type="file" name="displaypicture" class="form-control-file display-picture" id="displaypicture" required disabled>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="uploadnote">Upload Notes &#42;</label>
                            <input type="file" name="notes-file[]" class="form-control-file upload-notes" id="uploadnote" required disabled>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="notetype">Type</label>
                            <?php
                            
                                $type_query = "SELECT ID,Name FROM note_types";
                                $tquery = mysqli_query($connection, $type_query);
                                $typerows = mysqli_num_rows($tquery);
                            
                            ?>
                            <select id="notetype" name="notetype" class="form-control" required>
                                <option value="">Select your note type</option>
                                <?php
                                    for($i=1;$i<=$typerows;$i++){
                                        $typerow = mysqli_fetch_array($tquery);
                                ?>
                                    <option value="<?php echo $typerow['ID'] ?>" <?php if($typerow['ID']==$notedetails['Category']){echo "selected";}?>><?php echo $typerow['Name'] ?></option>
                                <?php
                            }
                            ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="pages">Number of Pages</label>
                            <input type="text" name="numberofpages" title="only numbers are allowed" class="form-control" id="pages" placeholder="Enter number of note pages" required value="<?php echo $notedetails['NumberofPages']; ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="description">Description &#42;</label>
                            <textarea name="description" title="must have 5 characters" class="form-control hw" id="description" cols="50" rows="5" placeholder="Enter your description" required><?php echo $notedetails['Description']; ?> </textarea>
                        </div>
                    </div>
                
                    <div class="col-md-12 profile-form-heading">
                        <h2>Institution Information</h2>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="country">Country</label>
                            <?php
                            
                                $country_query = "SELECT ID,Name FROM countries";
                                $coquery = mysqli_query($connection, $country_query);
                                $countryrows = mysqli_num_rows($coquery);
                            
                            ?>
                            <select id="country" name="country" class="form-control" required>
                                <option value="">Select your country</option>
                                <?php
                                    for($i=1;$i<=$countryrows;$i++){
                                        $countryrow = mysqli_fetch_array($coquery);
                                ?>
                                    <option value="<?php echo $countryrow['ID'] ?>" <?php if($countryrow['ID'] == $notedetails['Country']){echo "selected";}?>><?php echo $countryrow['Name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="institute">Instituion Name</label>
                            <input type="text" title="numbers are not allowed must have 3 characters" name="institutename" class="form-control" id="institute" placeholder="Enter your institution name" required value="<?php echo $notedetails['UniversityName']; ?>">
                        </div>
                    </div>
                    
                    <div class="col-md-12 profile-form-heading">
                        <h2>Course Details</h2>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="coursename">Course Name</label>
                            <input type="text" title="must have 2 characters" name="coursename" class="form-control" id="coursename" placeholder="Enter your course name" required value="<?php echo $notedetails['Course']; ?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="coursecode">Course Code</label>
                            <input type="text" title="maximum 20 characters" name="coursecode" class="form-control" id="coursecode" placeholder="Enter your course code" required value="<?php echo $notedetails['CourseCode']; ?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="professor">Professor / Lecturer</label>
                            <input type="text" title="numbers are not allowed must have 3 characters" name="author" class="form-control" id="professor" placeholder="Enter your professor name" required value="<?php echo $notedetails['Professor']; ?>">
                        </div>
                        <div class="form-group col-md-6">
                            
                        </div>
                    </div>
                    
                    <div class="col-md-12 profile-form-heading">
                        <h2>Selling information</h2>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="sellfor">Sell For &#42;</label>
                                    <br>
                                    <label class="radio-inline radio-layout">
                                        <input type="radio" class="radio-size" name="sellfor" value="0" required <?php if($notedetails['IsPaid']==0){echo "checked"; } ?>><label class="radio-label" for="free">&nbsp;&nbsp;&nbsp;Free</label>
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" class="radio-size" name="sellfor" value="1" <?php if($notedetails['IsPaid']==1){echo "checked"; } ?>><label class="radio-label" for="free">&nbsp;&nbsp;&nbsp;Paid</label>
                                    </label>
                                </div>
                                <div class="form-group col-md-12 margin-layout">
                                    <label for="sellprice">Sell Price &#42;</label>
                                    <input type="text" title="only numbers allowed must have 1 characters" name="sellprice" class="form-control" id="sellprice" placeholder="Enter your price" required value="<?php echo $notedetails['SellingPrice']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="notepreview">Note Preview</label>
                            <input type="file" name="notepreview" class="form-control note-preview" id="noteprevie" name="Upload a picture" required disabled>
                        </div>
                    </div>
                    <button type="submit" name="update" class="btn btn-profile add-note-button" value="<?php echo $notedetails['ID']; ?>">UPDATE</button>
                    <span></span><button name="publish" value="<?php echo $notedetails['ID']; ?>" type="submit" class="btn btn-profile add-note-button">Publish</button>
                    
                    
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