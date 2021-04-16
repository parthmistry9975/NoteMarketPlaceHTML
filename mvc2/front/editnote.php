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
            <a class="navbar-brand" href="index.html"><img src="images/user-profile/logo.png" alt="logo"></a>
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
                        $pp_file = "../upload/".$_SESSION['ID']."/profile/".$image_path['ProfilePicture'];
                        
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
        
    
        if(isset($_GET["id_note"])){
            
            $N_id = $_GET["id_note"];
            $_SESSION['edit_note_id'] = $N_id;
            $fetch_for_edit_query = "SELECT * FROM seller_notes WHERE ID = $N_id";
            $fetch_for_edit_query1 = "SELECT FilePath FROM seller_notes_attachements WHERE NoteID = $N_id";
            $fetch_for_edit = mysqli_query($connection,$fetch_for_edit_query);
            $fetch_for_edit1 = mysqli_query($connection,$fetch_for_edit_query1);
            $fetch_for_edit_array = mysqli_fetch_assoc($fetch_for_edit);
            $note_files_path = array();
            while($row = mysqli_fetch_assoc($fetch_for_edit1)){
                array_push($note_files_path,$row['FilePath']);
            }
            $_SESSION['edit_note_file'] = $note_files_path;
            $edit_title = $fetch_for_edit_array['Title']; 
            $edit_category = $fetch_for_edit_array['Category'];
            $edit_notetype = $fetch_for_edit_array['NoteType'];
            $edit_pages = $fetch_for_edit_array['NumberofPages'];
            $edit_description = $fetch_for_edit_array['Description'];
            $edit_displaypic = $fetch_for_edit_array['DisplayPicture'];
            $_SESSION['edit_display_pic'] = $edit_displaypic;
            $edit_country = $fetch_for_edit_array['Country'];
            $edit_university = $fetch_for_edit_array['UniversityName'];
            $edit_course = $fetch_for_edit_array['Course'];
            $edit_coursecode = $fetch_for_edit_array['CourseCode'];
            $edit_professor = $fetch_for_edit_array['Professor'];
            $edit_notespreview = $fetch_for_edit_array['NotesPreview'];
            $_SESSION['edit_notes_preview'] = $edit_notespreview;
            $edit_ispaid = $fetch_for_edit_array['IsPaid'];
            $edit_price = $fetch_for_edit_array['SellingPrice'];
            
        }
    
    
        $ID = $_SESSION['ID'];
        
        if(isset($_POST['save'])) {
            
            $title = mysqli_real_escape_string($connection,$_POST['notetitle'] );
            $_SESSION['title'] = $title;
            
            $category= mysqli_real_escape_string($connection,$_POST['notecategory'] );
            $_SESSION['category'] = $category;
            
            
            $displaypic= $_FILES['displaypicture'];
            $_SESSION['displaypic'] = $displaypic;
            $displaypicname = $displaypic['name'];
            $displaypic_ext = explode('.',$displaypicname);
            $displaypic_ext_check = strtolower(end($displaypic_ext));
            $valid_displaypic_ext = array('png','jpg','jpeg');
            $displaypicnewname = "bp_".date("dmyhis").'.'.$displaypic_ext_check;
            
            $uploadnote= $_FILES['notes-file'];
            $_SESSION['uploadnote'] = $uploadnote;
            $countfiles = count($uploadnote['name']);
            for($i=0 ; $i<$countfiles ; $i++){
                $uploadnotename = $uploadnote['name'][$i];
                $uploadnote_ext = explode('.',$uploadnotename);
                $uploadnote_ext_check = strtolower(end($uploadnote_ext));
                $valid_uploadnote_ext = array('pdf');
            }
            
            $type= mysqli_real_escape_string($connection,$_POST['notetype'] );
            $_SESSION['type'] = $type;
            
            $pages= mysqli_real_escape_string($connection,$_POST['numberofpages'] );
            $_SESSION['pages'] = $pages;
            
            $description= mysqli_real_escape_string($connection,$_POST['description'] );
            $_SESSION['description'] = $description;
            
            $country= mysqli_real_escape_string($connection,$_POST['country'] );
            $_SESSION['country'] = $country;
            
            $institution= mysqli_real_escape_string($connection,$_POST['institutename'] );
            $_SESSION['institution'] = $institution;
            
            $course= mysqli_real_escape_string($connection,$_POST['coursename'] );
            $_SESSION['course'] = $course;
            
            $coursecode= mysqli_real_escape_string($connection,$_POST['coursecode'] );
            $_SESSION['coursecode'] = $coursecode;
            
            $professor= mysqli_real_escape_string($connection,$_POST['author'] );
            $_SESSION['professor'] = $professor;
            
            $sellfor= mysqli_real_escape_string($connection,$_POST['sellfor'] );
            $_SESSION['sellfor'] = $sellfor;
            
            $price= mysqli_real_escape_string($connection,$_POST['sellprice'] );
            if($sellfor == 0){
                $price = 0;
            }
            $_SESSION['price'] = $price;
            
            $preview= $_FILES['notepreview'];
            $_SESSION['preview'] = $preview;
            $previewname = $preview['name'];
            $preview_ext = explode('.',$previewname);
            $preview_ext_check = strtolower(end($preview_ext));
            echo "ol".$preview_ext_check."hiii";
            echo empty($preview_ext_check);
            $valid_preview_ext = array('pdf');
            $previewnewname = "preview_".date("dmyhis").'.'.$preview_ext_check;
            
            $loginID = $_SESSION['ID'];
            $noteid = $_SESSION['edit_note_id'];
            $notename = $_SESSION['edit_display_pic'];
            $notepreview = $_SESSION['edit_notes_preview'];
            $notefiles = $_SESSION['edit_note_file'];
            
//            if($displaypic['size'] != 0 ){
//                //deleting existing file for edit display pic
//                $delete_pic = '../upload/'.$loginID.'/'.$noteid.'/'.$notename;
//                unlink($delete_pic);
//            }
//            if($preview['size'] != 0 ){
//                //deleting existing file for edit note preview
//                $delete_preview = '../upload/'.$loginID.'/'.$noteid.'/'.$notepreview;
//                unlink($delete_preview);
//            }
//            if(!empty($uploadnote['name'][0])){
//                //deleting existing file for edit note file
//                foreach($notefiles as $notefile){
//                    $delete_file = $notefile;
//                    echo $delete_file;
//                    unlink($delete_file);
//                }    
//            }
            
            if((in_array($displaypic_ext_check,$valid_displaypic_ext) || empty($displaypic_ext_check)) && in_array($uploadnote_ext_check,$valid_uploadnote_ext) && in_array($preview_ext_check,$valid_preview_ext) ) {
                
                
                
                
            }
            else{
            ?>
                <script>
                    alert("please choose proper file type !! for display picture jpg , jpeg , png !! for preview and attachment file pdf ");
                </script>
            <?php
            }
            
        }
            
        

        if(isset($_POST['publish'])){
            
        ?>
            <script>
            if (confirm('Publishing this note will send note to administrator for review, once administrator review and approve then this note will be published to portal. Press yes to continue.')) {
                <?php 
                    $noteid = $_SESSION['noteid'];
                    $note_title = $_SESSION['notetitle'];
                    $seller_name = $_SESSION['FNAME'];
                    $query2 = "UPDATE seller_notes SET Status = 7 WHERE ID =$noteid";
                    $uquery = mysqli_query($connection, $query2);

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
                                        We want to inform you that, <b>$seller_name</b> sent his note <br> <b>$note_title</b> for review. Please look at the notes and take required actions.
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
                        $mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';   //Alternate body of email

                        $mail->send();

                    } catch (Exception $e) {
                        echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
                    }
                    ?>

                    }else{
            
                    }
                
            </script>
            <?php
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
                            <input type="text" name="notetitle" class="form-control" id="title" placeholder="Enter your notes title" required 
                            value="<?php if(isset($_POST['save'])){ echo $_SESSION['title']; } else { echo $edit_title; }?>" >
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
                                        <option value="<?php echo $categoryrow['ID'];?>" <?php if(isset($_POST['save'])){if($categoryrow['ID']==$_SESSION['category']){echo "selected";}} else { if($categoryrow['ID']==$edit_category){echo "selected";}}?>><?php echo $categoryrow['Name'] ?></option>
                                <?php
                            }
                            ?>

                               
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 file-upload">
                            <label for="displaypicture">Display Picture</label>
                            <input type="file" name="displaypicture" class="form-control-file display-picture" id="displaypicture" <?php if(isset($_POST['save'])){ echo "disabled" ; }?>>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="uploadnote">Upload Notes &#42;</label>
                            <input type="file" name="notes-file[]" class="form-control-file upload-notes" id="uploadnote" multiple <?php if(isset($_POST['save'])){ echo "disabled" ; }?>>
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
                                    <option value="<?php echo $typerow['ID'] ?>" <?php if(isset($_POST['save'])){if($typerow['ID']==$_SESSION['type']){echo "selected";}} else { if($typerow['ID']==$edit_notetype){ echo "selected"; }}?>><?php echo $typerow['Name'] ?></option>
                                <?php
                            }
                            ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="pages">Number of Pages</label>
                            <input type="text" name="numberofpages" class="form-control" id="pages" placeholder="Enter number of note pages" required value="<?php if(isset($_POST['save'])){ echo $_SESSION['pages']; } else { echo $edit_pages; }?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="description">Description &#42;</label>
                            <textarea name="description" class="form-control hw" id="description" cols="50" rows="5" placeholder="Enter your description" required><?php if(isset($_POST['save'])){ echo $_SESSION['description']; } else { echo $edit_description; }?></textarea>
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
                                    <option value="<?php echo $countryrow['ID'] ?>" <?php if(isset($_POST['save'])){if($countryrow['ID']==$_SESSION['country']){echo "selected";}} else { if($countryrow['ID']==$edit_country){echo "selected";}} ?>><?php echo $countryrow['Name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="institute">Instituion Name</label>
                            <input type="text" name="institutename" class="form-control" id="institute" placeholder="Enter your institution name" required value="<?php if(isset($_POST['save'])){ echo $_SESSION['institution']; } else { echo $edit_university; }?>">
                        </div>
                    </div>
                    
                    <div class="col-md-12 profile-form-heading">
                        <h2>Course Details</h2>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="coursename">Course Name</label>course
                            <input type="text" name="coursename" class="form-control" id="coursename" placeholder="Enter your course name" required value="<?php if(isset($_POST['save'])){ echo $_SESSION['course']; } else { echo $edit_course; }?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="coursecode">Course Code</label>coursecode
                            <input type="text" name="coursecode" class="form-control" id="coursecode" placeholder="Enter your course code" required value="<?php if(isset($_POST['save'])){ echo $_SESSION['coursecode']; } else { echo $edit_coursecode; }?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="professor">Professor / Lecturer</label>professor
                            <input type="text" name="author" class="form-control" id="professor" placeholder="Enter your professor name" required value="<?php if(isset($_POST['save'])){ echo $_SESSION['professor']; } else { echo $edit_professor; }?>">
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
                                        <input type="radio" class="radio-size" name="sellfor" value="0" required <?php if(isset($_POST['save'])){if($_SESSION['sellfor']==0){echo "checked"; }}else{if($edit_ispaid==0){echo "checked"; }}?>><label class="radio-label" for="free">&nbsp;&nbsp;&nbsp;Free</label>
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" class="radio-size" name="sellfor" value="1" <?php if(isset($_POST['save'])){if($_SESSION['sellfor']==1){echo "checked"; }}else{if($edit_ispaid==1){echo "checked"; }}?>><label class="radio-label" for="free">&nbsp;&nbsp;&nbsp;Paid</label>
                                    </label>
                                </div>
                                <div class="form-group col-md-12 margin-layout">
                                    <label for="sellprice">Sell Price &#42;</label>price
                                    <input type="text" name="sellprice" class="form-control" id="sellprice" placeholder="Enter your price" required value="<?php if(isset($_POST['save'])){ echo $_SESSION['price']; } else { echo $edit_price; }?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="notepreview">Note Preview</label>
                            <input type="file" name="notepreview" class="form-control note-preview" id="notepreview" name="Upload a picture" <?php if(isset($_POST['save'])){ echo "disabled" ; }?>>
                        </div>
                    </div>
                    <button type="submit" name="save" class="btn btn-profile add-note-button"<?php if(isset($_POST['save'])){echo "disabled";}?>>Save</button>
                    <span></span><button name="publish" type="submit" class="btn btn-profile add-note-button" <?php if(!isset($_POST['save'])){echo "disabled";}?>>Publish</button>
                    
                    
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