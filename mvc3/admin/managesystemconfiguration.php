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
?>
<?php
    if(isset($_POST['submit'])){
        $smail= mysqli_real_escape_string($connection,$_POST['supportemail'] );
        $sphone= mysqli_real_escape_string($connection,$_POST['supportphonenumber'] );
        $emails= mysqli_real_escape_string($connection,$_POST['email'] );
        $furl= mysqli_real_escape_string($connection,$_POST['facebook'] );
        $turl= mysqli_real_escape_string($connection,$_POST['twitter'] );
        $lurl= mysqli_real_escape_string($connection,$_POST['linkedin'] );
        $notep= $_FILES['defaultnote'];
        $profilep= $_FILES['defaultprofile'];

        if(!$profilep['name']){
            $f1_query = "SELECT Value FROM system_configurations WHERE ID = 5";
            $f1_data = mysqli_query($connection , $f1_query);
            $file1 = $f1_data['Value'];
            unlink($file1);
        }


        $profilepname = $profilep['name'];
        $profilep_ext = explode('.',$profilepname);
        $profilep_ext_check = strtolower(end($profilep_ext));
        $valid_profilep_ext = array('png','jpg','jpeg');
            if(in_array($profilep_ext_check,$valid_profilep_ext)){
                $profilepnewname = 'dp.'.$profilep_ext_check;
                $profileppath = $pp['tmp_name'];
                if(!is_dir("../front/images/default/profile/")){
                    mkdir("../front/images/default/profile/",0777,true);
                }
                $profilep_dest = '../front/images/default/profile/'.$profilepnewname;
                move_uploaded_file( $profileppath , $profilep_dest );
            }else{

                ?>
                <script>
                    alert("profile pic should be in jpg , jpeg , png format only");
                </script>
                <?php
            }
        if(!$notep['name']){
            $f2_query = "SELECT Value FROM system_configurations WHERE ID = 4";
            $f2_data = mysqli_query($connection , $f2_query);
            $file2 = $f2_data['Value'];
            unlink($file2);
        }

        $notepname = $notep['name'];
        $notep_ext = explode('.',$notepname);
        $notep_ext_check = strtolower(end($notep_ext));
        $valid_notep_ext = array('png','jpg','jpeg');
        if(in_array($notep_ext_check,$valid_notep_ext)){
            $notepnewname = 'dnp.'.$notep_ext_check;
            $noteppath = $np['tmp_name'];
            if(!is_dir("../front/images/default/note/")){
                mkdir("../front/images/default/note/",0777,true);
            }
            $notep_dest = '../front/images/default/note/'.$notepnewname;
            move_uploaded_file($noteppath,$notep_dest);
        }else{
            ?>
            <script>
                alert("Note pic should be in jpg , jpeg , png format only");
            </script>
            <?php
        }
        $u1 = mysqli_query($connection,"update system_configurations SET Value='$smail' , ModifiedDate = NOW() , ModifiedBy = ".$_SESSION['ID']." where ID=1");
        $u2 = mysqli_query($connection,"update system_configurations SET Value='$sphone' , ModifiedDate = NOW() , ModifiedBy = ".$_SESSION['ID']." where ID=2");
        $u3 = mysqli_query($connection,"update system_configurations SET Value='$emails' , ModifiedDate = NOW() , ModifiedBy = ".$_SESSION['ID']." where ID=3");
        $u4 = mysqli_query($connection,"update system_configurations SET Value='$notep_dest' , ModifiedDate = NOW() , ModifiedBy = ".$_SESSION['ID']." where ID=4");
        $u5 = mysqli_query($connection,"update system_configurations SET Value='$profilep_dest' , ModifiedDate = NOW() , ModifiedBy = ".$_SESSION['ID']." where ID=5");
        $u6 = mysqli_query($connection,"update system_configurations SET Value='$furl' , ModifiedDate = NOW() , ModifiedBy = ".$_SESSION['ID']." where ID=6");
        $u7 = mysqli_query($connection,"update system_configurations SET Value='$turl' , ModifiedDate = NOW() , ModifiedBy = ".$_SESSION['ID']." where ID=7");
        $u8 = mysqli_query($connection,"update system_configurations SET Value='$lurl' , ModifiedDate = NOW() , ModifiedBy = ".$_SESSION['ID']." where ID=8");


        if($u1 and $u2 and $u3 and $u4 and $u5 and $u6){
            header("location:admindashboard.php?admin=1");
        }
    }

    $select1 = mysqli_query($connection,"select Value from system_configurations Where ID=1");
    $select2 = mysqli_query($connection,"select Value from system_configurations Where ID=2");
    $select3 = mysqli_query($connection,"select Value from system_configurations Where ID=3");
    $select4 = mysqli_query($connection,"select Value from system_configurations Where ID=6");
    $select5 = mysqli_query($connection,"select Value from system_configurations Where ID=7");
    $select6 = mysqli_query($connection,"select Value from system_configurations Where ID=8");
    $s1 = mysqli_fetch_assoc($select1);
    $s2 = mysqli_fetch_assoc($select2);
    $s3 = mysqli_fetch_assoc($select3);
    $s4 = mysqli_fetch_assoc($select4);
    $s5 = mysqli_fetch_assoc($select5);
    $s6 = mysqli_fetch_assoc($select6);

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
    
    <!-- profile form -->
	<div class="admin-profile-form container">
            <div class="row">
                <form class="profile-form col-md-12" enctype="multipart/form-data" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
                    <div class="col-md-12 profile-form-heading">
                        <h2>Manage System Configuration</h2>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="supportemail">Support emails address &#42;</label>
                            <input type="email" class="form-control" name="supportemail" id="supportemail" placeholder="Enter email address" required value="<?php echo $s1['Value'] ?>">
                        </div>
                        <div class="form-group col-md-6">
                            
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="supportphonenumber">Support phone number &#42;</label>
                            <input type="number" class="form-control" name="supportphonenumber" id="supportphonenumber" placeholder="Enter phone number" required value="<?php echo $s2['Value'] ?>">
                        </div>
                        <div class="form-group col-md-6">
                            
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">Email Address(es) (for various events system will send notifications to these users)&#42;</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Enter email address" required value="<?php echo $s3['Value'] ?>">
                        </div>
                        <div class="form-group col-md-6">
                            
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="facebook">Facebook URL</label>
                            <input type="url" class="form-control" name="facebook" id="facebook" placeholder="Enter facebook url" value="<?php echo $s4['Value'] ?>">
                        </div>
                        <div class="form-group col-md-6">
                            
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="twitter">Twitter URL</label>
                            <input type="url" class="form-control" name="twitter" id="twitter" placeholder="Enter twitter url" value="<?php echo $s5['Value'] ?>">
                        </div>
                        <div class="form-group col-md-6">
                            
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="linkedin">Linkedin URL</label>
                            <input type="url" class="form-control" name="linkedin" id="linkedin" placeholder="Enter linkedin url" value="<?php echo $s6['Value'] ?>">
                        </div>
                        <div class="form-group col-md-6">
                            
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="defaultnote">Default image for notes (if seller do not upload)</label>
                            <input type="file" name="defaultnote" class="form-control-file pp-upload" id="pp">
                        </div>
                        <div class="form-group col-md-6">
                            
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="defaultprofile">Default profile picture (if seller do not upload)</label>
                            <input type="file" name="defaultprofile" class="form-control-file pp-upload" id="pp">
                        </div>
                        <div class="form-group col-md-6">
                            
                        </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-profile">Submit</button>
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

    <!-- custom js -->
    <script src="js/script.js"></script>

</body>
</html>