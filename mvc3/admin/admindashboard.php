<?php ob_start(); ?>
<?php include 'includes/db.php'; ?>
<?php  

    session_start();
    if($_GET['admin'] != 1){
        header("location:../front/login.php");
    }
    if(!isset($_SESSION['ID'])){
        header("location:../front/login.php");
    }
    if(isset($_SESSION['adminunpublish']) and $_SESSION['adminunpublish'] == 'yes'){
        $_SESSION['status'] = "note Unpublished !!";
        $_SESSION['status_code'] = "success";
        unset($_SESSION['adminunpublish']);
    }
    if(isset($_SESSION['adminunpublish']) and $_SESSION['adminunpublish'] == 'no'){
        $_SESSION['status'] = "note isn't Unpublished !!";
        $_SESSION['status_code'] = "error";
        unset($_SESSION['adminunpublish']);
    }
    if(isset($_SESSION['approve-note']) and $_SESSION['approve-note'] == 'yes'){
        $_SESSION['status'] = "note published !!";
        $_SESSION['status_code'] = "success";
        unset($_SESSION['approve-note']);
    }
    if(isset($_SESSION['approve-note']) and $_SESSION['approve-note'] == 'no'){
        $_SESSION['status'] = "note isn't published !!";
        $_SESSION['status_code'] = "error";
        unset($_SESSION['approve-note']);
    }
    $Page = 'dashboard';
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
                        $mail->Subject = "Sorry! We need to remove your notes from our portal.";
                        $mail->Body = "Hello ".$seller_firstname." ".$seller_lastname.", <br><br>We want to inform you that, your note $notetitle has been removed from the portal.Please find our remarks as below -<br>$comment<br><br>Regards,<br>Notes Marketplace";
                        $mail->AltBody = 'see your note unpublished on portal';

                        $mail->send();
                    } catch (Exception $e) {
                        echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
                    }
                
                $_SESSION['status'] = "note unpublished !!";
                $_SESSION['status_code'] = "success";
            }
            else{
                $_SESSION['status'] = "note isn't unpublished !!";
                $_SESSION['status_code'] = "error";
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

    <section class="dashboard-counter">
       <div class="container">
            <div class="row dashboard-intro">
                <div class="dashboard-heading col-md-12 col-sm-12">Dashboard</div>
                
            </div>
            <div class="row counter">
                <div class="col-md-4 col-sm-4 col-xs-12 counter1">
                    <div class="review-box text-center">
                        <?php
                        
                            $inreview_counter_query = "SELECT * FROM seller_notes WHERE Status IN (7,8) AND IsActive = 1";
                            $inreview_counter = mysqli_query($connection , $inreview_counter_query);
                            $inreview_number = mysqli_num_rows($inreview_counter);
                        
                        ?>
                        <span class="heading" onclick="window.location.href='underreview.php?admin=1'"><?php echo $inreview_number; ?></span><br>
                        <span class="sub-heading">Numbers of Notes in Review for Publish</span>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 counter2">
                    <div class="notes-box text-center">
                        <?php
                        
                            $downloaded_counter_query = "SELECT * FROM downloads WHERE AttachmentDownloadedDate > (NOW() - INTERVAL 7 DAY)";
                            $downloaded_counter = mysqli_query($connection , $downloaded_counter_query);
                            $downloaded_number = mysqli_num_rows($downloaded_counter); 
                        
                        ?>
                        <span class="heading" onclick="window.location.href='downloadednotes.php?admin=1'"><?php echo $downloaded_number; ?></span><br>
                        <span class="sub-heading">Numbers of New Notes Downloaded<br>(Last 7 days)</span>
                    </div>
                </div>
                <div class="col-md-4 col-sm-4 col-xs-12 counter3">
                    <div class="registration-box text-center">
                        <?php
                        
                            $registration_counter_query = "SELECT * FROM users WHERE CreatedDate > (NOW() - INTERVAL 7 DAY) AND IsEmailVerified = 1 AND IsActive =1";
                            $registration_counter = mysqli_query($connection , $registration_counter_query);
                            $registration_number = mysqli_num_rows($registration_counter);
                        
                        ?>
                        <span class="heading" onclick="window.location.href='members.php?admin=1'"><?php echo $registration_number; ?></span><br>
                        <span class="sub-heading">Numbers of New Registration (Last 7 days)</span>
                    </div>
                </div>
            </div>
        </div>
    </section>
   
    <section class="data-table">
        <div class="container table1">
            <div class="row">
                <div class="data-table-intro col-md-12 col-sm-12">Published Notes</div>
                <div class="search-part col-md-12 col-sm-12 col-xs-12 text-right">
                    <div class="form-group">
                        <input type="text" id="searchtext1" placeholder="&#x1F50D; Search">
                        <button type="button" class="btn search1 search-btn">Search</button>
                        <select id="dashboard-month-filter" class="month-filter">
                            <?php                                    
                                    $currentMonthName = date('F');
                                    // $currentMonthValue = date('n');
                                    for ($i = 0; $i < 6; $i++) {
                                        $MonthName = date("F", strtotime(date('Y-m-01')." -$i months"));
                                        $MonthValue = date("-m-Y", strtotime(date('Y-m-01')." -$i months"));
                                        if ($MonthName == $currentMonthName) {
                                            echo "<option value='{$MonthValue}' selected>{$MonthName}</option>";
                                        } else {
                                            echo "<option value='{$MonthValue}'>{$MonthName}</option>";
                                        }                                                                                                                  
                                    }
                                    ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row table-data">
                <table class="table table-responsive">
                    <thead>
                        <tr class="table-heading text-center">
                            <th class="srno" scope="col">SR NO.</th>
                            <th class="title" scope="col">TITLE</th>
                            <th class="category" scope="col">CATEGORY</th>
                            <th class="attachmentsize" scope="col">ATTACHMENT SIZE</th>
                            <th class="selltype" scope="col">SELL TYPE</th>
                            <th class="price" scope="col">PRICE</th>
                            <th class="publisher" scope="col">PUBLISHER</th>
                            <th class="publisheddate" scope="col">PUBLISHED DATE</th>
                            <th class="downloads" scope="col">NUMBER OF DOWNLOADS</th>
                            <th class="dropdown" scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php  
                    
                    $loginid = $_SESSION['ID'];
                    $fetch_published_query = "SELECT seller_notes.ID AS noteid , seller_notes.SellerID AS seller , seller_notes.Title AS notetitle, note_categories.Name AS notecategory , seller_notes.IsPaid AS selltype , seller_notes.SellingPrice AS price , users.FirstName AS firstname , users.LastName AS lastname , seller_notes.PublishedDate AS publisheddate FROM seller_notes INNER JOIN note_categories ON note_categories.ID = seller_notes.Category INNER JOIN users ON users.ID =seller_notes.SellerID WHERE Status = 9";
                    $published_notes = mysqli_query($connection,$fetch_published_query);
                    $i=1;
                   
                    while ($progress_row = mysqli_fetch_array($published_notes)) {  
                    $noteid = $progress_row['noteid'];
                    ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td class="purple-color" onclick="window.location.href='adminnotedetail.php?admin=1&noteid=<?php echo $noteid;?>'"><?php echo $progress_row['notetitle']; ?></td>
                            <td><?php echo $progress_row['notecategory']; ?></td>
                            <td><?php   
                                    
                                    $noteid = $progress_row['noteid'];
                                    $fetch_size_query = "SELECT FilePath FROM seller_notes_attachements WHERE NoteID = $noteid";
                                    $fetch_size = mysqli_query($connection , $fetch_size_query);
                                    $fetch_size_num = mysqli_num_rows($fetch_size);
                                    $attachment_size = 0;
                                    while ($fetch_size_row = mysqli_fetch_array($fetch_size)) {
                                    
                                        $file = $fetch_size_row['FilePath'];
                                        $filesize = filesize($file); // bytes
                                        $attachment_size = $attachment_size + round($filesize / 1024 / 1024, 1);
                                    
                                    }
                                    if($fetch_size_num == 0){
                                        echo "no";
                                    }else{
                                        echo $attachment_size." MB";
                                    }
                                    
                                ?>
                            </td>
                            <td><?php if($progress_row['selltype'] == 1){ echo "PAID"; }else{ echo "FREE";} ?></td>
                            <td>₹<?php echo $progress_row['price']; ?></td>
                            <td><?php echo $progress_row['firstname']." ".$progress_row['lastname']; ?></td>
                            <td><?php echo date("d-m-Y, h:i", strtotime($progress_row['publisheddate'])); ?></td>
                            <td class="purple-color" onclick="window.location.href='downloadednotes.php?admin=1&noteid=<?php echo $noteid;?>'"><?php
                                
                                    $fetch_download_note_num = "SELECT DISTINCT(Downloader) FROM downloads WHERE NoteID = $noteid AND downloads.IsSellerHasAllowedDownload = 1 GROUP BY NoteID , Downloader";
                                    $download_note_num = mysqli_query($connection , $fetch_download_note_num);
                                    $download_note_counter = mysqli_num_rows($download_note_num);
                                    echo $download_note_counter;
                                ?>
                            </td>
                            <td class="dropdown">
                                <img class="dropdown-toggle" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="images/mydownloads/dots.png" alt="menu">
                                <div class="dropdown-menu" aria-labelledby=" dLabel">
                                    <a class="dropdown-item" href="download.php?noteid=<?php echo $noteid; ?>">Download Notes</a>
                                    <a class="dropdown-item" href="adminnotedetail.php?admin=1&noteid=<?php echo $noteid;?>">View More Details</a>
                                    <a class="dropdown-item" id="publishmodal" data-toggle="modal" data-info="<?php echo $noteid; ?>-<?php echo $progress_row['notetitle']; ?>-<?php echo $progress_row['seller']; ?>" data-target="#publish-modal">Unpublish</a>
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
            var table1 = $('table').DataTable({
                'sDom': '"top"i',
                'bInfo': true,
                "iDisplayLength": 5,
                language: {
                    paginate: {
                        next: '<img src="images/dashboard/right-arrow.png">',
                        previous: '<img src="images/dashboard/left-arrow.png">'
                    }
                }
            });

            $('.search1').click(function() {
                var x = $('#searchtext1').val();
                table1.search(x).draw();

            });
            
            
            $(document).on('change', '#dashboard-month-filter', function () {
            loadPublishedNotesByMonth($(this).val());
            });

            function loadPublishedNotesByMonth(month) {
                let monthVal = month;
                table1.column(7).search(monthVal).draw();
            }

            var currentMonth = $('#dashboard-month-filter').val();
            loadPublishedNotesByMonth(currentMonth);

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