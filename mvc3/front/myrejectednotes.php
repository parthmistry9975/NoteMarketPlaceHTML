<?php ob_start(); ?>
<?php include 'includes/db.php'; ?>
<?php  

    session_start();
    if(!isset($_SESSION['ID'])){
        header("location:login.php");
    }
    if($_SESSION['ROLE'] != 3){
        header("location:../admin/admindashboard.php?admin=1");
    }
?>
    
    <?php include 'includes/header.php'; ?>
   
    <section class="rejectnote-table">
        <div class="container table1">
            <div class="row">
                <div class="rejectnote-table-intro col-md-6">My Rejected Notes</div>
                <div class="search-part col-md-6 text-right">
                    <input type="text" id="searchtext1" placeholder="&#x1F50D; Search">
                    <button type="button" class="btn search1 search-btn">Search</button> 
                </div>
            </div>
            <div class="row table-data table-responsive">
                <table class="table">
                    <thead>
                        <tr class="table-heading text-center">
                            <th class="rejectedsrno" scope="col">SR NO.</th>
                            <th class="rejectednotetitle" scope="col">NOTE TITLE</th>
                            <th class="rejectedcategory" scope="col">CATEGORY</th>
                            <th class="remarks" scope="col">REMARKS</th>
                            <th class="clone" scope="col">CLONE</th>
                            <th class="rejectmenu" scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  
                    
                        $loginid = $_SESSION['ID'];
                        $fetch_progress_query = "SELECT seller_notes.ID AS noteid , seller_notes.Status , seller_notes.Title AS title , note_categories.Name AS category , seller_notes.AdminRemarks FROM seller_notes INNER JOIN note_categories ON seller_notes.Category = note_categories.ID WHERE seller_notes.SellerID = $loginid AND seller_notes.Status = 10";
                        $progress_notes = mysqli_query($connection,$fetch_progress_query);
                        $i=1;

                        while ($progress_row = mysqli_fetch_array($progress_notes)) {  
                        ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td class="purple-color" onclick="window.location.href='notedetails.php?noteid=<?php echo $progress_row["noteid"]; ?>'"><?php echo $progress_row["title"]; ?></td>
                                <td><?php echo $progress_row["category"]; ?></td>
                                <td><?php echo $progress_row["AdminRemarks"]; ?></td>
                                <td class="purple-color">Clone</td>
                                <td class="dropdown">
                                    <img class="dropdown-toggle" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="images/mydownloads/dots.png" alt="menu">
                                    <div class="dropdown-menu" aria-labelledby="dLabel">
                                        <a class="dropdown-item" href="download.php?noteid=<?php echo $progress_row["noteid"]; ?>">Download Note</a>
                                    </div>
                                </td>
                            </tr>
                        <?php  
                        };  
                        ?>
                       
<!--
                        <tr>
                            <td>1</td>
                            <td class="purple-color">Data Science</td>
                            <td>Science</td>
                            <td>Lorem ipsum dolor sit amet consectetur adipi.</td>
                            <td class="purple-color">Clone</td>
                            <td class="dropdown">
                                <img class="dropdown-toggle" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="images/mydownloads/dots.png" alt="menu">
                                <div class="dropdown-menu" aria-labelledby="dLabel">
                                    <a class="dropdown-item" href="#">Download Note</a>
                                </div>

                            </td>
                        </tr>
-->
                        
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
                "iDisplayLength": 10,
                language: {
                    paginate: {
                        next: '<img src="images/dashboard/right-arrow.png">',
                        previous: '<img src="images/dashboard/left-arrow.png">'
                    }
                }
            });

            $('.search1').click(function() {
                var x = $('#searchtext1').val();
                table.search(x).draw();

            });

        });
    </script>

</body>
</html>