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
    if(isset($_SESSION['categorydel']) and $_SESSION['categorytdel'] == 'yes'){
        $_SESSION['status'] = "Category Inactivated !!";
        $_SESSION['status_code'] = "success";
        unset($_SESSION['categorydel']);
    }
    if(isset($_SESSION['categorydel']) and $_SESSION['categorytdel'] == 'no'){
        $_SESSION['status'] = "Category isn't Inactivated !!";
        $_SESSION['status_code'] = "error";
        unset($_SESSION['categorydel']);
    }
    if(isset($_SESSION['categoryadd']) and $_SESSION['categoryadd'] == 'yes'){
        $_SESSION['status'] = "Category Added !!";
        $_SESSION['status_code'] = "success";
        unset($_SESSION['categoryadd']);
    }
    if(isset($_SESSION['categoryadd']) and $_SESSION['categoryadd'] == 'no'){
        $_SESSION['status'] = "Category isn't Added !!";
        $_SESSION['status_code'] = "error";
        unset($_SESSION['categoryadd']);
    }
    if(isset($_SESSION['categoryedit']) and $_SESSION['categoryedit'] == 'yes'){
        $_SESSION['status'] = "Category Updated !!";
        $_SESSION['status_code'] = "success";
        unset($_SESSION['categoryedit']);
    }
    if(isset($_SESSION['categoryedit']) and $_SESSION['categoryedit'] == 'no'){
        $_SESSION['status'] = "Category isn't Updated !!";
        $_SESSION['status_code'] = "error";
        unset($_SESSION['categoryedit']);
    }
    $fornav = 'manage';
?>
<?php

    if(isset($_GET['inactiveid'])){
        
        $inactive_category_id = $_GET['inactiveid'];
        $inactive_category_query = "UPDATE note_categories SET IsActive = 0 , ModifiedDate = NOW() , ModifiedBy = ".$_SESSION['ID']." WHERE ID = $inactive_category_id";
        $inactive_category = mysqli_query($connection , $inactive_category_query);
        if($inactive_category){
            $_SESSION['categorydel'] = "yes";
            header("location:managecategory.php?admin=1");
        }else{
            $_SESSION['categorydel'] = "no";
            header("location:managecategory.php?admin=1");
        }
        
    }

?>

        <?php include 'includes/header.php'; ?>
        
        <div class="content-box-lg">

            <div class="container">
                <div class="row no-gutters margin-upper">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-left box-heading-wrapper">
                        <p class="box-heading">Manage Category</p>
                    </div>

                    <div class="col-lg-5 col-md-5 col-sm-5 col-12">
                        <button onclick="window.location.href='addcategory.php?admin=1'" class="btn btn-general btn-purple add-category-btn">Add Category</button>
                    </div>

                    <div class="col-lg-7 col-md-7 col-sm-7 col-12">

                        <div class="row no-gutters general-search-bar-btn-wrapper">
                            <div class="form-group has-search-bar">
                                <span class="search-symbol"><img src="images/dashboard/search-icon.svg" alt=""></span>
                                <input type="text" class="form-control input-box-style search-notes-bar searchtext" id="example" placeholder="Search">
                            </div>
    
                            <button class="btn btn-general search1 btn-purple general-search-bar-btn">Search</button>
                        </div>

                    </div>
                </div>
            </div>    
            
            <div class="container">

                <div class="manage-category-table general-table-responsive">
                    <div class="table-responsive-xl">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">sr no.</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Date Added</th>
                                    <th scope="col">Added By</th>
                                    <th scope="col" class="text-center">Active</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                <?php  
                    
                                $loginid = $_SESSION['ID'];
                                $fetch_categories_query = "SELECT ID,Name,Description,CreatedDate,CreatedBy,IsActive FROM note_categories";
                                $fetch_categories = mysqli_query($connection,$fetch_categories_query);
                                $i=1;

                                while ($category_row = mysqli_fetch_array($fetch_categories)) {  
                                $categoryid = $category_row['ID'];
                                    
                                ?>
                                
                                <tr>
                                    <td class="text-center"><?php echo $i; ?></td>
                                    <td><?php echo $category_row['Name']; ?></td>
                                    <td><?php echo $category_row['Description']; ?></td>
                                    <td><?php echo $category_row['CreatedDate']; ?></td>
                                    <td>
                                    <?php 
                                    
                                        $fetch_name_query = "SELECT FirstName , LastName FROM users WHERE ID = ".$category_row['CreatedBy'];
                                        $fetch_name = mysqli_query($connection , $fetch_name_query);
                                        $name = mysqli_fetch_assoc($fetch_name);
                                        echo $name['FirstName']." ".$name['LastName'];
                                    
                                    ?>
                                    </td>
                                    <td class="text-center"><?php if($category_row['IsActive'] == 1){ echo "yes"; }else{ echo "no"; } ?></td>
                                    <td class="text-center">
                                        <img class="edit-img-in-table" onclick="window.location.href='addcategory.php?admin=1&editid=<?php echo $categoryid; ?>'" src="images/dashboard/edit.png" alt="edit">
                                        <img class="delete-img-in-table" onclick="inactivecategory('<?php echo $categoryid; ?>')" src="images/dashboard/delete.png" alt="edit">
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
    
        function inactivecategory(categoryid){
            var approvecheck = confirm("Are you sure you want to make this category inactive?");
            if(approvecheck == true){
                location.replace("managecategory.php?admin=1&inactiveid="+categoryid);
            }else{
                
            }
        }
    
    </script>
    </body>

</html>