<?php ob_start();
      session_start();    
?>
<?php include 'includes/db.php'; 
      
?>
<?php 
    $verification = "Enter your email address and password to login";
    if(isset($_SESSION['verification'])){
        $verification .= "<br><i class='fa fa-check-circle' aria-hidden='true'></i>&nbsp;".$_SESSION['verification'];
        unset($_SESSION['verification']);
    }
    if(isset($_SESSION['message'])){
        unset($_SESSION['message']);
    }
    if(isset($_SESSION['showpassreset']) and $_SESSION['showpassreset'] == 'yes'){
        $_SESSION['status'] = "password reseted , check your mail !!";
        $_SESSION['status_code'] = "success";
        unset($_SESSION['showpassreset']);
    }
    
    if(isset($_POST['submit'])){
        
        $Email_ID = $_POST['email_id'];
        $Password = $_POST['password'];
        $fetch_data_query = "SELECT * FROM users WHERE EmailID = '$Email_ID' AND IsEmailVerified = 1";
        $fetch_data = mysqli_query($connection, $fetch_data_query);
        $emailcount = mysqli_num_rows($fetch_data);
        if($emailcount){
            $fetch_data_array = mysqli_fetch_assoc($fetch_data);
            $Stored_Password = $fetch_data_array['Password'];
            $_SESSION['ID'] = $fetch_data_array['ID'];
            $_SESSION['ROLE'] = $fetch_data_array['RoleID'];
            $_SESSION['FNAME'] = $fetch_data_array['FirstName'];
            $_SESSION['LNAME'] = $fetch_data_array['LastName'];
            $_SESSION['MAILID'] = $fetch_data_array['EmailID'];
            $Compare_Password = password_verify($Password, $Stored_Password);
            if(password_verify($Password, $Stored_Password)){
                if(isset($_POST['rememberme'])){
                    setcookie('emailidcookie',$Email_ID,time()+10800);
                    setcookie('passwordcookie',$Password,time()+10800);
//                    $_SESSION['justlogin'] = 1;
                    if($fetch_data_array['RoleID'] == 2 or $fetch_data_array['RoleID'] == 1){
                        header("location:"."../admin/admindashboard.php?admin=1");
                    }else{
                        $fetch_profile_query = "SELECT * FROM user_profile WHERE UserID = ".$_SESSION['ID'];
                        $fetch_profile = mysqli_query($connection , $fetch_profile_query);
                        $profile = mysqli_num_rows($fetch_profile);
                        if($profile == 0){
                            header("location:userprofile.php");
                        }else{
                            header("location:searchnotes.php");
                        }
                    }
                }else{  
                    if($fetch_data_array['RoleID'] == 2 or $fetch_data_array['RoleID'] == 1){
                        header("location:"."../admin/admindashboard.php?admin=1");
                    }else{
                        $fetch_profile_query = "SELECT * FROM user_profile WHERE UserID = ".$_SESSION['ID'];
                        $fetch_profile = mysqli_query($connection , $fetch_profile_query);
                        $profile = mysqli_num_rows($fetch_profile);
                        if($profile == 0){
                            header("location:userprofile.php");
                        }else{
                            header("location:searchnotes.php");
                        }
                    }
                }
            }else{
                $_SESSION['status'] = "Wrong Password !";
                $_SESSION['status_code'] = "error";
            }
        }else{
            $_SESSION['status'] = "Invalid EmailID , Register your self !";
            $_SESSION['status_code'] = "warning";
            
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

</head>
<body>
    
	<!-- preloader -->
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    
    <!-- login Page -->
    <section id="login">
        
        <!-- background image -->
        <img class="bg-image img-responsive" src="images/login/banner-with-overlay.jpg" alt="login background">
        
        <div class="login-form">
            
            <!-- logo -->
            <img onclick="window.location.href='index.php'" src="images/login/top-logo.png" alt="Notes MarketPlace">
            
            <div class="form-center">
                <div class="login-heading text-center">
                    <h2>Login</h2>    
                    <p><?php echo $verification; ?></p>
                </div>
                <form action="login.php" method="post">               
                    <div class="form-group">
                    <label for="email_id">Email</label>
                    <input type="email" title="valid email formate : char@char.char" name="email_id" class="form-control form-control-sm" id="email_id" aria-describedby="emailHelp" placeholder="Enter email" value="<?php if(isset($_COOKIE['emailidcookie'])){ echo $_COOKIE['emailidcookie'] ; } ?>">
                    </div>
                    <div class="form-group">
                    <label for="password">Password<a class="forgot-ps" href="forgotpw.php">Forgot Password?</a></label>
                    <input type="password" pattern="(?=^.{6,24}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).*$" title="enter proper valid password " name="password" id="login-password" class="form-control form-control-sm" id="password" placeholder="Password" value="<?php if(isset($_COOKIE['passwordcookie'])){ echo $_COOKIE['passwordcookie'] ; } ?>">
                    <span toggle="#login-password" class="fa fa-eye-slash fa-eye field-icon toggle-password"></span>
                    </div>
                    <div class="form-check">
                    <input type="checkbox" name="rememberme" class="form-check-input form-check-size" id="exampleCheck1">
                    <label class="form-check-label check-label" for="exampleCheck1">Remember Me</label>
                    </div>
                    <button type="submit" name="submit" class="btn">LOGIN</button>
                </form>
                <div class="login-footer text-center">
                    <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
                </div>
            
            </div>
            
        </div>
        
            
                           
    </section>
        
    <!-- ends -->
    
	<!-- jquery-->
    <script src="js/jquery.min.js"></script>

    <!-- bootstrap js -->
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

</body>
</html>