<?php ob_start(); ?>
<?php 
    include 'includes/db.php';
    session_start();
    if(!isset($_SESSION['ID'])){
        header("location:../front/login.php");
    }
    if(!isset($_SESSION['ID'])){
        header("location:../front/login.php");
    }
?>
<?php

    if(isset($_GET['noteid'])){
        
        $noteid = $_GET['noteid'];
        $loginid = $_SESSION['ID'];
        $toinreview_note_query = "UPDATE seller_notes SET status = 8 , ActionedBy = $loginid , ModifiedDate = NOW() , ModifiedBy = $loginid WHERE ID = $noteid";
        $toinreview_note = mysqli_query($connection , $toinreview_note_query);
        if($toinreview_note){
            ?>
            <script>
                
                alert('note is added to inreview !!');
                window.history.back();
                
            </script>
            <?php
        }else{
             ?>
            <script>
                
                alert('note is not added to inreview !!');
                window.history.back();
                
            </script>
            <?php
        }
        
    }
    else{
        header("location:"."admindashboard.php?admin=1");
    }


?>