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
    if(isset($_SESSION['reportdel']) and $_SESSION['reportdel'] == 'yes'){
        $_SESSION['status'] = "Report deleted !!";
        $_SESSION['status_code'] = "success";
        unset($_SESSION['reportdel']);
    }
    if(isset($_SESSION['reportdel']) and $_SESSION['reportdel'] == 'no'){
        $_SESSION['status'] = "Report isn't deleted !!";
        $_SESSION['status_code'] = "error";
        unset($_SESSION['reportdel']);
    }
    $fornav = 'manage';
?>
<?php

    if(isset($_GET['removeid'])){
        
        $report_remove_id = $_GET['removeid'];
        $remove_report_query = "DELETE FROM seller_notes_reported_issues WHERE ID = $report_remove_id";
        $remove_report = mysqli_query($connection , $remove_report_query);
        if($remove_report){
            $_SESSION['reportdel'] = "yes";
            header("location:spam-reports.php?admin=1");
        }else{
            $_SESSION['reportdel'] = "no";
            header("location:spam-reports.php?admin=1");
        }
        
    }

?>

           <?php include 'includes/header.php'; ?>
           
            <div class="content-box-lg">

            <div class="container">
                <div class="row no-gutters margin-upper">
                    <div class="col-lg-6 col-md-6 col-sm-5 col-12 text-left box-heading-wrapper">
                        <p class="box-heading">Spam Reports</p>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-7 col-12">

                        <div class="row no-gutters text-right general-search-bar-btn-wrapper">
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

                <div class="spam-reports-table general-table-responsive">
                    <div class="table-responsive-xl">

                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">sr no.</th>
                                    <th scope="col">Reported by</th>
                                    <th scope="col">Note title</th>
                                    <th scope="col">Category</th>
                                    <th scope="col">Date Edited</th>
                                    <th scope="col">Remark</th>
                                    <th scope="col" class="text-center">Action</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php  
                    
                                $loginid = $_SESSION['ID'];
                                $fetch_spam_notes_query = "SELECT seller_notes_reported_issues.ID AS reportid , seller_notes_reported_issues.NoteID AS noteid , users.FirstName AS firstname , users.LastName AS lastname , seller_notes.Title AS notetitle , seller_notes.Category AS notecategory , seller_notes_reported_issues.CreatedDate AS datedited , seller_notes_reported_issues.Remarks AS remark FROM seller_notes_reported_issues INNER JOIN users ON users.ID = seller_notes_reported_issues.ReportedBYID INNER JOIN seller_notes ON seller_notes.ID = seller_notes_reported_issues.NoteID";
                                $fetch_spam_notes = mysqli_query($connection,$fetch_spam_notes_query);
                                $i=1;

                                while ($spam_note = mysqli_fetch_array($fetch_spam_notes)) {  
                                $noteid = $spam_note['noteid'];
                                $reportid = $spam_note['reportid'];
                                ?>
                                <tr>
                                    <td class="text-center"><?php echo $i; ?></td>
                                    <td><?php echo $spam_note['firstname']." ".$spam_note['lastname']; ?></td>
                                    <td class="purple-td"><?php echo $spam_note['notetitle']; ?></td>
                                    <td>
                                        <?php
                                    
                                            $fetch_category_query = "SELECT Name FROM note_categories WHERE ID = ".$spam_note['notecategory'];
                                            $fetch_category = mysqli_query($connection , $fetch_category_query);
                                            $category = mysqli_fetch_assoc($fetch_category);
                                            echo $category['Name'];
                                        
                                        ?>
                                    </td>
                                    <td><?php echo $spam_note['datedited']; ?></td>
                                    <td><?php echo $spam_note['remark']; ?></td>
                                    <td class="text-center">
                                        <img class="delete-img-in-table" onclick="removereport('<?php echo $reportid; ?>')" src="images/dashboard/delete.png" alt="edit">
                                    </td>
                                    <td class="text-center visible-overflow-for-dropdown">
                                        <div class="dropdown dropdown-dots-table">
                                            <a href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false">
                                                <img class="dots-in-table" src="images/mydownloads/dots.png" alt="edit">
                                            </a>
                                    
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                                <a class="dropdown-item" href="download.php?noteid=<?php echo $noteid; ?>">Download Note</a>
                                                <a class="dropdown-item" href="adminnotedetail.php?admin=1&noteid=<?php echo $noteid;?>">View More Details</a>
                                            </div>
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
    
        function removereport(reportid){
            var approvecheck = confirm("Are you sure you want to delete reported issue?");
            if(approvecheck == true){
//                alert(reportid);
                location.replace("spam-reports.php?admin=1&removeid="+reportid);
            }else{
                
            }
        }
    
    </script>
    </body>
</html>