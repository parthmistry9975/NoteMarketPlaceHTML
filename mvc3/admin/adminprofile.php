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

    <?php include 'includes/header.php'; ?>
    
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

</body>
</html>