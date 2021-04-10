<?php ob_start(); ?>
<?php include 'includes/db.php'; ?>
<?php 
    
    session_start();
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;

?>
<?php 
    if(isset($_POST['submit'])){
        $Email_ID = $_POST['email_id'];
        $fetch_data_query = "SELECT * FROM users WHERE EmailID = '".$Email_ID."' AND IsEmailVerified = 1";
        $fetch_data = mysqli_query($connection, $fetch_data_query);
        $emailcount = mysqli_num_rows($fetch_data);
        if($emailcount){
            $fetch_data_array = mysqli_fetch_assoc($fetch_data);
            $receiver_name = $fetch_data_array['FirstName']." ".$fetch_data_array['LastName'];
            $new_pass = bin2hex(random_bytes(10))."Aa1$";
            $pass = password_hash($new_pass, PASSWORD_DEFAULT);
            $query = "UPDATE users SET Password = '".$pass."',ModifiedDate = NOW(),ModifiedBy = 99 WHERE EmailID = '".$Email_ID."'";
            $update_query = mysqli_query($connection , $query);
            if($update_query){
                
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

                    $mail->addAddress($Email_ID, $receiver_name);
                    $mail->addReplyTo($config_email, 'Parth Mistry');

                    $mail->IsHTML(true);
                    $mail->Subject = "New Temporary Password has been created for you";
                    $mail->Body = "Hello,
                                    We have generated a new password for you<br>
                                    Password: ".$new_pass."
                                    login with this given password.";
                    $mail->AltBody = 'reset password
                                      password : '.$new_pass;
                    $mail->send();
                    ?>
                    <script>
                        
                        alert("password reset , check your mail !!");
                        window.location.href = "login.php";
                        
                    </script>
                    <?php
                } catch (Exception $e) {
                    echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
                }
                
            }
        }else {
            ?>
            <script>
                alert("invalid emailid!! not registered");
            </script>
            <?php
        }
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
    <link rel="stylesheet" type="text/css" href="css/responsive.css">

</head>
<body>
    
	<!-- preloader -->
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    
    <!-- forgot password -->
    <section id="forgot-pw">
        
        <!-- background image -->
        <img class="bg-image img-responsive" src="images/login/banner-with-overlay.jpg" alt="login background">
        
        <div class="forgot-password-form">
            
            <!-- logo -->
            <img src="images/login/top-logo.png" alt="Notes MarketPlace">
            
            <!-- forgot form -->
            <div class="forgot-form">
                
                <div class="forgot-heading text-center">
                    <h2>Forgot Password?</h2>    
                    <p>Enter your email to reset your password</p>
                </div>
                
                <form action="forgotpw.php" method="post">
                    
                    <div class="form-group">
                    <label for="email_id">Email</label>
                    <input type="email" title="valid email formate : char@char.char" name="email_id" class="form-control form-control-sm" id="email_id" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>
                    
                    <button name="submit" type="submit" class="btn">submit</button>
                    
                </form>
                
            </div>
        
        </div>
    </section>
    <!-- forgot password ends --> 
    
	<!-- jquery-->
    <script src="js/jquery.min.js"></script>

    <!-- bootstrap js -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- custom js -->
    <script src="js/script.js"></script>

</body>
</html>