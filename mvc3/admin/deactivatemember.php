<?php ob_start(); ?>
<?php 
    include 'includes/db.php';
    session_start();
    if(!isset($_SESSION['ID'])){
        header("location:../front/login.php");
    }
    
?>
<?php

    if(isset($_GET['memberid'])){
    
        $memberid = $_GET['memberid'];
        $logiid = $_SESSION['ID'];
        $update_isactive_query = "UPDATE users SET IsActive = 0 , ModifiedDate = NOW() , ModifiedBy = $logiid WHERE ID = $memberid";
        $update_isactive = mysqli_query($connection , $update_isactive_query);
        
        $update_notes_query = "UPDATE seller_notes SET Status = 11, ActionedBy = $logiid , ModifiedDate = NOW() , ModifiedBy = $logiid  WHERE SellerID = $memberid";
        $update_notes = mysqli_query($connection , $update_notes_query);
        
        if($update_isactive && $update_notes){
            ?>
            <script>
                alert("member deactivated !!");
                window.location = "members.php?admin=1";
            </script>
            <?php 
        }else{
            ?>
            <script>
                alert("member not deactivated !!");
                window.location = "members.php?admin=1";
            </script>
            <?php
        }
        
    }else{
        header('location:members.php?admin=1');
    }

?>