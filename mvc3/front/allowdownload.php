<?php ob_start(); ?>
<?php include 'includes/db.php'; ?>
<?php  

    session_start();
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    if(!isset($_SESSION['ID'])){
        header("location:login.php");
    }
?>

<?php   

    if(isset($_GET["allow"])){
        
        $x = 0;
        $allow = explode('-',$_GET["allow"]);
        $allow_id = $allow[0];
        $buyer_id = $allow[1];
        $loginid = $_SESSION['ID'];
        $get_seller = mysqli_query($connection,"SELECT FirstName,LastName FROM users WHERE ID = $loginid");
        $seller_name = mysqli_fetch_assoc($get_seller);
        $seller = $seller_name['FirstName']." ".$seller_name['LastName'];
        $get_buyer = mysqli_query($connection,"SELECT FirstName,LastName FROM users WHERE EmailID  = '$buyer_id'");
        $buyer_name = mysqli_fetch_assoc($get_buyer);
        $buyer = $buyer_name['FirstName']." ".$buyer_name['LastName'];
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
                $_SESSION['status'] = "Note is allowed to download";
                $_SESSION['status_code'] = "success";
            
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
                        $mail->setFrom($config_email, 'Parth Mistry');

                        $mail->addAddress($buyer_id,$buyer);
                        $mail->addReplyTo($config_email, 'Parth Mistry');

                        $mail->IsHTML(true);
                        $mail->Subject = "$seller Allows you to download a note";
                        $mail->Body = "Hello $buyer,<br><br>We would like to inform you that, $seller Allows you to download a note.Please login and see My Download tabs to download particular note.<br><br>Regards,<br>Notes Marketplace";
                        $mail->AltBody = ' ';

                        $mail->send();
                        
                    } catch (Exception $e) {
                        echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
                    }
            
                header("location:buyerrequest.php");
                
        }else{
                
                $_SESSION['status'] = "note isn't allowed to download there is some problem";
                $_SESSION['status_code'] = "error";
                header("location:buyerrequest.php");
                
                
            
        }
    }

?>