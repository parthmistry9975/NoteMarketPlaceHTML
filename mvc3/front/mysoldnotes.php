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
   
    <section class="soldnote-table">
        <div class="container table1">
            <div class="row">
                <div class="soldnote-table-intro col-md-6">My Sold Notes</div>
                <div class="search-part col-md-6 text-right">
                    <input type="text" id="searchtext1" placeholder="&#x1F50D; Search">
                    <button type="button" class="btn search1 search-btn">Search</button> 
                </div>
            </div>
            <div class="row table-data table-responsive">
                <table class="table table-responsive">
                    <thead>
                        <tr class="table-heading text-center">
                            <th class="srno" scope="col">SR NO.</th>
                            <th class="notetitle" scope="col">NOTE TITLE</th>
                            <th class="downloadcategory" scope="col">CATEGORY</th>
                            <th class="buyer" scope="col">BUYER</th>
                            <th class="downloadselltype" scope="col">SELL TYPE</th>
                            <th class="downloadprice" scope="col">PRICE</th>
                            <th class="date-time" scope="col">DOWNLOAD DATE/TIME</th>
                            <th class="downloadeye" scope="col"></th>
                            <th class="downloadmenu" scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>   
                        <?php
                    
                        $loginid = $_SESSION['ID'];
                        $fetch_progress_query = "SELECT downloads.NoteID AS noteid,downloads.ID AS download_id,downloads.NoteTitle AS note_title, downloads.NoteCategory AS note_category, users.EmailID AS buyer_id , downloads.IsPaid AS sell_type , downloads.PurchasedPrice AS price , downloads.AttachmentDownloadedDate AS download_date FROM downloads INNER JOIN users ON downloads.Downloader = users.ID WHERE downloads.Downloader != $loginid AND IsEmailVerified = 1 AND IsSellerHasAllowedDownload = 1 AND Seller = $loginid GROUP BY downloads.NoteID,downloads.Downloader ORDER BY AttachmentDownloadedDate DESC";
                        $progress_notes = mysqli_query($connection,$fetch_progress_query);
                        $i=1;

                        while ($progress_row = mysqli_fetch_array($progress_notes)) {  

                        ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td class="purple-color" onclick="window.location.href='notedetails.php?noteid=<?php echo $progress_row["noteid"]; ?>'"><?php echo $progress_row["note_title"]; ?></td>
                                <td><?php echo $progress_row["note_category"]; ?></td>
                                <td><?php echo $progress_row["buyer_id"]; ?></td>
                                <td><?php if($progress_row["sell_type"] == 1){ echo "Paid"; }else{ echo "Free"; } ?></td>
                                <td><?php echo $progress_row["price"]; ?></td>
                                <td class="<?php if(empty($progress_row["download_date"])){ echo "text-center";}?>"><?php if(empty($progress_row["download_date"])){ echo "-" ; }else { echo $progress_row["download_date"];} ?></td>
                                <td>
                                <a href="notedetails.php?noteid=<?php echo $progress_row['noteid']; ?>"><img src="images/dashboard/eye.png" alt="view"></a>
                                </td>
                                <td class="dropdown">
                                    <img class="dropdown-toggle" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="images/mydownloads/dots.png" alt="menu">
                                    <div class="dropdown-menu" aria-labelledby="dLabel">
                                        <a class="dropdown-item" href="download.php?noteid=<?php echo $progress_row["noteid"]; ?>">Download Note</a>
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