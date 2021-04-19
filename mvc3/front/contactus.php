<?php ob_start(); ?>
<?php include 'includes/db.php'; ?>
<?php 
    
    session_start();
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    if(isset($_SESSION['ROLE'])){
        if($_SESSION['ROLE'] != 3){
            header("location:../admin/admindashboard.php?admin=1");
        }
    }
    $Page = "contactus";

    if(isset($_SESSION['ID'])){
        
        $loginid = $_SESSION['ID'];
        $fetch_data_query = "SELECT FirstName , LastName , EmailID FROM users WHERE ID = $loginid";
        $fetch_data = mysqli_query($connection, $fetch_data_query);
        $count_record = mysqli_num_rows($fetch_data);
        if($count_record){
            $fetch_data_array = mysqli_fetch_assoc($fetch_data);
            $firstname = $fetch_data_array['FirstName'];
            $lastname = $fetch_data_array['LastName'];
            $emailid = $fetch_data_array['EmailID'];
            $fullname = $firstname." ".$lastname;
        }
    }

    if(isset($_POST['submit'])){
            
            $Name = $_POST['sender_name'];
            $Email_ID = $_POST['sender_id'];
            $Mail_Subject = $_POST['mail_subject'];
            $Mail_Body = $_POST['mail_body'];
            
            $_SESSION['status'] = "your response is submitted";
            $_SESSION['status_code'] = "success";
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
            } catch (Exception $e) {
            echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
            }

    }

?>

<?php include 'includes/header.php'; ?>
            
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
                                    <input type="text" pattern="[A-Za-z]{3,}" title="numbers are not allowed must have 3 characters" name="sender_name" class="form-control" id="fullname" placeholder="Enter your full name" value="<?php if(isset($_SESSION['ID'])){ echo $fullname; } ?>" <?php if(isset($_SESSION['ID'])){ echo "readonly"; } ?> required>
                                </div>
                            </div>
                            <div class="form-row c-row">
                                <div class="form-group col-md-12">
                                    <label for="email">Email Address &#42;</label>
                                    <input type="email" pattern="[a-z0-9_%+-]+[@][a-z0-9-]+[.][a-z]{2,}$" title="valid email formate : char@char.char" name="sender_id" class="form-control" id="email" placeholder="Enter your email address" value="<?php if(isset($_SESSION['ID'])){ echo $emailid; } ?>" <?php if(isset($_SESSION['ID'])){ echo "readonly"; } ?> required>
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
                            <textarea style="height:81%;" rows="8" name="mail_body" class="form-control contact-comments" id="comments-contact" placeholder="Enter your subject" required></textarea>
                        </div>
                    </div>
                    <div class="button-submit-contact-us">
                    <button type="submit" name="submit" class="btn btn-profile">Submit</button>
                    </div>
                </form>
            </div>
        </div>
	<!-- profile form ends -->
	
	<?php include 'includes/footernlink.php'; ?>
    
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


</body>
</html>