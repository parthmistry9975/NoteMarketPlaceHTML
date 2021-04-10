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
        $unpublish_note_query = "UPDATE seller_notes SET Status = 8 , ActionedBy = $loginid , ModifiedDate = NOW() , ModifiedBy = $loginid WHERE ID = $noteid";
        $unpublish_note = mysqli_query($connection , $unpublish_note_query);
        if($unpublish_note){
            ?>
            <script>
                
                alert('note unpublished');
                window.history.back();
                
            </script>
            <?php
        }else{
             ?>
            <script>
                
                alert('note not unpublished');
                window.history.back();
                
            </script>
            <?php
        }
        
    }
    else{
        header("location:"."admindashboard.php?admin=1");
    }



?>