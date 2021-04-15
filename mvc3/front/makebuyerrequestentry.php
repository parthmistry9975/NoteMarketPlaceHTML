<?php ob_start(); ?>
<?php 
    include 'includes/db.php';
?>
<?php 
    session_start();
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
?>
<?php

    if(isset($_GET['noteid'])){
            $noteid_4_download_entry = $_GET['noteid'];

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
        
            $check_buyer_request_query = "SELECT * FROM downloads WHERE NoteID = $noteid_4_download_entry AND Downloader = $loginid";
            $check_buyer_request = mysqli_query($connection , $check_buyer_request_query);
            $check_buyer_request_final = mysqli_fetch_assoc($check_buyer_request);
            $buyer_request_number = mysqli_num_rows($check_buyer_request);
            $check_allow_download = $check_buyer_request_final['IsSellerHasAllowedDownload'];
        
            if($buyer_request_number == 0){
                
                while ($insert_note_attachment_record_row = mysqli_fetch_assoc($fetch_note_attachment_records)){
                    
                    $insert_download_entry_query = "INSERT INTO downloads ( NoteID , Seller , Downloader , IsSellerHasAllowedDownload ,  IsAttachmentDownloaded , IsPaid , PurchasedPrice , NoteTitle , NoteCategory , CreatedBy ) VALUES ( '$noteid_4_download_entry' , '$insert_sellerid' , '$loginid' , 0 , 0 , $insert_ispaid , $insert_noteprice , '$insert_notetitle' , '$insert_notecategory' , '$loginid')";
                    $insert_download_entry = mysqli_query($connection ,$insert_download_entry_query);
                    
                }

                $fetch_seller_info = "SELECT * FROM users WHERE ID = $insert_sellerid";
                $seller_info = mysqli_query($connection , $fetch_seller_info);
                $sinfo = mysqli_fetch_assoc($seller_info);

                $fetch_buyer_info = "SELECT * FROM users WHERE ID = $loginid";
                $buyer_info = mysqli_query($connection , $fetch_buyer_info);
                $binfo = mysqli_fetch_assoc($buyer_info);

                require 'src/Exception.php';
                require 'src/PHPMailer.php';
                require 'src/SMTP.php';

                $mail = new PHPMailer(true);

                    try {
                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';
                        $mail->SMTPAuth = true;
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Port = 587;

                        $config_email = '170320116025.it.parth@gmail.com';
                        $mail->Username = $config_email;
                        $mail->Password = 'Parth@1234';

                        // Sender and recipient settings
                        $mail->setFrom($config_email, 'Note Market Place');

                        $mail->addAddress($sinfo['EmailID'],$sinfo['FirstName']." ".$sinfo['LastName']);
                        $mail->addReplyTo($config_email, 'Note Market Place');

                        $mail->IsHTML(true);
                        $mail->Subject = "About buyer request for your notes NotesMarketplace";
                        $mail->Body = "Hello ".$sinfo['FirstName']." ".$sinfo['LastName'].",<br>&nbsp;&nbsp;&nbsp; 
                            We would like to inform you that, ".$binfo['FirstName']." ".$binfo['LastName']." wants to purchase your notes. Please see Buyer Requests tab and allow download access to Buyer if you have received the payment from him. <br>Regards, <br>Notes Marketplace";
                        $mail->AltBody = 'see your buyer request on portal';

                        $mail->send();
                    } catch (Exception $e) {
                        echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
                    }

                $_SESSION['showmodal'] = 1;
                header("location:notedetails.php?noteid=$noteid_4_download_entry");
                
            }elseif( $buyer_request_number > 0 && $check_allow_download == 1 ){
                
                ?>
                <script>
                
                    alert('your request has been accepted visit mydownload page to download note!!');
                    location.replace("mydownloads.php");
                
                </script>
                <?php
                
            }else{
                
                ?>
                <script>
                
                    alert('your request has been registered please wait untill seller allowed to download !!');
                    location.replace("notedetails.php?noteid=<?php echo $noteid_4_download_entry; ?>");
                
                </script>
                <?php
                
            }
            
        }

?>