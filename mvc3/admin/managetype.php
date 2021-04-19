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
    if(isset($_SESSION['typetdel']) and $_SESSION['typetdel'] == 'yes'){
        $_SESSION['status'] = "type Inactivated !!";
        $_SESSION['status_code'] = "success";
        unset($_SESSION['typetdel']);
    }
    if(isset($_SESSION['typetdel']) and $_SESSION['typetdel'] == 'no'){
        $_SESSION['status'] = "type isn't Inactivated !!";
        $_SESSION['status_code'] = "error";
        unset($_SESSION['typetdel']);
    }
    if(isset($_SESSION['typeadd']) and $_SESSION['typeadd'] == 'yes'){
        $_SESSION['status'] = "type Added !!";
        $_SESSION['status_code'] = "success";
        unset($_SESSION['typeadd']);
    }
    if(isset($_SESSION['typeadd']) and $_SESSION['typeadd'] == 'no'){
        $_SESSION['status'] = "type isn't Added !!";
        $_SESSION['status_code'] = "error";
        unset($_SESSION['typeadd']);
    }
    if(isset($_SESSION['typeedit']) and $_SESSION['typeedit'] == 'yes'){
        $_SESSION['status'] = "type Updated !!";
        $_SESSION['status_code'] = "success";
        unset($_SESSION['typeedit']);
    }
    if(isset($_SESSION['typeedit']) and $_SESSION['typeedit'] == 'no'){
        $_SESSION['status'] = "type isn't Updated !!";
        $_SESSION['status_code'] = "error";
        unset($_SESSION['typeedit']);
    }
    $fornav = 'manage';
?>
<?php

    if(isset($_GET['inactiveid'])){
        
        $inactive_type_id = $_GET['inactiveid'];
        $inactive_type_query = "UPDATE note_types SET IsActive = 0 , ModifiedDate = NOW() , ModifiedBy = ".$_SESSION['ID']." WHERE ID = $inactive_type_id";
        $inactive_type = mysqli_query($connection , $inactive_type_query);
        if($inactive_type){
            $_SESSION['typetdel'] = "yes";
            header("location:managetype.php?admin=1");
        }else{
            $_SESSION['typetdel'] = "no";
            header("location:managetype.php?admin=1");
        }
        
    }

?>

        <?php include 'includes/header.php'; ?>

        <div class="content-box-lg">

            <div class="container">
                <div class="row no-gutters margin-upper">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-left box-heading-wrapper">
                        <p class="box-heading">Manage Type</p>
                    </div>

                    <div class="col-lg-5 col-md-5 col-sm-5 col-12">
                        <button onclick="window.location.href='addtype.php?admin=1'" class="btn btn-general btn-purple add-type-btn">Add Type</button>
                    </div>

                    <div class="col-lg-7 col-md-7 col-sm-7 col-12">

                        <div class="row no-gutters general-search-bar-btn-wrapper">
                            <div class="form-group has-search-bar">
                                <span class="search-symbol"><img src="images/dashboard/search-icon.svg" alt=""></span>
                                <input type="text" class="form-control searchtext input-box-style search-notes-bar" id="example" placeholder="Search">
                            </div>
    
                            <button class="btn btn-general search1 btn-purple general-search-bar-btn">Search</button>
                        </div>

                    </div>
                </div>
            </div>    
            
            <div class="container">

                <div class="manage-type-table general-table-responsive">
                    <div class="table-responsive-xl">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">sr no.</th>
                                    <th scope="col">Type</th>
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
                                $fetch_types_query = "SELECT ID,Name,Description,CreatedDate,CreatedBy,IsActive FROM note_types";
                                $fetch_types = mysqli_query($connection,$fetch_types_query);
                                $i=1;

                                while ($type_row = mysqli_fetch_array($fetch_types)) {  
                                $typeid = $type_row['ID'];
                                    
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $i; ?></td>
                                    <td><?php echo $type_row['Name']; ?></td>
                                    <td><?php echo $type_row['Description']; ?></td>
                                    <td><?php echo $type_row['CreatedDate']; ?></td>
                                    <td>
                                    <?php 
                                    
                                        $fetch_name_query = "SELECT FirstName , LastName FROM users WHERE ID = ".$type_row['CreatedBy'];
                                        $fetch_name = mysqli_query($connection , $fetch_name_query);
                                        $name = mysqli_fetch_assoc($fetch_name);
                                        echo $name['FirstName']." ".$name['LastName'];
                                    
                                    ?>
                                    </td>
                                    <td class="text-center"><?php if($type_row['IsActive'] == 1){ echo "yes"; }else{ echo "no"; } ?></td>
                                    <td class="text-center">
                                        <img class="edit-img-in-table" onclick="window.location.href='addtype.php?admin=1&editid=<?php echo $typeid; ?>'" src="images/dashboard/edit.png" alt="edit">
                                        <img class="delete-img-in-table" onclick="inactivetype('<?php echo $typeid; ?>')" src="images/dashboard/delete.png" alt="edit">
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
    
        function inactivetype(typeid){
            var approvecheck = confirm("Are you sure you want to make this type inactive?");
            if(approvecheck == true){
                location.replace("managetype.php?admin=1&inactiveid="+typeid);
            }else{
                
            }
        }
    
    </script>
    </body>

</html>