<?php ob_start(); ?>
<?php 
    include 'includes/db.php';
    session_start();
    error_reporting(E_ALL);
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
                $files1 = $notefiles;
                $filesinfo = explode("/",$files1[0]);
                $folderpath = $filesinfo[0] . "/" . $filesinfo[1] . "/" . $filesinfo[2] . "/" . $filesinfo[3] . "/" . $filesinfo[4] ;
                $zipname = $folderpath . "/notes.zip";
                $rootPath = realpath($folderpath);
                $zip = new ZipArchive();
                $zip->open($zipname, ZipArchive::CREATE | ZipArchive::OVERWRITE);
                /** @var SplFileInfo[] $files */
                $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($rootPath),RecursiveIteratorIterator::LEAVES_ONLY);
                foreach ($files as $name => $file)
                {
                    // Skip directories (they would be added automatically)
                    if (!$file->isDir())
                    {
                        // Get real and relative path for current file
                        $filePath = $file->getRealPath();
                        $relativePath = substr($filePath, strlen($rootPath) + 1);

                        // Add current file to archive
                        $zip->addFile($filePath, $relativePath);
                    }
                }
                ob_end_clean();
                $zip->close();
                header('Content-Type: application/zip');
                header('Content-disposition: attachment; filename='.$zipname);
                header('Content-Length: ' . filesize($zipname));
                readfile($zipname);
                unlink($zipname);
            }
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