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
    if($_SESSION['ROLE'] != 3){
        header("location:../admin/admindashboard.php?admin=1");
    }
    if(isset($_SESSION['reqacc']) and $_SESSION['reqacc'] == 'yes'){
        $_SESSION['status'] = "your request has been accepted visit mydownload page to download note!!";
        $_SESSION['status_code'] = "info";
        unset($_SESSION['reqacc']);
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
    <link rel="stylesheet" type="text/css" href="css/responsive.css">
    
    <!-- data table css -->
    <style>

        table.dataTable thead th,
        table.dataTable thead td {
            padding: 10px 18px;
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
        <nav class="navbar1 navbar-expand-lg">
            <a class="navbar-brand" href="index.php"><img src="images/user-profile/logo.png" alt="logo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"><i class="fa fa-bars" aria-hidden="true"></i></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="searchnotes.php">Search Notes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="userdashboard.php">Sell Your Notes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="buyerrequest.php">Buyer Requests</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="faq.php">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contactus.php">Contact Us</a>
                    </li>
                    <li class="nav-item dropdown">
                        <?php
                        $fetch_image_path_query = "SELECT ProfilePicture FROM user_profile WHERE UserID = ".$_SESSION['ID'];
                        $fetch_image_path = mysqli_query($connection , $fetch_image_path_query);
                        $image_path = mysqli_fetch_assoc($fetch_image_path);
                        if(!empty($image_path['ProfilePicture'])){
                            $pp_file = $image_path['ProfilePicture'];
                        }else{
                            $pp_file = "images/default/profile/dp.jpg";
                        }
                        
                        ?>
                        <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="<?php echo $pp_file; ?>" alt="login image">
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="userprofile.php">My Profile</a>
                                <a class="dropdown-item" href="mydownloads.php">My Downloads</a>
                                <a class="dropdown-item" href="mysoldnotes.php">My Sold Notes</a>
                                <a class="dropdown-item" href="myrejectednotes.php">My Rejected Notes</a>
                                <a class="dropdown-item" href="changepw.php">Change Password</a>
                                <a class="dropdown-item purple" href="logout.php">LOGOUT</a>
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
   
    <section class="download-table">
        <div class="container table1">
            <div class="row">
                <div class="download-table-intro col-md-6">My Downloads</div>
                <div class="search-part col-md-6 text-right">
                    <input type="text" id="searchtext1" placeholder="&#x1F50D; Search">
                    <button type="button" class="btn search1 search-btn">Search</button> 
                </div>
            </div>
            <div class="row table-data table-responsive">
                <table class="table table-responsive">
                    <thead>
                        <tr class="table-heading text-center">
                            <th class="srno" scope="col">SR NO.</th>
                            <th class="notetitle" scope="col">NOTE TITLE</th>
                            <th class="downloadcategory" scope="col">CATEGORY</th>
                            <th class="buyer" scope="col">BUYER</th>
                            <th class="downloadselltype" scope="col">SELL TYPE</th>
                            <th class="downloadprice" scope="col">PRICE</th>
                            <th class="date-time" scope="col">DOWNLOAD DATE/TIME</th>
                            <th class="downloadeye" scope="col"></th>
                            <th class="downloadmenu" scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    
                    $loginid = $_SESSION['ID'];
                    $fetch_progress_query = "SELECT downloads.NoteID AS noteid,downloads.Seller AS seller,downloads.ID AS download_id,downloads.NoteTitle AS note_title, downloads.NoteCategory AS note_category, users.EmailID AS buyer_id , downloads.IsPaid AS sell_type , downloads.PurchasedPrice AS price , downloads.AttachmentDownloadedDate AS download_date FROM downloads INNER JOIN users ON downloads.Downloader = users.ID WHERE IsSellerHasAllowedDownload = 1 AND Seller != $loginid AND Downloader = $loginid GROUP BY downloads.NoteID,downloads.Downloader ORDER BY AttachmentDownloadedDate DESC";
                    $progress_notes = mysqli_query($connection,$fetch_progress_query);
                    $i=1;
                   
                    while ($progress_row = mysqli_fetch_array($progress_notes)) { 
                        
                    ?>
                       
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td class="purple-color" onclick="window.location.href='notedetails.php?noteid=<?php echo $progress_row["noteid"]; ?>'"><?php echo $progress_row["note_title"]; ?></td>
                            <td><?php echo $progress_row["note_category"]; ?></td>
                            <td><?php echo $progress_row["buyer_id"]; ?></td>
                            <td><?php if($progress_row["sell_type"] == 1){ echo "Paid"; }else{ echo "Free"; } ?></td>
                            <td><?php echo $progress_row["price"]; ?></td>
                            <td class="<?php if(empty($progress_row["download_date"])){ echo "text-center";}?>"><?php if(empty($progress_row["download_date"])){ echo "-" ; }else { echo $progress_row["download_date"];} ?></td>
                            <td>
                            <a href="notedetails.php?noteid=<?php echo $progress_row['noteid']; ?>"><img src="images/dashboard/eye.png" alt="view"></a></td>
                            <td class="dropdown">
                                <img class="dropdown-toggle" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="images/mydownloads/dots.png" alt="menu">
                                <div class="dropdown-menu" aria-labelledby="dLabel">
                                    
                                    <a class="dropdown-item" href="download.php?noteid=<?php echo $progress_row['noteid'];?>&downloadentry=1">Download Note</a>
                                    <a class="dropdown-item noteidpass" data-id="<?php echo $progress_row["noteid"]; ?>-<?php echo $loginid; ?>-<?php echo $progress_row["download_id"]; ?>" data-toggle="modal" data-target="#feedback-modal">Add Reviews/Feedback</a>
                                    <a class="dropdown-item reportidpass" href="#" data-info="<?php echo $progress_row["noteid"]; ?>-<?php echo $progress_row["note_title"]; ?>-<?php echo $progress_row["download_id"]; ?>-<?php echo $progress_row["seller"]; ?>" data-toggle="modal" data-target="#reject-modal">Report as inappropriate</a>
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
    
    <?php
    
        if(isset($_POST['reviewpost'])){
            
            $rate = $_POST['rate'];
            $comment = mysqli_real_escape_string($connection,$_POST['comment']);
            $reviewnoteid = $_POST['reviewpost'];
            $reviewnoteidArray = explode("-",$reviewnoteid);
            $noteid = $reviewnoteidArray[0];
            $reviewedid = $reviewnoteidArray[1];
            $downloadid = $reviewnoteidArray[2];
            $reviewcreater = $_SESSION['ID'];

            $insert_review_query = "INSERT INTO seller_notes_reviews( NoteID , ReviewedByID , AgainstDownloadsID , Ratings, Comments, CreatedBy, IsActive) VALUES ($noteid,$reviewedid,$downloadid,$rate,'$comment',$reviewcreater, 1 )";
            $insert_review = mysqli_query($connection,$insert_review_query);
            
            if($insert_review){
                $_SESSION['status'] = "review added !!";
                $_SESSION['status_code'] = "success";
                
            }
            else{
                $_SESSION['status'] = "review isn't added !!";
                $_SESSION['status_code'] = "error";
            }
            
            
        }
    
    ?>
    
    <!-- Modal -->
<div class="modal fade review-modal" id="feedback-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-head col-md-12">
                    <div class="modal-heading col-md-6">Add Review</div>
                  <div class="modal-close col-md-6">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                </div>
                <div class="modal-body">
                    <div class="container">
                        <form action="mydownloads.php" method="post">
                            <div class="row">
                                <div class="rate">
                                    <input type="radio" id="star5" name="rate" value="5" required/>
                                    <label for="star5" title="5">5 stars</label>
                                    <input type="radio" id="star4" name="rate" value="4" />
                                    <label for="star4" title="4">4 stars</label>
                                    <input type="radio" id="star3" name="rate" value="3" />
                                    <label for="star3" title="3">3 stars</label>
                                    <input type="radio" id="star2" name="rate" value="2" />
                                    <label for="star2" title="2">2 stars</label>
                                    <input type="radio" id="star1" name="rate" value="1" />
                                    <label for="star1" title="1">1 star</label>
                                </div>
                            </div>
                            <div class="comment-box">
                                <label for="exampleInputfname">Comments &#42;</label>
                                <textarea class="form-control" name="comment" id="exampleInputfname" placeholder="Comments..." rows="5" required></textarea>
                            </div>
                            <div class="submit-button">
                                <button type="submit" id="reviewpost" name="reviewpost" class="btn btn-primary submit-btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
      </div>
</div>
    
    <?php
    
        if(isset($_POST['reportpost'])){
            
            $remark = $_POST['remark'];
            $reportpost = $_POST['reportpost'];
            $reportpostArray = explode("-",$reportpost);
            $noteid = $reportpostArray[0];
            $note_title = $reportpostArray[1];
            $downloadid = $reportpostArray[2];
            $sellerid = $reportpostArray[3];
            $loginid = $_SESSION['ID'];
            $member_name = $_SESSION['FNAME']." ".$_SESSION['LNAME'];
            
            $get_seller = mysqli_query($connection,"SELECT FirstName,LastName FROM users WHERE ID = $sellerid");
            $seller_name = mysqli_fetch_assoc($get_seller);
            $seller = $seller_name['FirstName']." ".$seller_name['LastName'];
            
            $insert_report_query = "INSERT INTO seller_notes_reported_issues( NoteID , ReportedBYID , AgainstDownloadID , Remarks, CreatedBy) VALUES ($noteid,$loginid,$downloadid,'$remark',$loginid)";
            $insert_report = mysqli_query($connection,$insert_report_query);
            
            if($insert_report){
                $_SESSION['status'] = "report submitted !!";
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

                        $mail->addAddress('parthmistry7227843533@gmail.com','note market place');
                        $mail->addReplyTo($config_email, 'Parth Mistry');

                        $mail->IsHTML(true);
                        $mail->Subject = "$member_name Reported an issue for $note_title";
                        $mail->Body = "Hello Admins,<br><br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;We want to inform you that, $member_name Reported an issue for $seller’s Note with title $note_title. Please look at the notes and take required actions.<br><br>Regards,<br>Notes Marketplace";
                        $mail->AltBody = ' ';

                        $mail->send();
                        
                    } catch (Exception $e) {
                        echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
                    }
                
                
            }
            else{
                $_SESSION['status'] = "report isn't submitted !!";
                $_SESSION['status_code'] = "error";
            }
            
            
        }
    
    ?>
    
    
    
    <!-- Modal -->
    <div class="modal fade" id="reject-modal" tabindex="-1" role="dialog" aria-labelledby="downloadmodaltitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-close-button">    
<!--                        <input type="image" id="image" alt="popup" class="close" data-dismiss="modal" aria-label="Close" src="images/note-details/close.png">-->
                    </div> 
                    <div class="container modal-reject-form">
                        <form action="mydownloads.php" method="post" class="row col-md-12 reject-form">
                            <div class="form-row reject-form-heading">
                                <h5 id="h5" class="col-md-12 reject-form-internal"></h5>
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
                                    <button type="submit" name="reportpost" id="reportpost" class="btn action-btn btn-danger">Report an issue</button>
                                    <button class="btn action-btn btn-grey" data-dismiss="modal" aria-label="Close">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    
    
    <!-- footer -->
    <section class="footer">
        <div class="container-fluid">
            <hr>
            <div class="row">
                <div class="col-md-6 footer_content">
                    <p>Copyright © <a href="https://www.tatvasoft.com/">TatvaSoft</a> All Rights Reserved.</p>
                </div>
                <div class="col-md-6 footer_social text-right">
                    <ul class="social-list">
                        <li>
                            <?php
                                
                                $fetch_furl = mysqli_query($connection,"SELECT Value FROM system_configurations WHERE ID = 6");
                                $furl = mysqli_fetch_assoc($fetch_furl);
                            
                            ?>
                            <a href="<?php echo $furl['Value']; ?>">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>
                        <li>
                            <?php
                            
                                $fetch_turl = mysqli_query($connection,"SELECT Value FROM system_configurations WHERE ID = 7");
                                $turl = mysqli_fetch_assoc($fetch_turl);
                            
                            ?>
                            <a href="<?php echo $turl['Value']; ?>">
                                <i class="fa fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <?php
                           
                                $fetch_lurl = mysqli_query($connection,"SELECT Value FROM system_configurations WHERE ID = 8");
                                $lurl = mysqli_fetch_assoc($fetch_lurl);     
                           
                            ?>
                            <a href="<?php echo $lurl['Value']; ?>">
                                <i class="fa fa-google-plus"></i>
                            </a>
                        </li>
                    </ul>
                </div>
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
            var table = $('table').DataTable({
                'sDom': '"top"i',
                "iDisplayLength": 10,
                language: {
                    paginate: {
                        next: '<img src="images/dashboard/right-arrow.png">',
                        previous: '<img src="images/dashboard/left-arrow.png">'
                    }
                }
            });

            $('.search1').click(function() {
                var x = $('#searchtext1').val();
                table.search(x).draw();

            });

        });
    </script>
    <script>

        $(document).on("click", ".noteidpass", function () {
        var myBookId = $(this).data('id');
        $(".modal-body #reviewpost").val( myBookId );
        });

    </script>
    
    <script>

        $(document).on("click", ".reportidpass", function () {
        var reportid = $(this).data('info');
        var arr = reportid.split("-");
        var notetitle = arr[1];
        $(".modal-body #reportpost").val( reportid );
        document.getElementById("h5").innerHTML = notetitle;
        });

    </script>
    

</body>
</html>

