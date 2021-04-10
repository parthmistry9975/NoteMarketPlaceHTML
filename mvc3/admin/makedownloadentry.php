<?php ob_start(); ?>
<?php 
    include 'includes/db.php';
    session_start();
?>
<?php

if(isset($_GET['downloadentry'])){
            $noteid_4_download_entry = $_GET['downloadentry'];

            $fetch_note_records_query = "SELECT seller_notes.SellerID AS sellerid , seller_notes.IsPaid AS ispaid , seller_notes.SellingPrice AS price , seller_notes.Title AS notetitle , note_categories.Name AS categoryname FROM seller_notes INNER JOIN note_categories ON seller_notes.Category = note_categories.ID WHERE seller_notes.ID = $noteid_4_download_entry AND seller_notes.IsActive =1 AND note_categories.IsActive =1";
            $fetch_note_records = mysqli_query($connection, $fetch_note_records_query);
            $note_records = mysqli_fetch_assoc($fetch_note_records);

            $fetch_note_attachment_records_query = "SELECT FilePath FROM seller_notes_attachements WHERE NoteID = $noteid_4_download_entry AND IsActive = 1";
            $fetch_note_attachment_records = mysqli_query($connection, $fetch_note_attachment_records_query);

            $insert_sellerid = $note_records['sellerid'];
            $insert_ispaid = $note_records['ispaid'];
            $insert_noteprice = $note_records['price'];
            $insert_notetitle = $note_records['notetitle'];
            $insert_notecategory = $note_records['categoryname'];
            $loginid = $_SESSION['ID'];
    
            $check_download_query = "SELECT * FROM downloads WHERE NoteID = $noteid_4_download_entry AND Downloader = $loginid";
            $check_download = mysqli_query($connection , $check_download_query);
            $check_download_final = mysqli_fetch_assoc($check_download);
            $download_number = mysqli_num_rows($check_download);
            $check_allow_download = $check_download_final['IsSellerHasAllowedDownload'];
            $check_when_download = $check_download_final['IsAttachmentDownloaded'];
    
            if($download_number == 0){
                
                while ($insert_note_attachment_record_row = mysqli_fetch_assoc($fetch_note_attachment_records)){

                $insert_noteattachment_path = $insert_note_attachment_record_row['FilePath'];
                $insert_download_entry_query = "INSERT INTO downloads ( NoteID , Seller , Downloader , IsSellerHasAllowedDownload , AttachmentPath , IsAttachmentDownloaded , AttachmentDownloadedDate , IsPaid , PurchasedPrice , NoteTitle , NoteCategory , CreatedBy ) VALUES ( '$noteid_4_download_entry' , '$insert_sellerid' , '$loginid' , '1' , '$insert_noteattachment_path' , '1' , NOW() , $insert_ispaid , '$insert_noteprice' , '$insert_notetitle' , '$insert_notecategory' , '$loginid')";
                $insert_download_entry = mysqli_query($connection ,$insert_download_entry_query);
                    if($insert_download_entry){
                        header('location:download.php?noteid='.$noteid_4_download_entry);
                    }
                    
                }
                
            }else{
                
                $update_record_query = "UPDATE downloads SET AttachmentDownloadedDate = NOW() , ModifiedDate = NOW() , ModifiedBy = $loginid WHERE NoteID = $noteid_4_download_entry AND Downloader = $loginid";
                $update_record = mysqli_query($connection , $update_record_query);
                if($update_record){
                    header('location:download.php?noteid='.$noteid_4_download_entry);
                }
                
            }

        }
?>