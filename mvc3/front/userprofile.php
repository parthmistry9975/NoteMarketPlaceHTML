<?php ob_start(); ?>
<?php include 'includes/db.php'; ?>
<?php  

    session_start();
    if(!isset($_SESSION['ID'])){
        header("location:login.php");
    }
    if($_SESSION['ROLE'] != 3){
        header("location:../admin/admindashboard.php?admin=1");
    }
?>

<?php

        $s= mysqli_query($connection,"select * from user_profile where UserID=".$_SESSION['ID']);
        $scount=mysqli_num_rows($s);
        if($scount>0){
            $res = mysqli_fetch_assoc($s);
            $date = $res['DOB'];
            $timestamp = strtotime($date);
            $new_date = date("Y-m-d", $timestamp);
            $_SESSION['dob'] = $new_date;   
            $_SESSION['gender'] = $res['Gender'];
            $_SESSION['countrycode'] = $res['CountryCode'];
            $_SESSION['phone'] = $res['PhoneNumber'];
            $_SESSION['profilepic_dest'] = $res['ProfilePicture'];
            $_SESSION['add1'] = $res['AddressLine1'];
            $_SESSION['add2'] = $res['AddressLine2'];
            $_SESSION['city'] = $res['City'];
            $_SESSION['state'] = $res['State'];
            $_SESSION['zipcode'] = $res['ZipCode'];
            $_SESSION['country'] = $res['Country'];
            $_SESSION['university'] = $res['University'];
            $_SESSION['college'] = $res['College'];
        }


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
            
            if($firstname!==$_SESSION['FNAME']){
                $updatefname = mysqli_query($connection,"update users SET FirstName='$firstname' , ModifiedDate = NOW() WHERE EmailID = '$emailid' ");
                $_SESSION['FNAME']=$firstname;
            }
            if($lastname!==$_SESSION['LNAME']){
                $updatelname = mysqli_query($connection,"update users SET LastName='$lastname' , ModifiedDate = NOW() WHERE EmailID = '$emailid' ");
                $_SESSION['LNAME']=$lastname;
            }
            
            if($scount>0){
            
                $result= mysqli_fetch_assoc($s);
                if(isset($result['ProfilePicture'])){
                    $path = $result['ProfilePicture'];
                }else{
                    $path = ''; 
                }

                $profilepicname = $profilepicture['name'];
                if(!$profilepicname){
                    $profilepic_dest = "$path";  
                }else{
                    $delete_pic = $_SESSION['profilepic_dest'];
                    if(file_exists($delete_pic)){
                        unlink($delete_pic);   
                    }
                    $profilepic_ext = explode('.',$profilepicname);
                    $profilepic_ext_check = strtolower(end($profilepic_ext));
                    $valid_profilepic_ext = array('png','jpg','jpeg');
                    if(in_array($profilepic_ext_check,$valid_profilepic_ext)){
                        
                        $profilepicnewname = "pp_".date("dmyhis").'.'.$profilepic_ext_check;
                        $profilepicpath = $profilepicture['tmp_name'];
                        if(!is_dir("../upload/$loginid/profile/")){
                            
                            mkdir("../upload/$loginid/profile/",0777,true);
                        
                        }
                        $profilepic_dest = "../upload/$loginid/profile/".$profilepicnewname;
                        move_uploaded_file($profilepicpath,$profilepic_dest);
                        
                    }
                    else{
                        ?>
                        <script>alert("profile pic should be in jpg,jpeg,png format only");</script>
                        <?php
                    }
                }

                $update = "UPDATE user_profile SET DOB='$dob',Gender='$gender' , CountryCode='$countrycode', PhoneNumber='$phonenumber', ProfilePicture='$profilepic_dest',AddressLine1='$address1', AddressLine2='$address2' , City='$city' , State='$state' , ZipCode='$zipcode' , Country='$country' , University='$university', College='$college' , ModifiedDate=NOW() , ModifiedBy = '$loginid' where UserID = '$loginid'  "; 
                $updatequery = mysqli_query($connection,$update);

                if($updatequery){
                $_SESSION['dob'] = $dob;
                $_SESSION['gender'] = $gender;
                $_SESSION['countrycode'] = $countrycode;
                $_SESSION['phone'] = $phonenumber;
                $_SESSION['profilepic_dest'] = $profilepic_dest;
                $_SESSION['add1'] = $address1;
                $_SESSION['add2'] = $address2;
                $_SESSION['city'] = $city;
                $_SESSION['state'] = $state;
                $_SESSION['zipcode'] = $zipcode;
                $_SESSION['country'] = $country;
                $_SESSION['university'] = $university;
                $_SESSION['college'] = $college;
                ?>
                <script>alert("profile updated successfully");</script>
                <?php
                }
                else{
                ?>
                <script>alert("profile not updated ");</script>
                <?php
                }
                
            }else{
                
                $profilepicname = $profilepicture['name'];
                if(!$profilepicname){
                    $profilepic_dest = "";  
                }else{
                    $profilepic_ext = explode('.',$profilepicname);
                    $profilepic_ext_check = strtolower(end($profilepic_ext));
                    $valid_profilepic_ext = array('png','jpg','jpeg');
                    if(in_array($profilepic_ext_check,$valid_profilepic_ext)){
                    $profilepicnewname = "pp_".date("dmyhis").'.'.$profilepic_ext_check;
                    $profilepicpath = $profilepicture['tmp_name'];
                    if(!is_dir("../upload/$loginid/profile/")){
                    mkdir("../upload/$loginid/profile/",0777,true);
                    }
                    $profilepic_dest = "../upload/$loginid/profile/".$profilepicnewname;
                    move_uploaded_file($profilepicpath,$profilepic_dest);
                    }
                    else{
                        ?>
                        <script>alert("profile pic should be in jpg,jpeg,png format only");</script>
                        <?php
                    }
                }
                
                $insert = "INSERT INTO user_profile(UserID, DOB, Gender, CountryCode, PhoneNumber,ProfilePicture,AddressLine1, AddressLine2, City, State, ZipCode, Country, University, College, CreatedBy) VALUES ($loginid,'$dob',$gender,'$countrycode',$phonenumber,'$profilepic_dest','$address1','$address2','$city','$state','$zipcode','$country','$university','$college','$loginid')";
                $insertquery = mysqli_query($connection,$insert);
                if($insertquery){
                $_SESSION['dob'] = $dob;
                $_SESSION['gender'] = $gender;
                $_SESSION['countrycode'] = $countrycode;
                $_SESSION['phone'] = $phonenumber;
                $_SESSION['profilepic_dest'] = $profilepic_dest;
                $_SESSION['add1'] = $address1;
                $_SESSION['add2'] = $address2;
                $_SESSION['city'] = $city;
                $_SESSION['state'] = $state;
                $_SESSION['zipcode'] = $zipcode;
                $_SESSION['country'] = $country;
                $_SESSION['university'] = $university;
                $_SESSION['college'] = $college;
                ?>
                <script>alert("profile created successfully");</script>
                <?php
                }
                else{
                ?>
                <script>alert("profile not created");</script>
                <?php
                }
                
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
                        if(isset($image_path['ProfilePicture'])){
                            $pp_file = $image_path['ProfilePicture'];
                        }else{
                            $pp_file = "images/dashboard/eye.png";
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
                            <input type="text" title="numbers are not allowed must have 3 characters" name="firstname" class="form-control" id="firstname" value="<?php echo $_SESSION['FNAME'];?>" placeholder="Enter your first name" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="lastname">Last Name &#42;</label>
                            <input type="text" title="numbers are not allowed must have 3 characters" name="lastname" class="form-control" id="lastname" value="<?php echo $_SESSION['LNAME'];?>" placeholder="Enter your last name" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">Email &#42;</label>
                            <input type="email" title="valid email formate : char@char.char" name="emailid" value="<?php echo $_SESSION['MAILID'];?>" class="form-control" id="email" placeholder="Enter your email address" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="dob">Date Of Birth</label>
                            <input type="date" name="dob" value="<?php if(isset($_SESSION['dob'])){echo $_SESSION['dob'];}?>" class="form-control" id="dob" placeholder="Enter your date of birth">
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
                                        <option value="<?php echo $genderrow['ID'];?>" <?php if(isset($_SESSION['gender'])){if($_SESSION['gender']==$genderrow['ID']){echo "selected";}}?>>
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
                                        <option value="<?php echo $countrycoderow['CountryCode'];?>" <?php if(isset($_SESSION['countrycode'])){ if($_SESSION['countrycode']==$countrycoderow['CountryCode']){echo "selected";} }?>>
                                        <?php echo $countrycoderow['CountryCode'] ;?>
                                        </option>
                                <?php
                            }
                            ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4 col-sm-8">
                            <label for="phonenumber">&nbsp;</label>
                            <input type="tel" pattern="[0-9]{7,}" title="only numbers are allowed must have 10 characters" name="phonenumber" class="form-control phone" id="phonenumber" value="<?php if(isset($_SESSION['phone'])){ echo $_SESSION['phone']; }?>" placeholder="Enter your phone number">
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
                            <input type="text" title="must have 5 characters" name="address1" class="form-control" id="address1" placeholder="Enter your address" value="<?php if(isset($_SESSION['add1'])){echo $_SESSION['add1']; }?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="address2">Address Line 2</label>
                            <input type="text" title="must have 5 characters" name="address2" class="form-control" id="address2" placeholder="Enter your address" value="<?php if(isset($_SESSION['add2'])){ echo $_SESSION['add2']; }?>">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="city">City &#42;</label>
                            <input type="text" title="must have 2 characters and numbers not allowed" name="city" class="form-control" id="city" placeholder="Enter your city" value="<?php if(isset($_SESSION['city'])){echo $_SESSION['city'];} ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="state">State &#42;</label>
                            <input type="text" title="must have 2 characters and numbers not allowed" name="state" class="form-control" id="state" placeholder="Enter your state" value="<?php if(isset($_SESSION['state'])){ echo $_SESSION['state']; }?>" required>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="zipcode">ZipCode &#42;</label>
                            <input type="text" pattern="[0-9]{1,}" title="must have 2 characters " name="zipcode" class="form-control" id="zipcode" placeholder="Enter your zipcode" value="<?php if(isset($_SESSION['zipcode'])){ echo $_SESSION['zipcode'];} ?>" required>
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
                                        <option value="<?php echo $countryrow['Name'];?>" <?php if(isset($_SESSION['country'])){if($_SESSION['country']==$countryrow['Name']){echo "selected";}} ?>>
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
                            <input type="text" title="numbers are not allowed must have 3 characters" name="university" class="form-control" id="university" placeholder="Enter your university" value="<?php if(isset($_SESSION['university'])){ echo $_SESSION['university'];}?>">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="college">College</label>
                            <input type="text" title="numbers are not allowed must have 3 characters" name="college" class="form-control" id="college" placeholder="Enter your college" value="<?php if(isset($_SESSION['college'])){echo $_SESSION['college'];}?>">
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