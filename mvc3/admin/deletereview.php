<?php ob_start(); ?>
<?php 
    include 'includes/db.php';
    session_start();
    if($_GET['admin'] != 1){
        header("location:../front/login.php");
    }
    if(!isset($_SESSION['ID'])){
        header("location:../front/login.php");
    } 
?>
<?php

    if(isset($_GET['reviewid'])){
    
        $reviewid = $_GET['reviewid'];
        $logiid = $_SESSION['ID'];
        $noteid = $_GET['noteid'];
        $delete_review_query = "DELETE FROM seller_notes_reviews WHERE ID = $reviewid";
        $delete_review = mysqli_query($connection , $delete_review_query);
        
        if($delete_review){
            ?>
            <script>
                alert("review deleted !!");
                window.location = "adminnotedetail.php?admin=1&noteid=<?php echo $noteid; ?>";
            </script>
            <?php 
        }else{
            ?>
            <script>
                alert("review not deleted !!");
                window.location = "adminnotedetail.php?admin=1&noteid=<?php echo $noteid; ?>";
            </script>
            <?php
        }
        
    }else{
        header('location:members.php?admin=1');
    }

?>