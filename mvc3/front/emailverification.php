<?php ob_start(); ?>
<?php include 'includes/db.php'; ?>
<?php 
    session_start();
    
    if(isset($_SESSION['message'])){
        unset($_SESSION['message']);
    }

    if(isset($_GET["id"])){
        $email_id = $_GET["id"];
        $query = "UPDATE users SET IsEmailVerified = 1 WHERE EmailID = '".$email_id."'";
        $update_query = mysqli_query($connection,$query);
        if($update_query){
            
            $_SESSION['status'] = "Your Email Address is Verified !!";
            $_SESSION['status_code'] = "success";
            $_SESSION['verification'] = "your email is verified";
            header("location:login.php");

        }
    }

?>
