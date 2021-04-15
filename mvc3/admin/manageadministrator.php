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
    if($_SESSION['ROLE'] != 1){
        header("location:admindashboard.php?admin=1");
    }
    if(isset($_SESSION['admintdel']) and $_SESSION['admintdel'] == 'yes'){
        $_SESSION['status'] = "admin Inactivated !!";
        $_SESSION['status_code'] = "success";
        unset($_SESSION['admintdel']);
    }
    if(isset($_SESSION['admintdel']) and $_SESSION['admintdel'] == 'no'){
        $_SESSION['status'] = "admin isn't Inactivated !!";
        $_SESSION['status_code'] = "error";
        unset($_SESSION['admintdel']);
    }
    if(isset($_SESSION['adminadd']) and $_SESSION['adminadd'] == 'yes'){
        $_SESSION['status'] = "admin Added !!";
        $_SESSION['status_code'] = "success";
        unset($_SESSION['adminadd']);
    }
    if(isset($_SESSION['adminadd']) and $_SESSION['adminadd'] == 'no'){
        $_SESSION['status'] = "admin isn't Added !!";
        $_SESSION['status_code'] = "error";
        unset($_SESSION['adminadd']);
    }
    if(isset($_SESSION['adminedit']) and $_SESSION['adminedit'] == 'yes'){
        $_SESSION['status'] = "admin Updated !!";
        $_SESSION['status_code'] = "success";
        unset($_SESSION['adminedit']);
    }
    if(isset($_SESSION['adminedit']) and $_SESSION['adminedit'] == 'no'){
        $_SESSION['status'] = "admin isn't Updated !!";
        $_SESSION['status_code'] = "error";
        unset($_SESSION['adminedit']);
    }
?>
<?php

    if(isset($_GET['inactiveid'])){
        
        $inactive_Admin_id = $_GET['inactiveid'];
        $inactive_admin_query = "UPDATE users SET IsActive = 0 , ModifiedDate = NOW() , ModifiedBy = ".$_SESSION['ID']." WHERE ID = $inactive_Admin_id";
        $inactive_admin = mysqli_query($connection , $inactive_admin_query);
        if($inactive_admin){
            $_SESSION['admintdel'] = "yes";
            header("location:manageadministrator.php?admin=1");
        }else{
            $_SESSION['admintdel'] = "no";
            header("location:manageadministrator.php?admin=1");
        }
        
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
    <link rel="stylesheet" type="text/css" href="css/style1.css">
    <link rel="stylesheet" href="css/style.css">

    <!-- responsive css -->
    <link rel="stylesheet" href="css/responsive1.css">
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

        <div class="content-box-lg content-box-lg-manage">

            <div class="container">
                <div class="row no-gutters margin-upper">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-left box-heading-wrapper">
                        <p class="box-heading">Manage Administrator</p>
                    </div>

                    <div class="col-lg-5 col-md-5 col-sm-5 col-12">
                        <button onclick="window.location.href='addadministrator.php?admin=1'" class="btn btn-general btn-purple add-administrator-btn">Add Administrator</button>
                    </div>

                    <div class="col-lg-7 col-md-7 col-sm-7 col-12">

                        <div class="row no-gutters general-search-bar-btn-wrapper">
                            <div class="form-group has-search-bar">
                                <span class="search-symbol"><img src="images/dashboard/search-icon.svg" alt=""></span>
                                <input type="text" class="form-control input-box-style search-notes-bar searchtext" placeholder="Search">
                            </div>
    
                            <button class="btn btn-general search1 btn-purple general-search-bar-btn">Search</button>
                        </div>

                    </div>
                </div>
            </div>    
            
            <div class="container">

                <div class="manage-administrator-table general-table-responsive">
                    <div class="table-responsive-xl">

                        <table id="manageadministrator-tab" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">sr no.</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">email</th>
                                    <th scope="col">Phone no.</th>
                                    <th scope="col">Date Added</th>
                                    <th scope="col">Active</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php  
                    
                                $loginid = $_SESSION['ID'];
                                $fetch_admins_query = "SELECT ID, FirstName,LastName,EmailID,CreatedDate,IsActive FROM users WHERE RoleID = 2";
                                $fetch_admins = mysqli_query($connection,$fetch_admins_query);
                                $i=1;

                                while ($admin_row = mysqli_fetch_array($fetch_admins)) {  
                                $adminid = $admin_row['ID'];
                                ?>
                                

                                <tr>
                                    <td class="text-center"><?php echo $i; ?></td>
                                    <td><?php echo $admin_row['FirstName']; ?></td>
                                    <td><?php echo $admin_row['LastName']; ?></td>
                                    <td><?php echo $admin_row['EmailID']; ?></td>
                                    <td>
                                        <?php
                                    
                                            $fetch_adminprofile_query = "SELECT CountryCode,PhoneNumber FROM user_profile WHERE UserID = $adminid";
                                            $fetch_adminprofile = mysqli_query($connection , $fetch_adminprofile_query);
                                            $adminprofile = mysqli_fetch_assoc($fetch_adminprofile);
                                            if( empty($adminprofile['CountryCode']) && empty($adminprofile['PhoneNumber'])){
                                                echo "NA";
                                            }else{
                                                echo $adminprofile['CountryCode'].$adminprofile['PhoneNumber'];
                                            }
                                    
                                        ?>
                                    </td>
                                    <td><?php echo $admin_row['CreatedDate']; ?></td>
                                    <td class="text-center">
                                    <?php
                                        if($admin_row['IsActive'] == 1){
                                            echo "YES"; 
                                        }else{
                                            echo "NO";
                                        } 
                                    ?>
                                    </td>
                                    <td class="text-center">
                                        <img class="edit-img-in-table" onclick="window.location.href='addadministrator.php?admin=1&editid=<?php echo $adminid; ?>'" src="images/dashboard/edit.png" alt="edit">
                                        <img class="delete-img-in-table" onclick="inactiveadmin('<?php echo $adminid; ?>')" src="images/dashboard/delete.png" alt="edit">
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

            </div>

        </div>
        



    <!-- footer -->
    <section class="footer footer-admin">
        <div class="container-fluid">
            <hr>
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-6 text-right"><p>Version : 1.1.24</p></div>
                <div class="col-md-4 col-sm-4 col-xs-6 "></div>
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
        });
    </script>
    <script>
    
        function inactiveadmin(adminid){
            var approvecheck = confirm("Are you sure you want to make this administrator inactive?");
            if(approvecheck == true){
                location.replace("manageadministrator.php?admin=1&inactiveid="+adminid);
            }else{
                
            }
        }
    
    </script>
    
    </body>
</html>