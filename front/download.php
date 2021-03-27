<?php ob_start(); ?>
<?php 
    include 'includes/db.php';
    session_start();
?>

<?php 

    if(isset($_GET['noteid'])){
        $NoteID = $_GET['noteid'];
        if(isset($_GET['downloadentry'])){
            header("location:makedownloadentry.php?downloadentry=$NoteID");
        }
        $download_notes_query = "SELECT FilePath FROM seller_notes_attachements WHERE NoteID = $NoteID AND IsActive = 1";
        $download_notes = mysqli_query($connection, $download_notes_query);
        $filescount = mysqli_num_rows($download_notes);
        if($download_notes){
            $notes_paths = "";
            $x=0;
            while ($download_row = mysqli_fetch_array($download_notes)){


                $notes_paths = $notes_paths . $download_row['FilePath'];
                $x++;
                if($x < $filescount){
                    $notes_paths .= "-";    
                }
            }
            $notefiles = explode("-",$notes_paths);
            if(empty($notes_paths)){
                header("location:mydownloads.php");
            }
            if($filescount == 1){
                $file = $notefiles[0];
                header("content-disposition: attachment; filename=" . $file); 
                $fb = fopen($file, "r");
                while(!feof($fb)){
                    echo fread($fb, 8192);
                    flush();
                }
                fclose($fb);
                
            }else{
                $files = $notefiles;
                $zipname = 'noteszip.zip';
                $zip = new ZipArchive;
                $zip->open($zipname,ZipArchive::CREATE);
                foreach ($files as $file) {
                  $zip->addFile($file);
                }
                header('Content-Type: application/zip');
                header('Content-disposition: attachment; filename='.$zipname);
                header('Content-Length: ' . filesize($zipname));
                readfile($zipname);
                $zip->close($zipname);
                

            }
    //        for( $p=0; $p<sizeof($notefiles); $p++ ){
    //            $file = $notefiles[$p];
    //            header("content-disposition: attachment; filename=" . $file); 
    //            $fb = fopen($file, "r");
    //            while(!feof($fb)){
    //                echo fread($fb, 8192);
    //                flush();
    //            }
    //            fclose($fb);
    //        }
        }else{
            ?>
            <script>
                alert("note file is deleted ");
                location.replace("userdashboard.php")
            </script>
            <?php
        }
        
    }else{
        header("location:mydownloads.php");
    }
    
?>