<?php ob_start(); ?>
<?php include 'includes/db.php'; ?>
<?php  

    session_start();
    if(!isset($_SESSION['ID'])){
        header("location:login.php");
    }
?>

<?php   

    if(isset($_GET["delete_id"])){
        $delete_id = $_GET["delete_id"];
        $delete_note_query = "DELETE FROM seller_notes WHERE ID = $delete_id";
        $delete_note = mysqli_query($connection, $delete_note_query);
        if($delete_note){
            ?>
            <script>
                alert("note deleted!!!");
                window.location.href = "userdashboard.php";
            </script>
            <?php
        }else{
            
        }
    }

?>