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
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
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

</head>

<body>

    <!-- preloader -->
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>


    <?php 
    
    if(isset($_POST['submit'])){
        
        $email_id = $_POST['email_id'];
        $check_query = "SELECT * FROM users WHERE EmailID = '".$email_id."'";
        $check_queried = mysqli_query($connection, $check_query);
        $emailcount = mysqli_num_rows($check_queried);
        if($emailcount > 0){
            
            ?>
            <script>
                alert('email is already Registered.');
            </script>
            <?php
            $message = ' ';
            
        }else{
            if($_POST['password'] == $_POST['confirmpassword']){
            
            $FirstName = mysqli_real_escape_string($connection, $_POST['firstname']);
            $LastName = mysqli_real_escape_string($connection, $_POST['lastname']);
            $EmailID = mysqli_real_escape_string($connection, $_POST['email_id']);
            $Password = mysqli_real_escape_string($connection, $_POST['password']);
            $Pass = password_hash($Password, PASSWORD_DEFAULT);
                
                $query = "INSERT INTO users (FirstName,LastName,EmailID,Password )";
                $query .= "VALUES ('$FirstName','$LastName','$EmailID','$Pass')";
                $insert_query = mysqli_query($connection,$query);
                if($insert_query){

                    


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

                        $mail->addAddress($EmailID,$FirstName.' '.$LastName);
                        $mail->addReplyTo($config_email, 'Parth Mistry');

                        $mail->IsHTML(true);
                        $mail->Subject = "About verifying emailid for NotesMarketplace";
                        $mail->Body = '<!DOCTYPE html>
                                        <html lang="en">

                                        <head>
                                            <meta charset="UTF-8">
                                            <meta http-equiv="X-UA-Compatible" content="IE=edge">
                                            <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
                                            <title>Notes Market Place-Email verification</title>

                                            <!-- Google Fonts -->
                                            <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
                                        </head>

                                        <body style="background: #6255a5;">
                                            <table style="height:40%;width: 40%; position: absolute;top: 50%;left: 50%;transform: translate(-50%, -50%);font-family:Open Sans !important;background: #fff;border-radius: 3px;padding-left: 2%;padding-right: 2%;">
                                                <thead>
                                                    <th>
                                                        <img src="../images/logo/top-logo1.png" alt="logo" style="margin-top: 5%;">
                                                    </th>
                                                </thead>
                                                <tbody>
                                                    <tr style="height: 60px;font-family: Open Sans;font-size: 26px;font-weight: 600;line-height: 30px;color: #6255a5;">
                                                        <td class="text-1">Email Verification</td>
                                                    </tr>
                                                    <tr style="height: 40px;font-family: Open Sans;font-size: 18px;font-weight: 600;line-height: 22px;color: #333333;margin-bottom: 20px;">
                                                        <td class="text-2">Dear '.$FirstName.' '.$LastName.',</td>
                                                    </tr>
                                                    <tr style="height: 60px;">
                                                        <td class="text-3">
                                                            Thanks for Signing up! <br>
                                                            Simply click below for email verification.
                                                        </td>
                                                    </tr>
                                                    <tr style="height: 120px;font-size: 16px;font-weight: 400;line-height: 22px;color: #333333;margin-bottom: 50px;">
                                                        <td style="text-align: center;">
                                                            <a href="localhost/NoteMarketPlaceHTML/front/emailverification.php?id='.$EmailID.'">
                                                            <button class="btn btn-verify" style="width: 100% !important;height:50px;font-family: Open Sans; font-size: 18px;font-weight: 600;line-height: 22px;color: #fff;background-color: #6255a5;border-radius: 3px;">VERIFY EMAIL ADDRESS</button>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </body>

                                        </html>';
                        $mail->AltBody = 'Verify emailid registered for notesmarket';

                        $mail->send();
                        $msg = "Email message sent.";
                        header("Location:" . 'emailsent.php?msg='. $msg );
                    } catch (Exception $e) {
                        echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
                    }
                }
                else
                {
                    die("Query failed" . mysqli_error($connection));
                }
                $message = '<i class="fa fa-check-circle" aria-hidden="true"></i>&nbsp;&nbsp;Your account has been successfully created.';
                
            
            
            
        } else {
            
            $message = ' ';
            ?>
            <script>
            alert('password and confirm password should be equal');
            </script>
            <?php
        }
        }
        
        
    }else {
        
        $message = ' ';
        
    }
    
    ?>

    <!-- login Page -->
    <section id="signup">

        <!-- background image -->
        <img class="bg-image img-responsive" src="images/login/banner-with-overlay.jpg" alt="login background">

        <div class="sign-up-form">

            <!-- logo -->
            <img src="images/login/top-logo.png" alt="Notes MarketPlace">

            <div class="signup-form">
                <div class="signup-heading text-center">
                    <h2>Creat an Account</h2>
                    <p>Enter your details to signup</p>
                    <p class="signup-done"><?php echo $message; ?></p>

                </div>
                <form action="signup.php" method="post">


                    <div class="form-group">
                        <label for="firstname">First Name &#42;</label>
                        <input type="text" name="firstname" class="form-control form-control-sm" id="firstname" placeholder="Enter your first name" required>
                    </div>
                    <div class="form-group">
                        <label for="lastname">Last Name &#42;</label>
                        <input type="text" name="lastname" class="form-control form-control-sm" id="lastname" placeholder="Enter your last name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email &#42;</label>
                        <input type="email" name="email_id" class="form-control form-control-sm" id="email" placeholder="Enter your email address" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control form-control-sm" id="password" placeholder="Enter your Password" required>
                        <span toggle="#password" class="fa fa-eye-slash fa-eye field-icon toggle-password signup-eye"></span>
                    </div>
                    <div class="form-group">
                        <label for="confirmpassword">Confirm Password</label>
                        <input type="password" name="confirmpassword" class="form-control form-control-sm" id="confirmpassword" placeholder="Re-enter your Password" required>
                        <span toggle="#confirmpassword" class="fa fa-eye-slash fa-eye field-icon toggle-password signup-eye"></span>
                    </div>

                    <button type="submit" name="submit" class="btn">Sign Up</button>
                </form>
                <div class="signup-footer text-center">
                    <p>Already have an account? <a href="login.html">Login</a></p>
                </div>

            </div>

        </div>



    </section>

    <!-- ends -->

    <!-- jquery-->
    <script src="js/jquery.min.js"></script>

    <!-- bootstrap js -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- custom js -->
    <script src="js/script.js"></script>

</body>

</html>