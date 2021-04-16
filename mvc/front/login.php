<?php ob_start();
      session_start();    
?>
<?php include 'includes/db.php'; 
      
?>
<?php 
    
    if(isset($_SESSION['message'])){
        $verification = $_SESSION['message'];
        ?>
        <script>
            alert('<?php echo $verification ; ?>');
        </script>
        <?php
        unset($_SESSION['message']);
    }
    
    if(isset($_POST['submit'])){
        
        $Email_ID = $_POST['email_id'];
        $Password = $_POST['password'];
        $fetch_data_query = "SELECT * FROM users WHERE EmailID = '".$Email_ID."' AND IsEmailVerified = 1";
        $fetch_data = mysqli_query($connection, $fetch_data_query);
        $emailcount = mysqli_num_rows($fetch_data);
        if($emailcount){
            $fetch_data_array = mysqli_fetch_assoc($fetch_data);
            $Stored_Password = $fetch_data_array['Password'];
            $_SESSION['ID'] = $fetch_data_array['ID'];
            $_SESSION['FNAME'] = $fetch_data_array['FirstName'];
            $_SESSION['LNAME'] = $fetch_data_array['LastName'];
            $_SESSION['MAILID'] = $fetch_data_array['EmailID'];
            $Compare_Password = password_verify($Password, $Stored_Password);
            if(password_verify($Password, $Stored_Password)){
                if(isset($_POST['rememberme'])){
                    setcookie('emailidcookie',$Email_ID,time()+10800);
                    setcookie('passwordcookie',$Password,time()+10800);
                    if($fetch_data_array['RoleID'] == 2){
                        header("location:"."../admin/admindashboard.php");
                    }else{
                        header("location:searchnotes.php");
                    }
                }else{  
                    if($fetch_data_array['RoleID'] == 2){
                        header("location:"."../admin/admindashboard.php");
                    }else{
                        header("location:searchnotes.php");
                    }
                }
            }else{
                ?>
                <script>
                    alert("Wrong Password");
                </script>
                <?php
            }
        }else{
            ?>
            <script>
                alert("Invalid EmailID");
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
            <img src="images/login/top-logo.png" alt="Notes MarketPlace">
            
            <div class="form-center">
                <div class="login-heading text-center">
                    <h2>Login</h2>    
                    <p>Enter your email address and password to login</p>
                </div>
                <form action="login.php" method="post">               
                    <div class="form-group">
                    <label for="email_id">Email</label>
                    <input type="email" name="email_id" class="form-control form-control-sm" id="email_id" aria-describedby="emailHelp" placeholder="Enter email" value="<?php if(isset($_COOKIE['emailidcookie'])){ echo $_COOKIE['emailidcookie'] ; } ?>">
                    </div>
                    <div class="form-group">
                    <label for="password">Password<a class="forgot-ps" href="forgotpw.php">Forgot Password?</a></label>
                    <input type="password" name="password" class="form-control form-control-sm" id="password" placeholder="Password" value="<?php if(isset($_COOKIE['passwordcookie'])){ echo $_COOKIE['passwordcookie'] ; } ?>">
                    <span toggle="#password" id="toggle-for-icon" class="fa fa-eye-slash fa-eye field-icon toggle-password"></span>
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

    <!-- custom js -->
    <script src="js/script.js"></script>

</body>
</html>