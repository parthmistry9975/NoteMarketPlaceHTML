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
            ?>
            <script>
                
                alert('note published');
                window.history.back();
                
            </script>
            <?php
        }else{
             ?>
            <script>
                
                alert('note is not unpublished');
                window.history.back();
                
            </script>
            <?php
        }
        
    }
    else{
        header("location:"."admindashboard.php?admin=1");
    }


?>