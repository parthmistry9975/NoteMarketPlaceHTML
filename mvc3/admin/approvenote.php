<?php ob_start(); ?>
<?php 
    include 'includes/db.php';
    session_start();
    if(!isset($_SESSION['ID'])){
        header("location:../front/login.php");
    }
?>
<?php

    if(isset($_GET['noteid'])){
        
        $noteid = $_GET['noteid'];
        $loginid = $_SESSION['ID'];
        $approve_note_query = "UPDATE seller_notes SET status = 9 , ActionedBy = $loginid , PublishedDate = NOW() , ModifiedDate = NOW() , ModifiedBy = $loginid WHERE ID = $noteid";
        $approve_note = mysqli_query($connection , $approve_note_query);
        if($approve_note){
            $_SESSION['approve-note'] = "yes";
            header("location:admindashboard.php?admin=1");
        }else{
            $_SESSION['approve-note'] = "no";
            header("location:admindashboard.php?admin=1");
        }
        
    }
    else{
        header("location:"."admindashboard.php?admin=1");
    }


?>