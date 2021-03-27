<?php ob_start(); ?>
<?php include 'includes/db.php'; ?>
<?php  

    session_start();
    if(!isset($_SESSION['ID'])){
        header("location:login.php");
    }
?>

<?php   

    if(isset($_GET["allow"])){
        $allow_id = $_GET["allow"];
        $allow_note_query = "UPDATE downloads SET IsSellerHasAllowedDownload = 1 WHERE ID =".$allow_id;
        $allow_note = mysqli_query($connection, $allow_note_query);
        if($allow_note){
            ?>
            <script>
                
                alert("note has been allowed to download to");
                window.location.href = "buyerrequest.php";
                
                
            </script>
            <?php
        }else{
            
        }
    }

?>