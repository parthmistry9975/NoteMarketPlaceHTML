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
    <?php include 'includes/header.php'; ?>
    
    <?php
            
            if(isset($_POST['submit'])){
                
                $countryname = mysqli_real_escape_string($connection,$_POST['countryname']);
                $countrycode = mysqli_real_escape_string($connection,$_POST['countrycode']);
                $loginid = $_SESSION['ID'];
                $add_country_query = "INSERT INTO countries( Name , CountryCode , CreatedBy ) VALUES ( '$countryname' , '$countrycode' , $loginid)";
                $add_country = mysqli_query($connection , $add_country_query);
                if($add_country){
                    $_SESSION['countryadd'] = "yes";
                    header("location:managecountry.php?admin=1");
                }else{
                    $_SESSION['countryadd'] = "no";
                    header("location:managecountry.php?admin=1");
                }
            }
            
            if(isset($_POST['edit'])){
                
                $countryname = mysqli_real_escape_string($connection,$_POST['countryname']);
                $countrycode = mysqli_real_escape_string($connection,$_POST['countrycode']);
                $loginid = $_SESSION['ID'];
                $edit_countryid = $_POST['edit'];
                $edit_country_query = "UPDATE countries SET Name = '$countryname' , CountryCode = '$countrycode', ModifiedDate = NOW() , ModifiedBy = $loginid WHERE ID = $edit_countryid";
                $edit_country = mysqli_query($connection , $edit_country_query);
                if($edit_country){
                    $_SESSION['countryedit'] = "yes";
                    header("location:managecountry.php?admin=1");
                }else{
                    $_SESSION['countryedit'] = "no";
                    header("location:managecountry.php?admin=1");
                }
            }
                
        
        
    
            if(isset($_GET['editid'])){

                $editid = $_GET['editid'];
                $fetch_country_details = "SELECT Name,CountryCode FROM countries WHERE ID = $editid";
                $fetch_country = mysqli_query($connection , $fetch_country_details);
                $country_details = mysqli_fetch_assoc($fetch_country);
                $cname = $country_details['Name'];
                $ccode = $country_details['CountryCode'];
                    
            }

        ?>
    
    <!-- profile form -->
	<div class="admin-profile-form container">
            <div class="row">
                <form action="addcountry.php?admin=1" method="post" class="profile-form col-md-12">
                    <div class="col-md-12 profile-form-heading">
                        <h2>Add Country</h2>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="countryname">Country Name &#42;</label>
                            <input type="text"
                            <?php 
                                   if(isset($_GET['editid'])){
                                       echo "value='$cname'";
                                   } 
                            ?> name="countryname" class="form-control" id="countryname" placeholder="Enter your country name">
                        </div>
                        <div class="form-group col-md-6">
                            
                        </div>
                    </div>
                        
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="countrycode">Country Code &#42;</label>
                            <input type="text"
                            <?php 
                                   if(isset($_GET['editid'])){
                                       echo "value='$ccode'";
                                   } 
                            ?> name="countrycode" class="form-control" id="countrycode" placeholder="Enter your country code">
                        </div>
                        <div class="form-group col-md-6">
                            
                        </div>
                    </div>
                    <br>
                    <button type="submit" <?php 
                                   if(isset($_GET['editid'])){
                                       echo "value='$editid'";
                                   } 
                            ?> <?php if(isset($_GET['editid'])){ echo "name='edit'"; }else{ echo "name='submit'";} ?> class="btn btn-profile"><?php if(isset($_GET['editid'])){ echo 'update'; }else{ echo 'submit';} ?></button>
                    <br><br><br><br>
                </form>
            </div>
        </div>
	<!-- profile form ends -->
	
	<?php include 'includes/footernlink.php'; ?>

</body>
</html>