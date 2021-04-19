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
        	
	
	<?php include 'includes/footernlink.php'; ?>

</body>
</html>