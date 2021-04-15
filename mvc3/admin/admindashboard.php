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
?>
<!DOCTYPE html>
<html lang="en">
<head>

	<!-- meta tags -->
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">

	<!-- Title -->
	<title>Notes MarketPlace</title>
	
	<!-- Website Logo -->
    <link rel="shortcut icon" href="images/dashboard/favicon.ico">

	<!-- google fonts -->
	<link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <!-- font awesome css -->
    <link rel="stylesheet" href="css/fontawesome/css/font-awesome.min.css">   
    
    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">

    <!-- custom css -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    
    <!-- responsive css -->
    <link rel="stylesheet" href="css/responsive.css">
    
    <!-- data table css -->
    <style>

        table.dataTable thead th {
            padding: 2px 18px;
            border-bottom: none !important;
        }
        table.dataTable thead td{
            padding: 0px 0px;
            border-bottom: none !important;
        }

        table.dataTable.no-footer {
            border-bottom: 1px solid #dee2e6 !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background: none !important;
            background-color: #6255a5 !important;
            border-radius: 50% !important;
            color: white !important;
            font-family: "open sans", sans-serif;
            font-weight: 400;
            font-size: 16px;
            line-height: 20px;
        }

        .dataTables_wrapper .dataTables_paginate {
            display: table !important;
            width: 100% !important;
            text-align: center;
            margin-top: 10px !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: none;
            background-color: white;
            color: #333 !important;
            border-radius: 50%;
            border: 1px solid white;
            font-family: "open sans", sans-serif;
            font-weight: 400;
            font-size: 16px;
            line-height: 20px;
            outline: none;
        }

        .dataTables_wrapper .dataTables_info {
            display: none;
        }
        
        table.dataTable thead .sorting {
            background-image: none;
        }
    </style>

</head>
<body>
    
    <!--
	<!-- preloader -->
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    
    
    <!-- navigation -->
    <section id="nav-bar">
        <nav class="navbar navbar-expand-lg bottom-box-effect container-fluid">
            <a class="navbar-brand" href="index.html"><img src="images/user-profile/logo.png" alt="logo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"><i class="fa fa-bars" aria-hidden="true"></i></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="admindashboard.php?admin=1">Dashboard</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Notes
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="underreview.php?admin=1">Notes Under Review</a>
                                <a class="dropdown-item" href="publishednotes.php?admin=1">Published Notes</a>
                                <a class="dropdown-item" href="downloadednotes.php?admin=1">Downloaded Notes</a>
                                <a class="dropdown-item" href="rejectednotes.php?admin=1">Rejected Notes</a>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="members.php?admin=1">Members</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Reports
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="spam-reports.php?admin=1">Spam Reports</a>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Settings
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <?php 
                                    $fetch_role_query = "SELECT RoleID FROM users WHERE ID = ".$_SESSION['ID'];
                                    $fetch_role = mysqli_query($connection , $fetch_role_query);
                                    $role = mysqli_fetch_assoc($fetch_role);
                                    $check_role = $role['RoleID'];
                                    if($check_role == 1){
                                        echo '<a class="dropdown-item" href="managesystemconfiguration.php?admin=1">Manage System Configuration</a>
                                <a class="dropdown-item" href="manageadministrator.php?admin=1">Manage Administrator</a>
                                <a class="dropdown-item" href="managecategory.php?admin=1">Manage Category</a>
                                <a class="dropdown-item" href="managetype.php?admin=1">Manage Type</a>
                                <a class="dropdown-item" href="managecountry.php?admin=1">Manage Countries</a>';
                                    }else{
                                        echo '<a class="dropdown-item" href="managecategory.php?admin=1">Manage Category</a>
                                <a class="dropdown-item" href="managetype.php?admin=1">Manage Type</a>
                                <a class="dropdown-item" href="managecountry.php?admin=1">Manage Countries</a>';
                                    }
                                ?>
                                
                            </div>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <?php
                        
                            $fetch_image_path_query = "SELECT ProfilePicture FROM user_profile WHERE UserID = ".$_SESSION['ID'];
                            $fetch_image_path = mysqli_query($connection , $fetch_image_path_query);
                            $fetch_image_num = mysqli_num_rows($fetch_image_path);
                            if($fetch_image_num == 0 ){
                                $pp_file="images/note-details/close.png";
                            }else{
                                $image_path = mysqli_fetch_assoc($fetch_image_path);
                                $pp_file = "../upload/admin/".$_SESSION['ID']."/".$image_path['ProfilePicture'];
                            }
                        
                        ?>
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo $pp_file; ?>" alt="login image">
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="adminprofile.php?admin=1">Update Profile</a>
                                <a class="dropdown-item" href="change-admin.php?admin=1">Change Password</a>
                                <a class="dropdown-item dropdown-purple" href="logout.php">Logout</a>
                            </div>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="logout.php"><button type="button" class="btn btn-primary btn_login">Logout</button></a>
                    </li>
                </ul>
            </div>
        </nav>
    </section>
    
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
                                
                                    $fetch_download_note_num = "SELECT * FROM downloads WHERE NoteID = $noteid AND IsSellerHasAllowedDownload = 1  GROUP BY NoteID,Downloader";
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
    
    <!-- footer -->
    <section class="footer footer-admin">
        <div class="container-fluid">
            <hr>
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-6 text-right"><p>Version : 1.1.24</p></div>
                <div class="col-md-4 col-sm-4 col-xs-6"></div>
                <div class="col-md-4 col-sm-4 col-xs-6 text-right"><p>Copyright &#169; Tatvasoft All right reserved.</p></div>
            </div>
        </div>
    </section>
	<!-- footer ends -->
	
	<!-- jquery-->
    <script src="js/jquery.min.js"></script>

    <!-- bootstrap js -->
    <script src="js/bootstrap/popper.min.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <script src="//cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
    <script src="js/sweetalert/sweetalert.min.js"></script>

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
   
    <!-- custom js -->
    <script src="js/script.js"></script>
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
//                ,
//                columnDefs:[{
//                    targets:[],
//                    orderable:false
//                }]
            });

            $('.search1').click(function() {
                var x = $('#searchtext1').val();
                table1.search(x).draw();

            });
            
//            $('#dashboard-month-filter').change(function(){
//                var y = $(this).val();
//                loadPublishedNotesByMonth($(this).val());
//                alert($(this).val());
//            });
//
//            function loadPublishedNotesByMonth(month) {
////                let currentYear = new Date().getFullYear();
//                let monthVal = month;
////                alert(monthVal);
//                
//                table1.columns(7).search(monthVal).draw();
//            }
//
//            var currentMonth = $('#dashboard-month-filter').val();
//            loadPublishedNotesByMonth(currentMonth);
            
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