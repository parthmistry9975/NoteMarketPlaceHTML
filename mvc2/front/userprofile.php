<?php ob_start(); ?>
<?php include 'includes/db.php'; ?>
<?php  

    session_start();
    if(!isset($_SESSION['ID'])){
        header("location:login.php");
    }
?>

<?php
        if(isset($_POST['save'])){
            $firstname = mysqli_real_escape_string($connection,$_POST['firstname'] );
            $lastname = mysqli_real_escape_string($connection,$_POST['lastname'] );
            $emailid = mysqli_real_escape_string($connection,$_POST['emailid'] );
            $dob = mysqli_real_escape_string($connection,$_POST['dob'] );
            $gender = mysqli_real_escape_string($connection,$_POST['gender'] );
            $countrycode = mysqli_real_escape_string($connection,$_POST['countrycode'] );
            $phonenumber = mysqli_real_escape_string($connection,$_POST['phonenumber'] );
            $profilepicture = $_FILES['profilepicture'];
            $address1 = mysqli_real_escape_string($connection,$_POST['address1'] );
            $address2 = mysqli_real_escape_string($connection,$_POST['address2'] );
            $city = mysqli_real_escape_string($connection,$_POST['city'] );
            $state = mysqli_real_escape_string($connection,$_POST['state'] );
            $zipcode = mysqli_real_escape_string($connection,$_POST['zipcode'] );
            $country = mysqli_real_escape_string($connection,$_POST['country'] );
            $university = mysqli_real_escape_string($connection,$_POST['university'] );
            $college = mysqli_real_escape_string($connection,$_POST['college'] );
            $loginid = $_SESSION['ID'];
            
            
            $profilepicname = $profilepicture['name'];
            $profilepic_ext = explode('.',$profilepicname);
            $profilepic_ext_check = strtolower(end($profilepic_ext));
            $valid_profilepic_ext = array('png','jpg','jpeg');
            $profilepicnewname = "pp_".date("dmyhis").'.'.$profilepic_ext_check;
        
            
            if(in_array($profilepic_ext_check,$valid_profilepic_ext) ) {
                
                $insert_data_query = "INSERT INTO user_profile( UserID , DOB , Gender , CountryCode , PhoneNumber , ProfilePicture , AddressLine1 , AddressLine2 , City , State , ZipCode , Country , University , College , CreatedBy) VALUES ( '$loginid' , '$dob' , '$gender' , '$countrycode' , '$phonenumber' , '$profilepicnewname' , '$address1' , '$address2' , '$city' , '$state' , '$zipcode' , '$country' , '$university' , '$college' , '$loginid')";
                $update_data_query = "UPDATE users SET FirstName = '$firstname' AND LastName = '$lastname' WHERE ID = $loginid";
                $insert_data = mysqli_query($connection, $insert_data_query);
                $update_data = mysqli_query($connection, $update_data_query);
                
                $profilepicpath = $profilepicture['tmp_name'];
                if(!is_dir("../upload/$loginid/profile/")){
                    mkdir("../upload/$loginid/profile/",0777,true);
                }
                $profilepic_dest = "../upload/$loginid/profile/".$profilepicnewname;
                move_uploaded_file($profilepicpath,$profilepic_dest);
                
                if($insert_data && $update_data){
                ?>
                    <script>
                        alert("profile is updated");
                        window.location = "searchnotes.php";
                    </script>
                <?php
                }
                else{
                ?>
                    <script>
                        alert("profile isn't updated !! ");
                        window.location = "userprofile.php";
                    </script>
                <?php
                }
                
            }else{
                ?>
                    <script>
                        alert("please choose proper file type !! for profile picture jpg , jpeg , png !! ");
                    </script>
                <?php
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
    <link rel="stylesheet" type="text/css" href="css/responsive.css">

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
                        $pp_file = "../upload/".$_SESSION['ID']."/profile/".$image_path['ProfilePicture'];
                        
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
    
	<!-- Banner  -->
        <section class="banner">
            <div class="content-box-banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="text-center">User Profile</h1>
                    </div>
                </div>
            </div>
        </div>
        </section>
        <!-- Banner Ends -->
	
	<!-- profile form -->
	<div class="container">
            <div class="row">
                <form action="userprofile.php" method="post" class="profile-form col-md-12" enctype="multipart/form-data">
                    <div class="col-md-12 profile-form-heading">
                        <h2>Basic Profile Details</h2>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="firstname">First Name &#42;</label>
                            <input type="text" name="firstname" class="form-control" id="firstname" placeholder="Enter your first name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="lastname">Last Name &#42;</label>
                            <input type="text" name="lastname" class="form-control" id="lastname" placeholder="Enter your last name" required>
                        </div>
                    </div>
                    <?php
                    
                        $fetch_id = $_SESSION['ID'];
                        $fetch_emailid_query = "SELECT EmailID FROM users WHERE ID = $fetch_id";
                        $fetch_emailid = mysqli_query($connection, $fetch_emailid_query);
                        $fetch_emailid_row = mysqli_fetch_assoc($fetch_emailid);
                    
                    ?>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">Email &#42;</label>
                            <input type="email" name="emailid" value="<?php echo $fetch_emailid_row['EmailID']; ?>" class="form-control" id="email" placeholder="Enter your email address" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="dob">Date Of Birth</label>
                            <input type="date" name="dob" class="form-control" id="dob" placeholder="Enter your date of birth">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="gender">Gender</label>
                            <?php 
                            
                                $gender_query = "SELECT ID,Value,RefCategory FROM reference_data WHERE RefCategory = 'Gender' AND IsActive = 1";
                                $gquery = mysqli_query($connection, $gender_query);
                                $gqueryrows = mysqli_num_rows($gquery);
                            
                            ?>
                            <select id="gender" name="gender" class="form-control">
                                <option>Select your gender</option>
                                <?php
                                
                                    for($i=1;$i<=$gqueryrows;$i++){
                                        $genderrow = mysqli_fetch_array($gquery);
                                        ?>
                                        <option value="<?php echo $genderrow['ID'];?>">
                                        <?php echo $genderrow['Value'] ?>
                                        </option>
                                <?php
                            }
                            ?>
                            </select>
                        </div>
                        <div class="form-group col-md-2 col-sm-4">
                            <label for="countrycode">Phone Number</label>
                            <?php 
                            
                                $countrycode_query = "SELECT CountryCode FROM countries WHERE IsActive = 1";
                                $ccquery = mysqli_query($connection, $countrycode_query);
                                $ccqueryrows = mysqli_num_rows($ccquery);
                            
                            ?>
                            <select id="countrycode" name="countrycode" class="form-control code">
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
                        <div class="form-group col-md-4 col-sm-8">
                            <label for="phonenumber">&nbsp;</label>
                            <input type="tel" name="phonenumber" class="form-control phone" id="phonenumber" placeholder="Enter your phone number">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 file-upload">
                            <label for="profilepicture">Profile Picture</label>
                            <input type="file" name="profilepicture" class="form-control-file display-picture" id="profilepicture" >
                        </div>
                        <div class="form-group col-md-6">
                            
                        </div>
                    </div>
                
                    <div class="col-md-12 profile-form-heading">
                        <h2>Address Details</h2>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="address1">Address Line 1 &#42;</label>
                            <input type="text" name="address1" class="form-control" id="address1" placeholder="Enter your address" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="address2">Address Line 2</label>
                            <input type="text" name="address2" class="form-control" id="address2" placeholder="Enter your address">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="city">City &#42;</label>
                            <input type="text" name="city" class="form-control" id="city" placeholder="Enter your city" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="state">State &#42;</label>
                            <input type="text" name="state" class="form-control" id="state" placeholder="Enter your state" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="zipcode">ZipCode &#42;</label>
                            <input type="text" name="zipcode" class="form-control" id="zipcode" placeholder="Enter your zipcode" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="country">Country &#42;</label>
                            <?php 
                            
                                $country_query = "SELECT Name FROM countries WHERE IsActive = 1";
                                $cquery = mysqli_query($connection, $country_query);
                                $cqueryrows = mysqli_num_rows($cquery);
                            
                            ?>
                            <select id="country" name="country" class="form-control" required>
                                <option>Select your country</option>
                                <?php
                                
                                    for($i=1;$i<=$cqueryrows;$i++){
                                        $countryrow = mysqli_fetch_array($cquery);
                                        ?>
                                        <option value="<?php echo $countryrow['Name'];?>">
                                        <?php echo $countryrow['Name'] ;?>
                                        </option>
                                <?php
                            }
                            ?>
                            </select>
                        </div>
                    </div>
                    
                    <div class="col-md-12 profile-form-heading">
                        <h2>University and College Information</h2>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="university">University</label>
                            <input type="text" name="university" class="form-control" id="university" placeholder="Enter your university">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="college">College</label>
                            <input type="text" name="college" class="form-control" id="college" placeholder="Enter your college">
                        </div>
                    </div>
                    <button type="submit" name="save" class="btn btn-profile">Submit</button>
                </form>
            </div>
        </div>
	<!-- profile form ends -->
	
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
                        <li><a href="#">
                                <i class="fa fa-facebook"></i>
                            </a></li>
                        <li><a href="#">
                                <i class="fa fa-twitter"></i>
                            </a></li>
                        <li><a href="#">
                                <i class="fa fa-google-plus"></i>
                            </a></li>
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

    <!-- custom js -->
    <script src="js/script.js"></script>

</body>
</html>