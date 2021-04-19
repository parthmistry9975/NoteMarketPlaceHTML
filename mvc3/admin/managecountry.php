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
    if(isset($_SESSION['countrytdel']) and $_SESSION['countrytdel'] == 'yes'){
        $_SESSION['status'] = "country Inactivated !!";
        $_SESSION['status_code'] = "success";
        unset($_SESSION['countrytdel']);
    }
    if(isset($_SESSION['countrytdel']) and $_SESSION['countrytdel'] == 'no'){
        $_SESSION['status'] = "country isn't Inactivated !!";
        $_SESSION['status_code'] = "error";
        unset($_SESSION['countrytdel']);
    }
    if(isset($_SESSION['countryadd']) and $_SESSION['countryadd'] == 'yes'){
        $_SESSION['status'] = "country Added !!";
        $_SESSION['status_code'] = "success";
        unset($_SESSION['countryadd']);
    }
    if(isset($_SESSION['countryadd']) and $_SESSION['countryadd'] == 'no'){
        $_SESSION['status'] = "country isn't Added !!";
        $_SESSION['status_code'] = "error";
        unset($_SESSION['countryadd']);
    }
    if(isset($_SESSION['countryedit']) and $_SESSION['countryedit'] == 'yes'){
        $_SESSION['status'] = "country Updated !!";
        $_SESSION['status_code'] = "success";
        unset($_SESSION['countryedit']);
    }
    if(isset($_SESSION['countryedit']) and $_SESSION['countryedit'] == 'no'){
        $_SESSION['status'] = "country isn't Updated !!";
        $_SESSION['status_code'] = "error";
        unset($_SESSION['countryedit']);
    }
    $fornav = 'manage';
?>
<?php

    if(isset($_GET['inactiveid'])){
        
        $inactive_country_id = $_GET['inactiveid'];
        $inactive_country_query = "UPDATE countries SET IsActive = 0 , ModifiedDate = NOW() , ModifiedBy = ".$_SESSION['ID']." WHERE ID = $inactive_country_id";
        $inactive_country = mysqli_query($connection , $inactive_country_query);
        if($inactive_country){
            $_SESSION['countrytdel'] = "yes";
            header("location:managecountry.php?admin=1");
        }else{
            $_SESSION['countrytdel'] = "no";
            header("location:managecountry.php?admin=1");
        }
        
    }

?>

        <?php include 'includes/header.php'; ?>

        <div class="content-box-lg">

            <div class="container">
                <div class="row no-gutters margin-upper">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-12 text-left box-heading-wrapper">
                        <p class="box-heading">Manage Country</p>
                    </div>

                    <div class="col-lg-5 col-md-5 col-sm-5 col-12">
                        <button onclick="window.location.href='addcountry.php?admin=1'" class="btn btn-general btn-purple add-country-btn">Add Country</button>
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

                <div class="manage-country-table general-table-responsive">
                    <div class="table-responsive-xl">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">sr no.</th>
                                    <th scope="col">Country Name</th>
                                    <th scope="col">Country Code</th>
                                    <th scope="col">Date Added</th>
                                    <th scope="col">Added By</th>
                                    <th scope="col" class="text-center">Active</th>
                                    <th scope="col" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            
                                <?php  
                    
                                $loginid = $_SESSION['ID'];
                                $fetch_countries_query = "SELECT ID,Name,CountryCode,CreatedDate,CreatedBy,IsActive FROM countries";
                                $fetch_countries = mysqli_query($connection,$fetch_countries_query);
                                $i=1;

                                while ($country_row = mysqli_fetch_array($fetch_countries)) {  
                                $countryid = $country_row['ID'];
                                    
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $i; ?></td>
                                    <td><?php echo $country_row['Name']; ?></td>
                                    <td><?php echo $country_row['CountryCode']; ?></td>
                                    <td><?php echo $country_row['CreatedDate']; ?></td>
                                    <td>
                                        <?php 
                                    
                                        $fetch_name_query = "SELECT FirstName , LastName FROM users WHERE ID = ".$country_row['CreatedBy'];
                                        $fetch_name = mysqli_query($connection , $fetch_name_query);
                                        $name = mysqli_fetch_assoc($fetch_name);
                                        echo $name['FirstName']." ".$name['LastName'];
                                    
                                        ?>
                                    </td>
                                    <td class="text-center"><?php if($country_row['IsActive'] == 1){ echo "Yes"; }else{ echo "No"; } ?></td>
                                    <td class="text-center">
                                        <img class="edit-img-in-table" onclick="window.location.href='addcountry.php?admin=1&editid=<?php echo $countryid; ?>'" src="images/dashboard/edit.png" alt="edit">
                                        <img class="delete-img-in-table" onclick="inactivecountry('<?php echo $countryid; ?>')" src="images/dashboard/delete.png" alt="edit">
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
    
        function inactivecountry(countryid){
            var approvecheck = confirm("Are you sure you want to make this country inactive?");
            if(approvecheck == true){
                location.replace("managecountry.php?admin=1&inactiveid="+countryid);
            }else{
                
            }
        }
    
    </script>
    </body>

</html>