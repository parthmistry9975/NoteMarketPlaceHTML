<?php ob_start(); ?>
<?php include 'includes/db.php'; ?>
<?php  

    session_start();
    if($_GET['admin'] != 1){
        header("location:../front/login.php");
    }
    if(!isset($_SESSION['ID'])){
        header("location:../front/login.php");
    }
    if(isset($_SESSION['update']) and $_SESSION['update'] == 'yes'){
        $_SESSION['status'] = "Password Updated";
        $_SESSION['status_code'] = "success";
        unset($_SESSION['update']);
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
                    $update_pw_query = "UPDATE users SET Password = '$Pass' , ModifiedDate = NOW() , ModifiedBy = $loginid WHERE ID = $loginid";
                    $update_pw = mysqli_query($connection, $update_pw_query);
                    if($update_pw){
                        $_SESSION['update'] = "yes";
                        header("location:change-admin.php?admin=1");
                    }else{
                        $_SESSION['status'] = "Password isn't Updated";
                        $_SESSION['status_code'] = "error";
                        header("location:change-admin.php?admin=1");
                    }
                }else{
                    $_SESSION['status'] = "new password and confirm password arn't same !!";
                    $_SESSION['status_code'] = "warning";
                }
            }else{
                $_SESSION['status'] = "Wrong current password entered !!";
                $_SESSION['status_code'] = "warning";
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
    
    <!-- responsive css -->
    <link rel="stylesheet" href="css/responsive.css">

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
                
                <form action="change-admin.php?admin=1" method="post">
                    
                    <div class="form-group">
                    <label for="exampleInputPassword1">Old Password</label>
                    <input type="password" pattern="(?=^.{6,24}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).*$" title="enter proper valid password " name="oldpassword" class="form-control form-control-sm" id="exampleInputPassword1" placeholder="Enter your old password">
                    <span toggle="#exampleInputPassword1" class="fa fa-eye-slash fa-eye field-icon toggle-password"></span>
                    </div>
                    
                    <div class="form-group">
                    <label for="exampleInputPassword2">New Password</label>
                    <input type="password" pattern="(?=^.{6,24}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).*$" title="Password atlest have one capital ,lowercase ,special character ,number and 6 to 24 long" name="newpassword" class="form-control form-control-sm" id="exampleInputPassword2" placeholder="Enter your new password">
                    <span toggle="#exampleInputPassword2" class="fa fa-eye-slash fa-eye field-icon toggle-password"></span>
                    </div>
                    
                    <div class="form-group">
                    <label for="exampleInputPassword3">Confirm Password</label>
                    <input type="password" pattern="(?=^.{6,24}$)((?=.*\d)|(?=.*\W+))(?![.\n])(?=.*[A-Z])(?=.*[a-z])(?=.*[0-9]).*$" title="Password atlest have one capital ,lowercase ,special character ,number and 6 to 24 long" name="confirmpassword" class="form-control form-control-sm" id="exampleInputPassword3" placeholder="Enter your confirm password">
                    <span toggle="#exampleInputPassword3" class="fa fa-eye-slash fa-eye field-icon toggle-password"></span>
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
    <script src="js/bootstrap/popper.min.js"></script>
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