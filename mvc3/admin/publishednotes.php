<?php ob_start(); ?>
<?php include 'includes/db.php'; ?>
<?php  

    session_start();
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    if($_GET['admin'] != 1){
        header("location:../front/login.php");
    }
    if(!isset($_SESSION['ID'])){
        header("location:../front/login.php");
    }
?>
    
    <?php include 'includes/header.php'; ?>
    
    <?php
    
        if(isset($_POST['unpublishpost'])){
            
            
            $comment = mysqli_real_escape_string($connection,$_POST['remark']);
            $unpublishid = mysqli_real_escape_string($connection,$_POST['unpublishpost']);
            $unpublishidArray = explode("-",$unpublishid);
            $noteid = $unpublishidArray[0];
            $notetitle = $unpublishidArray[1];
            $sellerid = $unpublishidArray[2];
            $loginid = $_SESSION['ID'];
            
            $get_seller_email_query = "SELECT EmailID,FirstName,LastName FROM users WHERE ID = $sellerid";
            $get_seller_email = mysqli_query($connection , $get_seller_email_query);
            $seller_email = mysqli_fetch_assoc($get_seller_email);
            $seller_emailid = $seller_email['EmailID'];
            $seller_firstname = $seller_email['FirstName'];
            $seller_lastname = $seller_email['LastName'];

            $update_to_unpublish_query = "UPDATE seller_notes SET Status = 11 , ActionedBy = $loginid , AdminRemarks = '$comment' , ModifiedDate = NOW() , ModifiedBy = $loginid WHERE ID = $noteid";
            $update_to_unpublish = mysqli_query($connection,$update_to_unpublish_query);
            
            if($update_to_unpublish){
                
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

                        $mail->addAddress($seller_emailid,$seller_firstname." ".$seller_lastname);
                        $mail->addReplyTo($config_email, 'Note Market Place');

                        $mail->IsHTML(true);
                        $mail->Subject = "About your note unpublished on NotesMarketplace";
                        $mail->Body = "Hello ".$seller_firstname." ".$seller_lastname.", <br><br>We want to inform you that, your note $notetitle has been removed from the portal.Please find our remarks as below -<br>$comment<br><br>Regards,<br>Notes Marketplace";
                        $mail->AltBody = 'see your note unpublished on portal';
                        $_SESSION['status'] = "note Unpublished !!";
                        $_SESSION['status_code'] = "success";
                        $mail->send();
                        $_SESSION['adminunpublish'] = "yes";
                    } catch (Exception $e) {
                        echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
                    }
                
            }
            else{
                $_SESSION['status'] = "note isn't Unpublished !!";
                $_SESSION['status_code'] = "error";
                $_SESSION['adminunpublish'] = "no";
            }
            
            
        }
    
    
    ?>
    
    <!-- Modal -->
    <div class="modal fade" id="publish-modal" tabindex="-1" role="dialog" aria-labelledby="downloadmodaltitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container modal-reject-form">
                        <form action="publishednotes.php?admin=1" onsubmit="return confirm('Are you sure you want to Unpublish this note?');" method="post" class="row col-md-12 reject-form">
                            <div class="form-row reject-form-heading">
                                <h5 id="rejectmodalheading" class="col-md-12"></h5>
                            </div>
                            <div class="col-md-12 form-row">
                                <div>
                                    <label for="lastname">Remarks</label>
                                </div>
                            </div>
                            <div class="col-md-12 form-row">
                                <div>
                                    <textarea name="remark" id="remark" placeholder="Write remarks" cols="59" rows="8" required></textarea>
                                </div>
                            </div>
                            <div class="col-md-12 form-row">
                                <div class="reject-buttons text-right">
                                    <button type="submit" id="unpublishpost" name="unpublishpost" class="btn action-btn btn-danger">Unpublish</button>
                                    <button  data-dismiss="modal" class="btn action-btn btn-grey">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    <section class="members-table published-table">
        <div class="container table1">
            <div class="row">
                <div class="data-table-intro col-md-12 col-sm-12 col-xs-12">Published Notes</div>
                <form class="form-row search-download-part col-md-12 col-sm-12 col-xs-12 text-left">
                    <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <label for="note">Seller</label>
                        <select id="note" class="form-control">
                            <option value="">Select seller</option>
                            <?php
                                $fetch_sellername_query = "SELECT DISTINCT(users.ID) , users.FirstName AS firstname , users.LastName AS lastname FROM seller_notes INNER JOIN users ON users.ID =seller_notes.SellerID WHERE Status = 9";
                                $fetch_sellername = mysqli_query($connection , $fetch_sellername_query);
                                while($row = mysqli_fetch_assoc($fetch_sellername)){
                                    echo "<option value='".$row['firstname']." ".$row['lastname']."'>".$row['firstname']." ".$row['lastname']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12 text-right">
                        <label for="search">&nbsp;</label>
                        <input type="text" class="form-control search-input searchtext" id="search" placeholder="&#x1F50D; Search">
                        <input type="button" value="Search" id="button" class="form-control search1 btn search-download-btn">
                    </div>
                </form>
            </div>
            <div class="row table-data">
                <table class="table table-responsive">
                    <thead>
                        <tr class="table-heading text-center">
                            <th class="psrno" scope="col">SR NO.</th>
                            <th class="pnotetitle" scope="col">NOTE TITLE</th>
                            <th class="pcategory" scope="col">CATEGORY</th>
                            <th class="pselltype" scope="col">SELL TYPE</th>
                            <th class="pprice" scope="col">PRICE</th>
                            <th class="pseller" scope="col">SELLER</th>
                            <th class="peye" scope="col"></th>
                            <th class="ppublisheddate" scope="col">PUBLISHED DATE</th>
                            <th class="papprovedby" scope="col">APPROVED BY</th>
                            <th class="pnumberofdownloads" scope="col">NUMBER OF DOWNLOADS</th>
                            <th class="pdropdown" scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                            $loginid = $_SESSION['ID'];
                            $fetch_published_query = "SELECT seller_notes.ActionedBy AS actionedby , seller_notes.ID AS noteid , seller_notes.SellerID AS seller , seller_notes.Title AS notetitle, note_categories.Name AS notecategory , seller_notes.IsPaid AS selltype , seller_notes.SellingPrice AS price , users.FirstName AS firstname , users.LastName AS lastname , seller_notes.PublishedDate AS publisheddate FROM seller_notes INNER JOIN note_categories ON note_categories.ID = seller_notes.Category INNER JOIN users ON users.ID = seller_notes.SellerID WHERE Status = 9";
                            if(isset($_GET['memberid'])){
                                
                                $memberid = $_GET['memberid'];
                                $fetch_published_query .= " AND seller_notes.SellerID = $memberid";
                                
                            }
                            $published_notes = mysqli_query($connection , $fetch_published_query);
                            $published_note_num = mysqli_num_rows($published_notes);
                            $i=1;
                            
                            while($row = mysqli_fetch_assoc($published_notes)){
                            $actionby = $row['actionedby'];
                            $seller = $row['seller'];
                            $noteid = $row['noteid'];
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td class="purple-color" onclick="window.location.href='adminnotedetail.php?admin=1&noteid=<?php echo $noteid;?>'"><?php echo $row['notetitle']; ?></td>
                            <td><?php echo $row['notecategory']; ?></td>
                            <td><?php if($row['selltype'] == 1){ echo "PAID"; }else{ echo "FREE";} ?></td>
                            <td>₹<?php echo $row['price']; ?></td>
                            <td><?php echo $row['firstname']." ".$row['lastname']; ?></td>
                            <td><img src="images/dashboard/eye.png" onclick="window.location.href='memberdetails.php?admin=1&memberid=<?php echo $seller; ?>'" alt="view"></td>
                            <td><?php echo $row['publisheddate']; ?></td>
                            <td>
                                <?php
                                
                                    $fetch_admin_query = "SELECT * FROM users WHERE ID = $actionby";
                                    $fetch_admin = mysqli_query($connection , $fetch_admin_query);
                                    $admin = mysqli_fetch_assoc($fetch_admin);
                                    echo $admin['FirstName']." ".$admin['LastName'];
                                
                                ?>
                            </td>
                            <td class="purple-color" onclick="window.location.href='downloadednotes.php?admin=1&noteid=<?php echo $noteid;?>'">
                                <?php
                                
                                    $noteid = $row['noteid'];
                                    $fetch_download_note_num = "SELECT DISTINCT(Downloader) FROM downloads WHERE NoteID = $noteid AND downloads.IsSellerHasAllowedDownload = 1 GROUP BY NoteID , Downloader";
                                    $download_note_num = mysqli_query($connection , $fetch_download_note_num);
                                    $download_note_counter = mysqli_num_rows($download_note_num);
                                    echo $download_note_counter;
                                ?>
                            
                            </td>
                            <td class="dropdown">
                                <img class="dropdown-toggle" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="images/mydownloads/dots.png" alt="menu">
                                <div class="dropdown-menu" aria-labelledby="dLabel">
                                    <a class="dropdown-item" href="download.php?noteid=<?php echo $noteid; ?>">Download Notes</a>
                                    <a class="dropdown-item" href="adminnotedetail.php?admin=1&noteid=<?php echo $noteid;?>">View More Details</a>
                                    <a class="dropdown-item" id="publishmodal" data-toggle="modal" data-info="<?php echo $noteid; ?>-<?php echo $row['notetitle']; ?>-<?php echo $row['seller']; ?>" data-target="#publish-modal">Unpublish</a>
                                </div>    
                            </td>
                        </tr>
                        <?php  
                        $i++;
                        };
                        ?>
                    </tbody>
                </table>
                
            </div>
        </div>
    </section>
    
    <?php include 'includes/footernlink.php'; ?>
    
    <script>
    <?php
        if(isset($_SESSION['status']) && $_SESSION['status'] != ''){
            ?>
            
            swal({
              title: "<?php echo $_SESSION['status']; ?>",
//              text: "You clicked the button!",
              icon: "<?php echo $_SESSION['status_code']; ?>",
              button: "okay !",
            });
        <?php
            unset($_SESSION['status_code']);
            unset($_SESSION['status']);
            
        }
        
        ?>
        
    </script>
    
    <script>
        $(document).ready(function() {
            var table = $('table').DataTable({
                'sDom': '"top"i',
                "iDisplayLength": 5,
                language: {
                    paginate: {
                        next: '<img src="images/dashboard/right-arrow.png">',
                        previous: '<img src="images/dashboard/left-arrow.png">'
                    }
                }
                
            });

            $('.search1').click(function() {
                var x = $('.searchtext').val();
                table.search(x).draw();

            });
            
            $('select').change(function(){
                var y = $(this).val();
//                alert(y);
                table.columns(5).search(y).draw();
            });

        });
    </script>
    
    <script>

        $(document).on("click", "#publishmodal", function () {
        var publishid = $(this).data('info');
        var arr = publishid.split("-");
        var notetitle = arr[1];
        $(".modal-body #unpublishpost").val( publishid );
        document.getElementById("rejectmodalheading").innerHTML = notetitle;
        });

    </script>
    

</body>
</html>