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
                
                $typename = mysqli_real_escape_string($connection,$_POST['typename']);
                $typedescription = mysqli_real_escape_string($connection,$_POST['description']);
                $loginid = $_SESSION['ID'];
                $add_type_query = "INSERT INTO note_types( Name , Description , CreatedBy ) VALUES ( '$typename' , '$typedescription' , $loginid)";
                $add_type = mysqli_query($connection , $add_type_query);
                if($add_type){
                    $_SESSION['typeadd'] = "yes";
                    header("location:managetype.php?admin=1");
                }else{
                    $_SESSION['typeadd'] = "no";
                    header("location:managetype.php?admin=1");
                }
            }
            
            if(isset($_POST['edit'])){
                
                $typename = mysqli_real_escape_string($connection,$_POST['typename']);
                $typedescription = mysqli_real_escape_string($connection,$_POST['description']);
                $loginid = $_SESSION['ID'];
                $edit_typeid = $_POST['edit'];
                $edit_type_query = "UPDATE note_types SET Name = '$typename' , Description = '$typedescription', ModifiedDate = NOW() , ModifiedBy = $loginid WHERE ID = $edit_typeid";
                $edit_type = mysqli_query($connection , $edit_type_query);
                if($edit_type){
                    $_SESSION['typeedit'] = "yes";
                    header("location:managetype.php?admin=1");
                }else{
                    $_SESSION['typeedit'] = "no";
                    header("location:managetype.php?admin=1");
                }
            }
        
            if(isset($_GET['editid'])){

                $editid = $_GET['editid'];
                $fetch_type_details = "SELECT Name,Description FROM note_types WHERE ID = $editid";
                $fetch_type = mysqli_query($connection , $fetch_type_details);
                $type_details = mysqli_fetch_assoc($fetch_type);
                $tname = $type_details['Name'];
                $tdesc = $type_details['Description'];
                    
            }

        ?>
        
        ?>

        <!-- profile form -->
        <div class="admin-profile-form container">
                <div class="row">
                    <form action="addtype.php?admin=1" method="post" class="profile-form col-md-12">
                        <div class="col-md-12 profile-form-heading">
                            <h2>Add Type</h2>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="type">Type &#42;</label>
                                <input type="text" name="typename"
                                <?php 
                                   if(isset($_GET['editid'])){
                                       echo "value='$tname'";
                                   } 
                            ?> class="form-control" id="type" placeholder="Enter your type name">
                            </div>
                            <div class="form-group col-md-6">

                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="description">Description &#42;</label>
                                <textarea name="description" class="form-control hw" id="description" cols="50" rows="8" placeholder="Enter your description" required><?php 
                                   if(isset($_GET['editid'])){
                                       echo $tdesc;
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