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
   
    <section class="members-table downloaded-table">
        <div class="container table1">
            <div class="row">
                <div class="data-table-intro col-md-12 col-sm-12 col-xs-12">Downloaded Notes</div>
                <div class="form-row search-download-part col-md-12 col-sm-12 col-xs-12 text-left">
                    <div class="form-group col-lg-2 col-md-2 col-sm-4 col-xs-6">
                        <label for="note">Note</label>
                        <select id="note" class="form-control">
                            <option value="">Select note</option>
                            <?php
                                $fetch_notename_query = "SELECT DISTINCT(downloads.NoteID), downloads.NoteTitle AS notetitle FROM downloads WHERE downloads.IsSellerHasAllowedDownload = 1";
                                $fetch_notename = mysqli_query($connection , $fetch_notename_query);
                                while($row = mysqli_fetch_assoc($fetch_notename)){
                                    echo "<option value='".$row['notetitle']."'>".$row['notetitle']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-4 col-xs-6">
                        <label for="seller">Seller</label>
                        <select id="seller" class="form-control">
                            <option value="">Select seller</option>
                            <?php
                                $fetch_sellername_query = "SELECT DISTINCT(users.ID),users.FirstName AS firstname , users.LastName AS lastname FROM downloads INNER JOIN users ON users.ID = downloads.Seller WHERE downloads.IsSellerHasAllowedDownload = 1";
                                $fetch_sellername = mysqli_query($connection , $fetch_sellername_query);
                                while($row = mysqli_fetch_assoc($fetch_sellername)){
                                    echo "<option value='".$row['firstname']." ".$row['lastname']."'>".$row['firstname']." ".$row['lastname']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-lg-2 col-md-2 col-sm-4 col-xs-6">
                        <label for="buyer">Buyer</label>
                        <select id="buyer" class="form-control">
                            <option value="">Select buyer</option>
                            <?php
                                $fetch_buyername_query = "SELECT DISTINCT(users.ID),users.FirstName AS firstname , users.LastName AS lastname FROM downloads INNER JOIN users ON users.ID = downloads.Downloader WHERE downloads.IsSellerHasAllowedDownload = 1";
                                $fetch_buyername = mysqli_query($connection , $fetch_buyername_query);
                                while($row = mysqli_fetch_assoc($fetch_buyername)){
                                    echo "<option value='".$row['firstname']." ".$row['lastname']."'>".$row['firstname']." ".$row['lastname']."</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12 text-right">
                        <label for="search">&nbsp;</label>
                        <input type="text" class="form-control searchtext search-input" id="search" placeholder="&#x1F50D; Search">
                        <input type="button" value="Search" id="button" class="form-control btn search1 search-download-btn">
                    </div>
                </div>
            </div>
            <div class="row table-responsive table-data">
                <table id="downloaded-table" class="table table-responsive">
                    <thead>
                        <tr class="table-heading text-center">
                            <th class="dsrno" scope="col">SR NO.</th>
                            <th class="dnotetitle" scope="col">NOTE TITLE</th>
                            <th class="dcategory" scope="col">CATEGORY</th>
                            <th class="dbuyer" scope="col">BUYER</th>
                            <th class="reye" scope="col"></th>
                            <th class="dseller" scope="col">SELLER</th>
                            <th class="reye" scope="col"></th>
                            <th class="dselltype" scope="col">SELL TYPE</th>
                            <th class="dprice" scope="col">PRICE</th>
                            <th class="ddate-time" scope="col">DOWNLOADED DATE/TIME</th>
                            <th class="ddropdown" scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  
                        
                            $loginid = $_SESSION['ID'];
                            $fetch_downloads_query = "SELECT downloads.NoteID AS noteid , downloads.Seller AS seller , downloads.Downloader AS downloader , downloads.NoteTitle AS notetitle , downloads.NoteCategory AS notecategory, downloads.AttachmentDownloadedDate AS downloadedtime , downloads.IsPaid AS selltype ,downloads.PurchasedPrice AS noteprice FROM downloads WHERE downloads.IsSellerHasAllowedDownload = 1";
                            if(isset($_GET['memberid'])){
                                
                                $memberid = $_GET['memberid'];
                                $fetch_downloads_query .= " AND downloads.Downloader = $memberid";
                                
                            }
                            if(isset($_GET['noteid'])){
                                
                                $membernoteid = $_GET['noteid'];
                                $fetch_downloads_query .= " AND downloads.NoteID = $membernoteid";
                                
                            }
                            $fetch_downloads_query .= " GROUP BY downloads.NoteID,downloads.Downloader";
                            $fetch_downloads = mysqli_query($connection , $fetch_downloads_query);
                            $i=1;
                            
                            while($row = mysqli_fetch_assoc($fetch_downloads)){
                            $noteid = $row['noteid'];
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td class="purple-color" onclick="window.location.href='adminnotedetail.php?admin=1&noteid=<?php echo $noteid;?>'"><?php echo $row['notetitle']; ?></td>
                            <td><?php echo $row['notecategory']; ?></td>
                            <td><?php
                                $buyer =  $row['downloader']; 
                                $fetch_buyer_query = "SELECT * FROM users WHERE ID = $buyer";
                                $fetch_buyer = mysqli_query($connection , $fetch_buyer_query);
                                $buyer_info = mysqli_fetch_assoc($fetch_buyer);
                                echo $buyer_info['FirstName']." ".$buyer_info['LastName'];
                                ?>
                            </td>
                            <td><img src="images/dashboard/eye.png" onclick="window.location.href='memberdetails.php?admin=1&memberid=<?php echo $buyer; ?>'" alt="view"></td>
                            <td><?php
                                $seller =  $row['seller']; 
                                $fetch_seller_query = "SELECT * FROM users WHERE ID = $seller";
                                $fetch_seller = mysqli_query($connection , $fetch_seller_query);
                                $seller_info = mysqli_fetch_assoc($fetch_seller);
                                echo $seller_info['FirstName']." ".$seller_info['LastName'];
                                ?>
                            </td>
                            <td><img src="images/dashboard/eye.png" onclick="window.location.href='memberdetails.php?admin=1&memberid=<?php echo $seller; ?>'" alt="view"></td>
                            <td><?php if( $row['selltype'] == 1 ){ echo "PAID"; }else{ echo "FREE"; } ?></td>
                            <td><?php echo $row['noteprice'];  ?></td>
                            <td><?php if(empty($row['downloadedtime'])){ echo "-"; }else{ echo $row['downloadedtime']; }?></td>
                            <td class="dropdown">
                                <img class="dropdown-toggle" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="images/mydownloads/dots.png" alt="menu">
                                <div class="dropdown-menu" aria-labelledby="dLabel">
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
            
            $('#note').change(function(){
                var y = $(this).val();
//                alert(y);
                table.columns(1).search(y).draw();
            });
            $('#seller').change(function(){
                var y = $(this).val();
//                alert(y);
                table.columns(5).search(y).draw();
            });
            $('#buyer').change(function(){
                var y = $(this).val();
//                alert(y);
                table.columns(3).search(y).draw();
            });
            
            


        });
    </script>

</body>
</html>