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
    
    <section id="add-category">
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
            
            if(isset($_POST['submit'])){
                
                $categoryname = mysqli_real_escape_string($connection,$_POST['categoryname']);
                $categorydescription = mysqli_real_escape_string($connection,$_POST['description']);
                $loginid = $_SESSION['ID'];
                $add_category_query = "INSERT INTO note_categories( Name , Description , CreatedBy ) VALUES ( '$categoryname' , '$categorydescription' , $loginid)";
                $add_category = mysqli_query($connection , $add_category_query);
                if($add_category){
                    $_SESSION['categoryadd'] = "yes";
                    header("location:managecategory.php?admin=1");
                }else{
                    $_SESSION['categoryadd'] = "no";
                    header("location:managecategory.php?admin=1");
                }
            }
            
            if(isset($_POST['edit'])){
                
                $categoryname = mysqli_real_escape_string($connection,$_POST['categoryname']);
                $categorydescription = mysqli_real_escape_string($connection,$_POST['description']);
                $loginid = $_SESSION['ID'];
                $edit_categoryid = $_POST['edit'];
                $edit_category_query = "UPDATE note_categories SET Name = '$categoryname' , Description = '$categorydescription', ModifiedDate = NOW() , ModifiedBy = $loginid WHERE ID = $edit_categoryid";
                $edit_category = mysqli_query($connection , $edit_category_query);
                if($edit_category){
                    $_SESSION['categoryedit'] = "yes";
                    header("location:managecategory.php?admin=1");
                }else{
                    $_SESSION['categoryedit'] = "no";
                    header("location:managecategory.php?admin=1");
                }
            }
                
        
        
    
            if(isset($_GET['editid'])){

                $editid = $_GET['editid'];
                $fetch_category_details = "SELECT Name,Description FROM note_categories WHERE ID = $editid";
                $fetch_category = mysqli_query($connection , $fetch_category_details);
                $category_details = mysqli_fetch_assoc($fetch_category);
                $cname = $category_details['Name'];
                $cdesc = $category_details['Description'];
                    
            }

        ?>

        <!-- profile form -->
        <div class="admin-profile-form container">
                <div class="row">
                    <form action="addcategory.php?admin=1" method="post" class="profile-form col-md-12">
                        <div class="col-md-12 profile-form-heading">
                            <h2>Add Category</h2>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="categoryname">Category Name &#42;</label>
                                <input type="text" name="categoryname"
                                <?php 
                                   if(isset($_GET['editid'])){
                                       echo "value='$cname'";
                                   } 
                            ?> class="form-control" id="categoryname" placeholder="Enter your first name">
                            </div>
                            <div class="form-group col-md-6">

                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="description">Description &#42;</label>
                                <textarea name="description" class="form-control hw" id="description" cols="50" rows="8" placeholder="Enter your description" required><?php 
                                   if(isset($_GET['editid'])){
                                       echo $cdesc;
                                   } 
                            ?></textarea>
                            </div>
                            <div class="form-group col-md-6">

                            </div>
                        </div>
                        <button type="submit" <?php 
                                   if(isset($_GET['editid'])){
                                       echo "value='$editid'";
                                   } 
                            ?> <?php if(isset($_GET['editid'])){ echo "name='edit'"; }else{ echo "name='submit'";} ?> class="btn btn-profile"><?php if(isset($_GET['editid'])){ echo 'update'; }else{ echo 'submit';} ?></button>
                    </form>
                </div>
            </div>
        <!-- profile form ends -->
        
        <!-- footer -->
        <section class="footer-admin">
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
    </section>	
	
	
	
	<!-- jquery-->
    <script src="js/jquery.min.js"></script>

    <!-- bootstrap js -->
    <script src="js/bootstrap/popper.min.js"></script>
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- custom js -->
    <script src="js/script.js"></script>

</body>
</html>