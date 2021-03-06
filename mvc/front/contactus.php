<?php ob_start(); ?>
<?php include 'includes/db.php'; ?>
<?php 
    
    session_start();
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;

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
    
    <?php
    
        if(isset($_POST['submit'])){
            
            $Name = $_POST['sender_name'];
            $Email_ID = $_POST['sender_id'];
            $Mail_Subject = $_POST['mail_subject'];
            $Mail_Body = $_POST['mail_body'];
            
//            $query = "SELECT * FROM users WHERE RoleID = 2 LIMIT 1";
//            $fetch_data = mysqli_query($connection ,$query);
//            $fetch_data_array = mysqli_fetch_assoc($fetch_data);
//            $Receiver_Email = $fetch_data_array['EmailId'];
            require 'src/Exception.php';
            require 'src/PHPMailer.php';
            require 'src/SMTP.php';

            $mail = new PHPMailer(true);

            try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            $config_email = '170320116025.it.parth@gmail.com';
            $mail->Username = $config_email;
            $mail->Password = 'Parth@1234';

            // Sender and recipient settings
            $mail->setFrom($config_email, 'Parth Mistry');

            $mail->addAddress('parthmistry7227843533@gmail.com',$Name);
            $mail->addReplyTo($config_email, 'Parth Mistry');

            $mail->IsHTML(true);
            $mail->Subject = $Mail_Subject;
            $mail->Body = "Hello,<br><br>$Mail_Body<br><br>Regards,<br>$Name<br>$Email_ID";
            $mail->AltBody = 'contacte us';
            $mail->send();
            ?>
            <script>
    
                alert('your response is submitted');
                window.location.href = "contactus.php";
            </script>
            <?php
            
            } catch (Exception $e) {
            echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
            }

            }
    
    ?>
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
    
	<!-- Banner  -->
    <section class="banner">
        <div class="content-box-banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="text-center">Contact Us</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Ends -->
	
	<div class="contactus-form container">
            <div class="row">
                <form action="contactus.php" method="post" class="profile-form col-md-12">
                    <div class="col-md-12 contactus-heading">
                        <h2>Get in Touch</h2>
                        <p>Let us know how to get back to you</p>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="form-row c-row">
                                <div class="form-group col-md-12">
                                    <label for="fullname">Full Name &#42;</label>
                                    <input type="text" name="sender_name" class="form-control" id="fullname" placeholder="Enter your full name" required>
                                </div>
                            </div>
                            <div class="form-row c-row">
                                <div class="form-group col-md-12">
                                    <label for="email">Email Address &#42;</label>
                                    <input type="email" name="sender_id" class="form-control" id="email" placeholder="Enter your email address" required>
                                </div>
                            </div>
                            <div class="form-row c-row">
                                <div class="form-group col-md-12">
                                    <label for="subject">Subject &#42;</label>
                                    <input type="text" name="mail_subject" class="form-control" id="subject" placeholder="Enter your subject" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="comments-contact">Comments / Questions &#42;</label>
                            <input type="text" name="mail_body" class="form-control contact-comments" id="comments-contact" placeholder="Enter your subject" required>
                        </div>
                    </div>
                    <div class="button-submit-contact-us">
                    <button type="submit" name="submit" class="btn btn-profile">Submit</button>
                    </div>
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