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
?>
<?php
        if(isset($_POST['update'])){
            $firstname = mysqli_real_escape_string($connection,$_POST['firstname'] );
            $lastname = mysqli_real_escape_string($connection,$_POST['lastname'] );
            $email = mysqli_real_escape_string($connection,$_POST['email'] );
            $emailid = mysqli_real_escape_string($connection,$_POST['secondemail'] );
            $countrycode = mysqli_real_escape_string($connection,$_POST['countrycode'] );
            $phonenumber = mysqli_real_escape_string($connection,$_POST['phonenumber'] );
            $profilepicture = $_FILES['profilepicture'];
            $loginid = $_SESSION['ID'];
            
            
            $profilepicname = $profilepicture['name'];
            $profilepic_ext = explode('.',$profilepicname);
            $profilepic_ext_check = strtolower(end($profilepic_ext));
            $valid_profilepic_ext = array('png','jpg','jpeg','');
            $profilepicnewname = "pp_".date("dmyhis").'.'.$profilepic_ext_check;
        
            
            if(in_array($profilepic_ext_check,$valid_profilepic_ext) ) {
                
                $fetch_profile_check_query = "SELECT * FROM user_profile WHERE UserID = $loginid";
                $fetch_profile_check = mysqli_query($connection , $fetch_profile_check_query);
                $check_record = mysqli_num_rows($fetch_profile_check);
                $profile_check = mysqli_fetch_assoc($fetch_profile_check);
                
                
                    
                    
                    $update_profile_query = "UPDATE user_profile SET SecondaryEmailAddress = '$emailid' , CountryCode = '$countrycode' , PhoneNumber = '$phonenumber'"; 
                    if($profilepicname != ''){
                        if(!empty($profile_check['ProfilePicture'])){
                            $delete_pic = "../upload/admin/$loginid/".$profile_check['ProfilePicture'];
                            unlink($delete_pic);
                        }
                        $update_profile_query .= " , ProfilePicture = '$profilepicnewname'";
                    }
                    $update_profile_query .= " , ModifiedBy = $loginid , ModifiedDate = NOW() WHERE UserID = $loginid";
                    $update_user_query ="UPDATE users SET FirstName = '$firstname' , LastName = '$lastname' , ModifiedBy = $loginid , ModifiedDate = NOW() WHERE ID = $loginid";
                    
                    $update_profile = mysqli_query($connection, $update_profile_query);
                    $update_user = mysqli_query($connection, $update_user_query);
                    
                    if($update_profile && $update_user){
                        
                        if($profilepicname != ''){
                            $profilepicpath = $profilepicture['tmp_name'];
                            if(!is_dir("../upload/admin/$loginid/")){
                                mkdir("../upload/admin/$loginid/",0777,true);
                            }
                            $profilepic_dest = "../upload/admin/$loginid/".$profilepicnewname;
                            move_uploaded_file($profilepicpath,$profilepic_dest);
                        }
                        $_SESSION['status'] = "Profile updated !!";
                        $_SESSION['status_code'] = "success";
                        header("location:adminprofile.php?admin=1");
                    }
                    else{
                        $_SESSION['status'] = "profile isn't updated !!";
                        $_SESSION['status_code'] = "error";
                        header("location:adminprofile.php?admin=1");
                    }
                    
                
                
                
                
            }else{
                $_SESSION['status'] = "please choose proper file type !! e.g, jpg , jpeg , png !!";
                $_SESSION['status_code'] = "warning";
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

    <!-- custom css -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    
    <!-- responsive css -->
    <link rel="stylesheet" href="css/responsive.css">

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
    
    if(isset($_SESSION['ID'])){
        
        $loginid = $_SESSION['ID'];
        $fetch_login_details_query = "SELECT * FROM users WHERE ID = $loginid";
        $fetch_login_details = mysqli_query($connection , $fetch_login_details_query);
        $login_details = mysqli_fetch_assoc($fetch_login_details);
        $fetch_profile_details_query = "SELECT * FROM user_profile WHERE UserId = $loginid";
        $fetch_profile_details = mysqli_query($connection , $fetch_profile_details_query);
        $fetch_profile_num = mysqli_num_rows($fetch_profile_details);
        $checkr = 0;
        if($fetch_profile_num > 0){
            $checkr = 1;
            $profile_details = mysqli_fetch_assoc($fetch_profile_details);
        }
        
    }
    
    ?>
    <!-- profile form -->
	<div class="admin-profile-form container">
            <div class="row">
                <form action="adminprofile.php?admin=1" method="post" class="profile-form col-md-12" enctype="multipart/form-data">
                    <div class="col-md-12 profile-form-heading">
                        <h2>My Profile</h2>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="firstname">First Name &#42;</label>
                            <input type="text" name="firstname" class="form-control" value="<?php echo $login_details['FirstName'];?>" id="firstname" placeholder="Enter your first name" required>
                        </div>
                        <div class="form-group col-md-6">
                            
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="lastname">Last Name &#42;</label>
                            <input type="text" name="lastname" class="form-control" value="<?php echo $login_details['LastName'];?>" id="lastname" placeholder="Enter your last name" required>
                        </div>
                        <div class="form-group col-md-6">
                            
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">Email &#42;</label>
                            <input type="email" name="email" class="form-control" value="<?php echo $login_details['EmailID'];?>" id="email" placeholder="Enter your email address" required readonly>
                        </div>
                        <div class="form-group col-md-6">
                            
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">Secondary Email</label>
                            <input type="email" name="secondemail" value="<?php if($checkr == 1){ echo $profile_details['SecondaryEmailAddress']; } ?>" class="form-control" id="email" placeholder="Enter your email address">
                        </div>
                        <div class="form-group col-md-6">
                            
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-2">
                            <label for="countrycode">Phone Number</label>
                            <?php 
                            
                                $countrycode_query = "SELECT CountryCode FROM countries WHERE IsActive = 1";
                                $ccquery = mysqli_query($connection, $countrycode_query);
                                $ccqueryrows = mysqli_num_rows($ccquery);
                            
                            ?>
                            <select name="countrycode" id="countrycode" class="form-control code">
                                <?php
                                
                                    for($i=1;$i<=$ccqueryrows;$i++){
                                        $countrycoderow = mysqli_fetch_array($ccquery);
                                        ?>
                                        <option value="<?php echo $countrycoderow['CountryCode'];?>">
                                        <?php echo $countrycoderow['CountryCode'] ;?>
                                        </option>
                                <?php
                            }
                            ?>
                                
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="phonenumber">&nbsp;</label>
                            <input type="tel" name="phonenumber" value="<?php if($checkr == 1){ echo $profile_details['PhoneNumber']; } ?>" class="form-control phone" id="phonenumber" placeholder="Enter your phone number">
                        </div>
                        <div class="form-group col-md-6">
                            
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="pp">Profile Picture</label>
                            <input type="file" name="profilepicture" class="form-control-file pp-upload" id="pp" name="Upload a picture">
                        </div>
                        <div class="form-group col-md-6">
                            
                        </div>
                    </div>
                    <button type="submit" name="update" class="btn btn-profile">Submit</button>
                </form>
            </div>
        </div>
	<!-- profile form ends -->
	
	<!-- footer -->
    <section class="footer footer-admin">
        <div class="container-fluid">
            <hr>
            <div class="row">
                <div class="col-md-4 col-sm-4 col-xs-12 text-center"><p>Version : 1.1.24</p></div>
                <div class="col-md-4 col-sm-4 col-xs-12"></div>
                <div class="col-md-4 col-sm-4 col-xs-12 text-right"><p>Copyright &#169; Tatvasoft All right reserved.</p></div>
            </div>
        </div>
    </section>
	<!-- footer ends -->
	
	<!-- jquery-->
    <script src="js/jquery.min.js"></script>

    <!-- bootstrap js -->
    <script src="js/bootstrap/popper.min.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>
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

</body>
</html>