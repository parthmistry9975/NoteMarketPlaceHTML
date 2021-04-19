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
    if(isset($_SESSION['admintdel']) and $_SESSION['admintdel'] == 'yes'){
        $_SESSION['status'] = "admin Inactivated !!";
        $_SESSION['status_code'] = "success";
        unset($_SESSION['admintdel']);
    }
    if(isset($_SESSION['admintdel']) and $_SESSION['admintdel'] == 'no'){
        $_SESSION['status'] = "admin isn't Inactivated !!";
        $_SESSION['status_code'] = "error";
        unset($_SESSION['admintdel']);
    }
    if(isset($_SESSION['adminadd']) and $_SESSION['adminadd'] == 'yes'){
        $_SESSION['status'] = "admin Added !!";
        $_SESSION['status_code'] = "success";
        unset($_SESSION['adminadd']);
    }
    if(isset($_SESSION['adminadd']) and $_SESSION['adminadd'] == 'no'){
        $_SESSION['status'] = "admin isn't Added !!";
        $_SESSION['status_code'] = "error";
        unset($_SESSION['adminadd']);
    }
    if(isset($_SESSION['adminedit']) and $_SESSION['adminedit'] == 'yes'){
        $_SESSION['status'] = "admin Updated !!";
        $_SESSION['status_code'] = "success";
        unset($_SESSION['adminedit']);
    }
    if(isset($_SESSION['adminedit']) and $_SESSION['adminedit'] == 'no'){
        $_SESSION['status'] = "admin isn't Updated !!";
        $_SESSION['status_code'] = "error";
        unset($_SESSION['adminedit']);
    }
    $fornav = 'manage';
?>
<?php

    if(isset($_GET['inactiveid'])){
        
        $inactive_Admin_id = $_GET['inactiveid'];
        $inactive_admin_query = "UPDATE users SET IsActive = 0 , ModifiedDate = NOW() , ModifiedBy = ".$_SESSION['ID']." WHERE ID = $inactive_Admin_id";
        $inactive_admin = mysqli_query($connection , $inactive_admin_query);
        if($inactive_admin){
            $_SESSION['admintdel'] = "yes";
            header("location:manageadministrator.php?admin=1");
        }else{
            $_SESSION['admintdel'] = "no";
            header("location:manageadministrator.php?admin=1");
        }
        
    }

?>

        <?php include 'includes/header.php'; ?>

        <div class="content-box-lg content-box-lg-manage">

            <div class="container">
                <div class="row no-gutters margin-upper">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-left box-heading-wrapper">
                        <p class="box-heading">Manage Administrator</p>
                    </div>

                    <div class="col-lg-5 col-md-5 col-sm-5 col-12">
                        <button onclick="window.location.href='addadministrator.php?admin=1'" class="btn btn-general btn-purple add-administrator-btn">Add Administrator</button>
                    </div>

                    <div class="col-lg-7 col-md-7 col-sm-7 col-12">

                        <div class="row no-gutters general-search-bar-btn-wrapper">
                            <div class="form-group has-search-bar">
                                <span class="search-symbol"><img src="images/dashboard/search-icon.svg" alt=""></span>
                                <input type="text" class="form-control input-box-style search-notes-bar searchtext" placeholder="Search">
                            </div>
    
                            <button class="btn btn-general search1 btn-purple general-search-bar-btn">Search</button>
                        </div>

                    </div>
                </div>
            </div>    
            
            <div class="container">

                <div class="manage-administrator-table general-table-responsive">
                    <div class="table-responsive-xl">

                        <table id="manageadministrator-tab" class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">sr no.</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Last Name</th>
                                    <th scope="col">email</th>
                                    <th scope="col">Phone no.</th>
                                    <th scope="col">Date Added</th>
                                    <th scope="col">Active</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php  
                    
                                $loginid = $_SESSION['ID'];
                                $fetch_admins_query = "SELECT ID, FirstName,LastName,EmailID,CreatedDate,IsActive FROM users WHERE RoleID = 2";
                                $fetch_admins = mysqli_query($connection,$fetch_admins_query);
                                $i=1;

                                while ($admin_row = mysqli_fetch_array($fetch_admins)) {  
                                $adminid = $admin_row['ID'];
                                ?>
                                

                                <tr>
                                    <td class="text-center"><?php echo $i; ?></td>
                                    <td><?php echo $admin_row['FirstName']; ?></td>
                                    <td><?php echo $admin_row['LastName']; ?></td>
                                    <td><?php echo $admin_row['EmailID']; ?></td>
                                    <td>
                                        <?php
                                    
                                            $fetch_adminprofile_query = "SELECT CountryCode,PhoneNumber FROM user_profile WHERE UserID = $adminid";
                                            $fetch_adminprofile = mysqli_query($connection , $fetch_adminprofile_query);
                                            $adminprofile = mysqli_fetch_assoc($fetch_adminprofile);
                                            if( empty($adminprofile['CountryCode']) && empty($adminprofile['PhoneNumber'])){
                                                echo "NA";
                                            }else{
                                                echo $adminprofile['CountryCode'].$adminprofile['PhoneNumber'];
                                            }
                                    
                                        ?>
                                    </td>
                                    <td><?php echo $admin_row['CreatedDate']; ?></td>
                                    <td class="text-center">
                                    <?php
                                        if($admin_row['IsActive'] == 1){
                                            echo "YES"; 
                                        }else{
                                            echo "NO";
                                        } 
                                    ?>
                                    </td>
                                    <td class="text-center">
                                        <img class="edit-img-in-table" onclick="window.location.href='addadministrator.php?admin=1&editid=<?php echo $adminid; ?>'" src="images/dashboard/edit.png" alt="edit">
                                        <img class="delete-img-in-table" onclick="inactiveadmin('<?php echo $adminid; ?>')" src="images/dashboard/delete.png" alt="edit">
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
    
        function inactiveadmin(adminid){
            var approvecheck = confirm("Are you sure you want to make this administrator inactive?");
            if(approvecheck == true){
                location.replace("manageadministrator.php?admin=1&inactiveid="+adminid);
            }else{
                
            }
        }
    
    </script>
    
    </body>
</html>