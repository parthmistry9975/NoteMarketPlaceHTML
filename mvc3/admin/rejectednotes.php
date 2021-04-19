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
   
    <section class="members-table rejected-table">
        <div class="container table1">
            <div class="row">
                <div class="data-table-intro col-md-12 col-sm-12 col-xs-12">Rejected Notes</div>
                <div class="form-row search-download-part col-md-12 col-sm-12 col-xs-12 text-left">
                    <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <label for="note">Seller</label>
                        <select id="note" class="form-control">
                            <option value="">Select seller</option>
                            <?php
                                $fetch_sellername_query = "SELECT DISTINCT(users.ID) , users.FirstName AS firstname, users.LastName AS lastname FROM seller_notes INNER JOIN users ON users.ID = seller_notes.SellerID  WHERE seller_notes.Status = 10";
                                $fetch_sellername = mysqli_query($connection , $fetch_sellername_query);
                                while($row = mysqli_fetch_assoc($fetch_sellername)){
                                    echo "<option value='".$row['firstname']." ".$row['lastname']."'>".$row['firstname']." ".$row['lastname']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12 text-right">
                        <label for="search">&nbsp;</label>
                        <input type="text" class="form-control search-input searchtext" id="search" placeholder="&#x1F50D; Search">
                        <input type="button" value="Search" id="button" class="form-control search1 btn search-download-btn">
                    </div>
                </div>
            </div>
            <div class="row table-responsive table-data">
                <table class="table table-responsive">
                    <thead>
                        <tr class="table-heading text-center">
                            <th class="rsrno" scope="col">SR NO.</th>
                            <th class="rnotetitle" scope="col">NOTE TITLE</th>
                            <th class="rcategory" scope="col">CATEGORY</th>
                            <th class="rseller" scope="col">SELLER</th>
                            <th class="reye" scope="col"></th>
                            <th class="rdateadded" scope="col">DATE ADDED</th>
                            <th class="rrejectedby" scope="col">REJECTED BY</th>
                            <th class="rremark" scope="col">REMARK</th>
                            <th class="rdropdown" scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  
                        
                            $loginid = $_SESSION['ID'];
                            $fetch_rejected_query = "SELECT seller_notes.Title AS notetitle, seller_notes.ID AS noteid, note_categories.Name AS notecategory, users.FirstName AS firstname, users.LastName AS lastname, seller_notes.SellerID AS seller, seller_notes.ModifiedDate AS dateedited, seller_notes.ActionedBy AS rejectedby, seller_notes.AdminRemarks AS remark FROM seller_notes INNER JOIN users ON users.ID = seller_notes.SellerID INNER JOIN note_categories ON note_categories.ID = seller_notes.Category WHERE seller_notes.Status = 10";
                            $fetch_rejected = mysqli_query($connection , $fetch_rejected_query);
                            $i=1;
                            
                            while($row = mysqli_fetch_assoc($fetch_rejected)){
                            $noteid = $row['noteid'];
                            $seller = $row['seller'];
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td class="purple-color" onclick="window.location.href='adminnotedetail.php?admin=1&noteid=<?php echo $noteid;?>'"><?php echo $row['notetitle']; ?></td>
                            <td><?php echo $row['notecategory']; ?></td>
                            <td><?php echo $row['firstname']." ".$row['lastname']; ?></td>
                            <td><img src="images/dashboard/eye.png" onclick="window.location.href='memberdetails.php?admin=1&memberid=<?php echo $seller; ?>'" alt="view"></td>
                            <td><?php echo $row['dateedited']; ?></td>
                            <td>
                                <?php
                                    $admin = $row['rejectedby'];
                                    $fetch_admin_query = "SELECT * FROM users WHERE ID = $admin";
                                    $fetch_admin = mysqli_query($connection , $fetch_admin_query);
                                    $admin_info = mysqli_fetch_assoc($fetch_admin);
                                    echo $admin_info['FirstName']." ".$admin_info['LastName'];
                                ?>
                            </td>
                            <td><?php echo $row['remark']; ?></td>
                            <td class="dropdown text-left">
                                <img class="dropdown-toggle" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="images/mydownloads/dots.png" alt="menu">
                                <div class="dropdown-menu" aria-labelledby="dLabel">
                                    <a class="dropdown-item" onclick="return confirm('If you approve the notes – System will publish the notes over portal. Please press yes to continue.')" href="approvenote.php?noteid=<?php echo $noteid; ?>">Approve</a>
                                    <a class="dropdown-item" href="download.php?noteid=<?php echo $noteid; ?>">Download Notes</a>
                                    <a class="dropdown-item" href="adminnotedetail.php?admin=1&noteid=<?php echo $noteid;?>">View More Details</a>
                                </div>    
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
    </section>
    
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
            
            $('select').change(function(){
                var y = $(this).val();
                table.columns(3).search(y).draw();
            });

        });
    </script>

</body>
</html>