<?php ob_start(); ?>
<?php include 'includes/db.php'; ?>
<?php  

    session_start();
    if(!isset($_SESSION['ID'])){
        header("location:login.php");
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
                        ?>
                        <script>
                            alert("password updated !!");
                            window.location = "userdashboard.php";
                        </script>
                        <?php 
                    }else{
                        ?>
                        <script>
                            alert("new password and confirm password arn't same !!");
                        </script>
                        <?php 
                    }
                }else{
                    ?>
                    <script>
                        alert("new password and confirm password arn't same !!");
                    </script>
                    <?php 
                    }
                
            }else{
                ?>
                <script>
                    alert("Wrong old Password entered");
                </script>
                <?php
            }
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
                    <input type="password" name="oldpassword" class="form-control form-control-sm" id="oldpassword" placeholder="Enter your old password">
                    <span toggle="#oldpassword" id="toggle-for-icon" class="fa fa-eye-slash fa-eye field-icon toggle-password"></span>
                    </div>
                    
                    <div class="form-group">
                    <label for="newpassword">New Password</label>
                    <input type="password" name="newpassword" class="form-control form-control-sm" id="newpassword" placeholder="Enter your new password">
                    <span toggle="#newpassword" id="toggle-for-icon1" class="fa fa-eye-slash fa-eye field-icon toggle-password1"></span>
                    </div>
                    
                    <div class="form-group">
                    <label for="confirmpassword">Confirm Password</label>
                    <input type="password" name="confirmpassword" class="form-control form-control-sm" id="confirmpassword" placeholder="Enter your confirm password">
                    <span toggle="#confirmpassword" id="toggle-for-icon2" class="fa fa-eye-slash fa-eye field-icon toggle-password2"></span>
                    </div>
                    
                    <button type="submit" name="update" class="btn">submit</button>
                    
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