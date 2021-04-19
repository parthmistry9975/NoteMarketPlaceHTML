<?php ob_start(); ?>
<?php include 'includes/db.php'; ?>
<?php  

    session_start();
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    if($_GET['admin'] != 1){
        header("location:../front/login.php");
    }
    if(!isset($_SESSION['ID'])){
        header("location:../front/login.php");
    }
    if($_SESSION['ROLE'] != 1){
        header("location:admindashboard.php?admin=1");
    }
?>
<?php
        if(isset($_POST['submit'])){
            $firstname = mysqli_real_escape_string($connection,$_POST['firstname'] );
            $lastname = mysqli_real_escape_string($connection,$_POST['lastname'] );
            $email = mysqli_real_escape_string($connection,$_POST['email'] );
            $countrycode = mysqli_real_escape_string($connection,$_POST['countrycode'] );
            $phonenumber = mysqli_real_escape_string($connection,$_POST['phonenumber'] );
            $loginid = $_SESSION['ID'];
        
            $new_pass = bin2hex(random_bytes(10))."Aa1$";
            $pass = password_hash($new_pass, PASSWORD_DEFAULT);
            
            $add_admin_query = "INSERT INTO users( RoleID , FirstName , LastName , EmailID , Password , IsEmailVerified , CreatedDate , CreatedBy , IsActive) VALUES ( 2 , '$firstname' , '$lastname' , '$email' , '$pass' , 1 , NOW() , '$loginid' , 1)";
            $add_admin = mysqli_query($connection , $add_admin_query);
            
            $userid = mysqli_insert_id($connection);
            $add_admin_query1 = "INSERT INTO user_profile( UserID , CountryCode , PhoneNumber , AddressLine1 , AddressLine2 , City , State , ZipCode , Country , CreatedBy) VALUES ( $userid , '$countrycode' , '$phonenumber' , '' , '' , '' , '' , '' , '' , $loginid )";
            $add_admin1 = mysqli_query($connection , $add_admin_query1);
            
            if($add_admin && $add_admin1){
                
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

                    $mail->addAddress($email, $firstname." ".$lastname);
                    $mail->addReplyTo($config_email, 'Parth Mistry');

                    $mail->IsHTML(true);
                    $mail->Subject = "New Temporary Password has been created for you";
                    $mail->Body = "Hello ".$firstname." ".$lastname.",<br><br>NoteMarketPlace has added you as a admin please login in to portal via given link with this password: $new_pass <br>Portal Link : <a href = 'http://localhost/NoteMarketPlaceHTML/front/login.php' > NoteMarketPlace</a>";
                    $mail->AltBody = 'reset password
                                      password : '.$new_pass;
                    $_SESSION['adminadd'] = "yes";
                    $mail->send();
                    header("location:manageadministrator.php?admin=1");
                } catch (Exception $e) {
                    echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
                }
                
            }else{
                $_SESSION['adminadd'] = "no";
                header("location:manageadministrator.php?admin=1");
            }
        }

        if(isset($_POST['edit'])){
            $edit_firstname = mysqli_real_escape_string($connection,$_POST['firstname'] );
            $edit_lastname = mysqli_real_escape_string($connection,$_POST['lastname'] );
            $edit_email = mysqli_real_escape_string($connection,$_POST['email'] );
            $edit_countrycode = mysqli_real_escape_string($connection,$_POST['countrycode'] );
            $edit_phonenumber = mysqli_real_escape_string($connection,$_POST['phonenumber'] );
            $loginid = $_SESSION['ID'];
            $edit_adminid = $_POST['edit'];
            
            $edit_admin_query = "UPDATE users SET FirstName = '$edit_firstname' , LastName = '$edit_lastname' , EmailID = '$edit_email' , ModifiedDate = NOW() , ModifiedBy = $loginid WHERE ID = $edit_adminid";
            $edit_admin = mysqli_query($connection , $edit_admin_query);
            
            $edit_admin_query1 = "UPDATE user_profile SET CountryCode = '$edit_countrycode' , PhoneNumber = '$edit_phonenumber' , ModifiedDate = NOW() , ModifiedBy = $loginid WHERE UserID = $edit_adminid";
            $edit_admin1 = mysqli_query($connection , $edit_admin_query1);
            
            if($edit_admin && $edit_admin1){
                $_SESSION['adminedit'] = "yes";
                header("location:manageadministrator.php?admin=1");
                    ?>
                    <script>
                        
                        alert("admin details edited !!");
                        location.replace("manageadministrator.php?admin=1");
                        
                    </script>
                    <?php
                
            }else{
                $_SESSION['adminedit'] = "no";
                header("location:manageadministrator.php?admin=1");
            }
        }

?>

    <?php include 'includes/header.php'; ?>
    
    <?php
    
    if(isset($_GET['editid'])){
        
        $editid = $_GET['editid'];
        $fetch_admin_details = "SELECT FirstName , LastName , user_profile.CountryCode AS countrycode , user_profile.PhoneNumber AS phonenumber , EmailID FROM users INNER JOIN user_profile ON users.ID = user_profile.UserID WHERE users.RoleID = 2 AND users.ID = $editid";
        $fetch_admin = mysqli_query($connection , $fetch_admin_details);
        $admin_details = mysqli_fetch_assoc($fetch_admin);
        $first = $admin_details['FirstName'];
        $last = $admin_details['LastName'];
        $code = $admin_details['countrycode'];
        $pnumber = $admin_details['phonenumber'];
        $fetch_email = $admin_details['EmailID'];
        
    }
    
    ?>
    
    <!-- profile form -->
	<div class="admin-profile-form container">
            <div class="row">
                <form action="addadministrator.php?admin=1" method="post" class="profile-form col-md-12">
                    <div class="col-md-12 profile-form-heading">
                        <h2>Add Administrator</h2>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="firstname">First Name &#42;</label>
                            <input type="text" name="firstname" 
                            <?php 
                                   if(isset($_GET['editid'])){
                                       echo "value='$first'";
                                   } 
                            ?> class="form-control" id="firstname" placeholder="Enter your first name" required>
                        </div>
                        <div class="form-group col-md-6">
                            
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="lastname">Last Name &#42;</label>
                            <input type="text" name="lastname"
                            <?php 
                                   if(isset($_GET['editid'])){
                                       echo "value='$last'";
                                   } 
                            ?> class="form-control" id="lastname" placeholder="Enter your last name" required>
                        </div>
                        <div class="form-group col-md-6">
                            
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">Email &#42;</label>
                            <input type="email" name="email"
                            <?php 
                                   if(isset($_GET['editid'])){
                                       echo "value='$fetch_email'";
                                   } 
                            ?> class="form-control" id="email" placeholder="Enter your email address"  required>
                        </div>
                        <div class="form-group col-md-6">
                            
                        </div>
                    </div>
                    <div class="form-row mobilenum">
                        <div class="form-group col-md-2 col-sm-4">
                            <label for="countrycode">Phone Number</label>
                            <?php 
                            
                                $countrycode_query = "SELECT CountryCode FROM countries WHERE IsActive = 1";
                                $ccquery = mysqli_query($connection, $countrycode_query);
                                $ccqueryrows = mysqli_num_rows($ccquery);
                            
                            ?>
                            <select name="countrycode" id="countrycode" class="form-control code">
                                
                                <?php
                                
                                    for($i=1;$i<=$ccqueryrows;$i++){
                                        $countrycoderow = mysqli_fetch_array($ccquery);
                                        ?>
                                        <option value="<?php echo $countrycoderow['CountryCode'];?>" <?php if(isset($_GET['editid'])){ if($countrycoderow['CountryCode'] == $code){ echo "selected";}}  ?>>
                                        <?php echo $countrycoderow['CountryCode'] ;?>
                                        </option>
                                <?php
                            }
                            ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4 col-sm-8">
                            <label for="phonenumber">&nbsp;</label>
                            <input type="tel" pattern="[0-9]{8,}"
                            <?php 
                                   if(isset($_GET['editid'])){
                                       echo "value='$pnumber'";
                                   } 
                            ?> title="only numbers are allowed must have 10 characters" name="phonenumber" class="form-control phone" id="phonenumber" placeholder="Enter your phone number">
                        </div>
                        <div class="form-group col-md-6">
                            
                        </div>
                    </div>
                    <button type="submit" <?php 
                                   if(isset($_GET['editid'])){
                                       echo "value='$editid'";
                                   } 
                            ?> <?php if(isset($_GET['editid'])){ echo "name='edit'"; }else{ echo "name='submit'";} ?> class="btn btn-profile"><?php if(isset($_GET['editid'])){ echo 'update'; }else{ echo 'submit';} ?></button>
                </form>
            </div>
        </div>
	<!-- profile form ends -->
	
	<?php include 'includes/footernlink.php'; ?>
</body>
</html>