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
    if(isset($_SESSION['toinreview-note']) and $_SESSION['toinreview-note'] == 'yes'){
        $_SESSION['status'] = "note is added to inreview !!";
        $_SESSION['status_code'] = "success";
        unset($_SESSION['toinreview-note']);
    }
    if(isset($_SESSION['toinreview-note']) and $_SESSION['toinreview-note'] == 'no'){
        $_SESSION['status'] = "note is not added to inreview !!";
        $_SESSION['status_code'] = "error";
        unset($_SESSION['toinreview-note']);
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

        table.dataTable thead th{
            padding: 10px 18px;
            border-bottom: none !important;
        }
        table.dataTable thead td{
/*            padding: 0px !important;*/
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
        
/*
        table.dataTable tbody td#action-button{
            padding: 0px !important;
        }
*/
        table{
            width: 99% !important;
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
    
        if(isset($_POST['rejectpost'])){
            
            
            $comment = mysqli_real_escape_string($connection,$_POST['remark']);
            $rejectnoteid = mysqli_real_escape_string($connection,$_POST['rejectpost']);
            $rejectnoteidArray = explode("-",$rejectnoteid);
            $noteid = $rejectnoteidArray[0];
            $notetitle = $rejectnoteidArray[1];
            $notecategory = $rejectnoteidArray[2];
            $loginid = $_SESSION['ID'];

            $update_to_reject_query = "UPDATE seller_notes SET Status = 10 , ActionedBy = $loginid , AdminRemarks = '$comment' , ModifiedDate = NOW() , ModifiedBy = $loginid WHERE ID = $noteid";
            $update_to_reject = mysqli_query($connection,$update_to_reject_query);
            
            if($update_to_reject){
                $_SESSION['status'] = "note is added to rejected notes !!";
                $_SESSION['status_code'] = "success";
            }
            else{
                $_SESSION['status'] = "note isn't added to rejected notes !!";
                $_SESSION['status_code'] = "error";
            }
            
            
        }
    
    
    ?>
    
    <!-- Modal -->
    <div class="modal fade" id="reject-modal" tabindex="-1" role="dialog" aria-labelledby="downloadmodaltitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="container modal-reject-form">
                        <form action="underreview.php?admin=1" onsubmit="return confirm('Are you sure you want to reject seller request?');" method="post" class="row col-md-12 reject-form">
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
                                    <button type="submit" id="rejectpost" name="rejectpost" class="btn action-btn btn-danger">Reject</button>
                                    <button  data-dismiss="modal" class="btn action-btn btn-grey">Cancel</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
   
    <section class="members-table ureview-table">
        <div class="container table1">
            <div class="row">
                <div class="data-table-intro col-md-12 col-sm-12 col-xs-12">Notes Under Review</div>
                <div class="form-row search-download-part col-md-12 col-sm-12 col-xs-12 text-left">
                    <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <label for="note">Seller</label>
                        <select id="note" class="form-control">
                            <option value="">Select seller</option>
                            <?php
                            
                                $fetch_sellername_query = "SELECT  DISTINCT( users.ID ) , users.FirstName AS firstname, users.LastName AS lastname  FROM seller_notes INNER JOIN users on users.ID = seller_notes.SellerID WHERE seller_notes.Status IN (7 , 8)";
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
                        <input type="button" value="Search" id="button" class="form-control btn search-download-btn search1">
                    </div>
                </div>
            </div>
            <div class="row table-responsive table-data">
                <table class="table table-responsive">
                    <thead>
                        <tr class="table-heading text-center">
                            <th class="usrno" scope="col">SR NO.</th>
                            <th class="unotetitle" scope="col">NOTE TITLE</th>
                            <th class="ucategory" scope="col">CATEGORY</th>
                            <th class="useller" scope="col">SELLER</th>
                            <th class="ueye" scope="col"></th>
                            <th class="udateadded" scope="col">DATE ADDED</th>
                            <th class="ustatus" scope="col">STATUS</th>
                            <th class="uaction" scope="col">ACTION</th>
                            <th class="udropdown" scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  
                        
                            $loginid = $_SESSION['ID'];
                            $fetch_underreview_query = "SELECT seller_notes.SellerID AS seller , seller_notes.ID AS noteid, seller_notes.Title AS notetitle, note_categories.Name AS categoryname, users.FirstName AS firstname, users.LastName AS lastname, seller_notes.CreatedDate AS dateadded, reference_data.Value AS status FROM seller_notes INNER JOIN note_categories ON note_categories.ID = seller_notes.Category INNER JOIN users on users.ID = seller_notes.SellerID  INNER JOIN reference_data ON reference_data.ID = seller_notes.Status WHERE seller_notes.Status IN (7 , 8)";
                            if(isset($_GET['memberid'])){
                                
                                $memberid = $_GET['memberid'];
                                $fetch_underreview_query .= " AND seller_notes.SellerID = $memberid";
                                
                            }
                            $underreview_notes = mysqli_query($connection , $fetch_underreview_query);
                            $i=1;
                            
                            while($row = mysqli_fetch_assoc($underreview_notes)){
                            $noteid = $row['noteid'];
                            $seller = $row['seller'];
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td class="purple-color" onclick="window.location.href='adminnotedetail.php?admin=1&noteid=<?php echo $noteid;?>'"><?php echo $row['notetitle']; ?></td>
                            <td><?php echo $row['categoryname']; ?></td>
                            <td><?php echo $row['firstname']." ".$row['lastname']; ?></td>
                            <td><img src="images/dashboard/eye.png" onclick="window.location.href='memberdetails.php?admin=1&memberid=<?php echo $seller; ?>'" alt="view"></td>
                            <td><?php echo $row['dateadded']; ?></td>
                            <td><?php echo $row['status']; ?></td>
                            <td id="action-button">
                                <button onclick="approvenote('<?php echo $row['noteid']; ?>')" class="btn action-btn btn-success">Approve</button>
                                <button class="btn action-btn btn-danger" id="rejectmodal" data-toggle="modal" data-info="<?php echo $row['noteid']; ?>-<?php echo $row['notetitle']; ?>-<?php echo $row['categoryname']; ?>" data-target="#reject-modal">Reject</button>
                                <button onclick="toinreview('<?php echo $row['noteid']; ?>')" class="btn action-btn btn-grey">InReview</button>
                            </td>
                            <td class="dropdown">
                                <img class="dropdown-toggle" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="images/mydownloads/dots.png" alt="menu">
                                <div class="dropdown-menu" aria-labelledby="dLabel">
                                    <a class="dropdown-item" href="download.php?noteid=<?php echo $row['noteid']; ?>">Download Notes</a>
                                    <a class="dropdown-item" href="adminnotedetail.php?admin=1&noteid=<?php echo $noteid;?>">View More Details</a>
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
                <div class="col-md-4 text-right"><p>Version : 1.1.24</p></div>
                <div class="col-md-4"></div>
                <div class="col-md-4 text-right"><p>Copyright &#169; Tatvasoft All right reserved.</p></div>
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
                table.columns(3).search(y).draw();
            });
            
            
//             $("#dashboard-month-filter").change(function(){
//                loadPublishedNotesByMonth($(this).val());
////                alert($(this).val());
//            });
//
//            function loadPublishedNotesByMonth(month) {
//                let currentYear = new Date().getFullYear();
//                let monthVal = '-' + month + '-' + currentYear;
////                alert(monthVal);
//                
//                table.column(7).search(monthVal).draw();
//            }
//
//            var currentMonth = $('#dashboard-month-filter').val();
//            loadPublishedNotesByMonth(currentMonth);

        });
    </script>
    <script>
    
        function approvenote(noteid){
            var approvecheck = confirm("If you approve the notes – System will publish the notes over portal. Please press yes to continue.");
            if(approvecheck == true){
                location.replace("approvenote.php?noteid="+noteid);
            }else{
                
            }
        }
    
    </script>
    <script>
    
        function toinreview(noteid){
            var toinreviewcheck = confirm("Via marking the note In Review – System will let user know that review process has been initiated. Please press yes to continue.");
            if(toinreviewcheck == true){
                location.replace("toinreviewnote.php?noteid="+noteid);
            }else{
                
            }
        }
    
    </script>

    <script>

        $(document).on("click", "#rejectmodal", function () {
        var reportid = $(this).data('info');
        var arr = reportid.split("-");
        var notetitle = arr[1]+" - "+arr[2];
        $(".modal-body #rejectpost").val( reportid );
        document.getElementById("rejectmodalheading").innerHTML = notetitle;
        });

    </script>
    
    
    
</body>
</html>