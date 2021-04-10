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
        
        $x = 0;
        $allow_id = $_GET["allow"];
        $noteid = $_GET["noteid"];
        $get_attachment_query = "SELECT FilePath FROM seller_notes_attachements WHERE NoteID = $noteid AND IsActive = 1";
        $get_attachment = mysqli_query($connection , $get_attachment_query);
        $numoffiles = mysqli_num_rows($get_attachment);
        
        while ($get_attachment_row = mysqli_fetch_assoc($get_attachment)){ 
            
            $path = $get_attachment_row['FilePath'];
            $allow_note_query = "UPDATE downloads SET IsSellerHasAllowedDownload = 1, AttachmentPath = '$path' WHERE ID = $allow_id AND IsSellerHasAllowedDownload = 0 AND AttachmentPath IS NULL";
            $allow_note = mysqli_query($connection, $allow_note_query);
            $x++;
            $allow_id++;
        }
        if($x = $numoffiles){
    
            ?>
            <script>
                
                alert("note has been allowed to download");
                window.location.href = "buyerrequest.php";
                
                
            </script>
            <?php
        }else{
            ?>
            <script>
                
                alert("note hasn't been allowed to download");
                window.location.href = "buyerrequest.php";
                
                
            </script>
            <?php
        }
    }

?>