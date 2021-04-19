<?php ob_start(); ?>
<?php include 'includes/db.php'; ?>
<?php  

    session_start();
    if(!isset($_SESSION['ID'])){
        header("location:login.php");
    }
    if($_SESSION['ROLE'] != 3){
        header("location:admindashboard.php?admin=1");
    }
?>


<?php

    if(isset($_POST['update'])){
        
        $opw = mysqli_real_escape_string($connection,$_POST['oldpassword']);
        $npw = mysqli_real_escape_string($connection,$_POST['newpassword']);
        $ncpw = mysqli_real_escape_string($connection,$_POST['confirmpassword']);
        $loginid = $_SESSION['ID'];
        
        $fetch_pw_query = "SELECT * FROM users WHERE ID = $loginid and IsEmailVerified = 1";
        $fetch_pw = mysqli_query($connection, $fetch_pw_query);
        $count_record = mysqli_num_rows($fetch_pw);
        if($count_record){
            $fetch_pw_array = mysqli_fetch_assoc($fetch_pw);
            $Stored_Password = $fetch_pw_array['Password'];
            if(password_verify($opw, $Stored_Password)){
                
                if($npw === $ncpw){
                    
                    $Pass = password_hash($npw, PASSWORD_DEFAULT);
                    $update_pw_query = "UPDATE users SET Password = '$Pass' WHERE ID = $loginid";
                    $update_pw = mysqli_query($connection, $update_pw_query);
                    if($update_pw){
                            $_SESSION['showsetpassword'] = "yes";
                            header("location:userdashboard.php");
                    }else{
                        $_SESSION['status'] = "password isn't updated some error occured please try again !!";
                        $_SESSION['status_code'] = "error";
                    }
                }else{
                    $_SESSION['status'] = "new password and confirm password arn't same !!";
                    $_SESSION['status_code'] = "warning";
                    }
                
            }else{
                $_SESSION['status'] = "Wrong current Password entered";
                $_SESSION['status_code'] = "error";
            }
        }
        
    }



?>
<!DOCTYPE html>
<html lang="en">
<head>

	<?php include 'includes/links.php'; ?>
    
</head>
<body>
    
	<!-- preloader -->
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    
    <!-- forgot password -->
    <section id="change-pw">
        
        <!-- background image -->
        <img class="bg-image img-responsive" src="images/login/banner-with-overlay.jpg" alt="login background">
        
        <div class="change-password-form">
            
            <!-- logo -->
            <img src="images/login/top-logo.png" alt="Notes MarketPlace">
            
            <!-- forgot form -->
            <div class="change-form">
                
                <div class="change-heading text-center">
                    <h2>Change Password</h2>    
                    <p>Enter your new password to change your password</p>
                </div>
                
                <form action="changepw.php" method="post">
                    
                    <div class="form-group">
                    <label for="oldpassword">Old Password</label>
                    <input type="password" pattern="(?=^.{6,24}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).*$" title="enter proper valid password " name="oldpassword" class="form-control form-control-sm" id="oldpassword" placeholder="Enter your old password">
                    <span toggle="#oldpassword" id="toggle-for-icon" class="fa fa-eye-slash fa-eye field-icon toggle-password"></span>
                    </div>
                    
                    <div class="form-group">
                    <label for="newpassword">New Password</label>
                    <input type="password" pattern="(?=^.{6,24}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).*$" title="Password atlest have one capital ,lowercase ,special character ,number and 6 to 24 long" name="newpassword" class="form-control form-control-sm" id="newpassword" placeholder="Enter your new password">
                    <span toggle="#newpassword" id="toggle-for-icon1" class="fa fa-eye-slash fa-eye field-icon toggle-password1"></span>
                    </div>
                    
                    <div class="form-group">
                    <label for="confirmpassword">Confirm Password</label>
                    <input type="password" pattern="(?=^.{6,24}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).*$" title="Password atlest have one capital ,lowercase ,special character ,number and 6 to 24 long" name="confirmpassword" class="form-control form-control-sm" id="confirmpassword" placeholder="Enter your confirm password">
                    <span toggle="#confirmpassword" id="toggle-for-icon2" class="fa fa-eye-slash fa-eye field-icon toggle-password2"></span>
                    </div>
                    
                    <button type="submit" name="update" class="btn">submit</button>
                    
                </form>
                
            </div>
        
        </div>
    </section>
    <!-- forgot password ends --> 
    
	<?php include 'includes/scriptlink.php'; ?>
    
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