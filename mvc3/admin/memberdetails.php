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
    if(!isset($_GET['memberid'])){
        header("location:admindashboard.php?admin=1");
    }
?>
<?php
    
    $memberid = $_GET['memberid'];
    $fetch_information_query = "SELECT * FROM user_profile WHERE UserID = $memberid";
    $fetch_information = mysqli_query($connection , $fetch_information_query);
    $information = mysqli_fetch_assoc($fetch_information);
    
    $fetch_name_query = "SELECT * FROM users WHERE ID = $memberid";
    $fetch_name = mysqli_query($connection , $fetch_name_query);
    $names = mysqli_fetch_assoc($fetch_name);

?>

    <?php include 'includes/header.php'; ?>
    
    <section class="member-details">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="member-details-heading">
                        <h2 class="member-heading-h2">Member Details</h2>
                    </div>
                </div>
                <div class="col-md-2 col-sm-12 member-info text-center">
                    <div class="member-image">
                        <?php
                            if(isset($information['ProfilePicture'])){
                                $profilepicpath = $information['ProfilePicture'];
                            }else{
                                $profilepicpath = "../front/images/default/profile/dp.jpg";
                            }
                        ?>
                        <img src="<?php echo $profilepicpath; ?>" alt="member">
                    </div>
                </div>
                <div class="info-table col-md-4 col-sm-6">
                    <table class="table table-responsive table-borderless left-table">
                        <tr>
                            <td>First Name:</td>
                            <td class="purple-member-details"><?php echo $names['FirstName']; ?></td>
                        </tr>
                        <tr>
                            <td>Last Name:</td>
                            <td class="purple-member-details"><?php echo $names['LastName']; ?></td>
                        </tr>
                        <tr>
                            <td>Email:</td>
                            <td class="purple-member-details"><?php echo $names['EmailID']; ?></td>
                        </tr>
                        <tr>
                            <td>DOB:</td>
                            <td class="purple-member-details"><?php if(isset($information['DOB'])){ echo  $information['DOB']; }else{ echo "-"; } ?></td>
                        </tr>
                        <tr>
                            <td>Phone Number:</td>
                            <td class="purple-member-details"><?php if(isset($information['PhoneNumber'])){ echo $information['CountryCode'].$information['PhoneNumber']; }else{ echo "-";} ?></td>
                        </tr>
                        <tr>
                            <td>College/University:</td>
                            <td class="purple-member-details"><?php if(isset($information['University'])){ echo $information['University'];}else{ echo "-";}  ?></td>
                        </tr>
                    </table>
                </div>
                <div class="info-table col-md-4 col-sm-6">
                    <table class="table table-responsive right-table table-borderless">
                        <tr>
                            <td>Address 1:</td>
                            <td class="purple-member-details"><?php if(isset($information['AddressLine1'])){ echo $information['AddressLine1'];}else{ echo "-"; } ?></td>
                        </tr>
                        <tr>
                            <td>Address 2:</td>
                            <td class="purple-member-details"><?php if(isset($information['AddressLine2'])){ echo $information['AddressLine2']; }else{ echo "-"; } ?></td>
                        </tr>
                        <tr>
                            <td>City:</td>
                            <td class="purple-member-details"><?php if(isset($information['City'])){ echo $information['City']; }else{ echo "-";} ?></td>
                        </tr>
                        <tr>
                            <td>State:</td>
                            <td class="purple-member-details"><?php if(isset($information['State'])){ echo $information['State']; }else{ echo "-";} ?></td>
                        </tr>
                        <tr>
                            <td>Country:</td>
                            <td class="purple-member-details"><?php if(isset($information['Country'])){ echo $information['Country']; }else{ echo "-";} ?></td>
                        </tr>
                        <tr>
                            <td>Zipcode:</td>
                            <td class="purple-member-details"><?php if(isset($information['ZipCode'])){ echo $information['ZipCode']; }else{ echo "-";} ?></td>
                        </tr>
                    </table>
                </div>
                <div class="col-md-2"></div>
                <div class="col-md-12">
                    <hr>
                </div>
            </div>
        </div>
    </section>
    
    <section class="members-table members-details-table">
        <div class="container table1">
            <div class="row">
                <div class="col-md-12 member-notes-table-heading">
                    <h2 class="member-heading-h2">Notes</h2>
                </div>
            </div>
            <div class="row table-data">
                <table id="memberdetail-notes-table" class="table table-responsive">
                    <thead>
                        <tr class="table-heading text-center">
                            <th class="mnsrno" scope="col">SR NO.</th>
                            <th class="mnnotetitle" scope="col">NOTE TITLE</th>
                            <th class="mncategory" scope="col">CATEGORY</th>
                            <th class="mnstatus" scope="col">STATUS</th>
                            <th class="mndownloadednotes" scope="col">DOWNLOADED NOTES</th>
                            <th class="mntotalearnings" scope="col">TOTAL EARNINGS</th>
                            <th class="mndateadded" scope="col">DATE ADDED</th>
                            <th class="mnpublisheddate" scope="col">PUBLISHED DATE</th>
                            <th class="mndropdown" scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php  
                    
                        $loginid = $_SESSION['ID'];
                        $fetch_notes_query = "SELECT seller_notes.ID AS noteid, seller_notes.Title AS notetitle,seller_notes.CreatedDate AS dateadded , seller_notes.PublishedDate AS publishdate , note_categories.Name AS notecategory,reference_data.Value AS notestatus FROM seller_notes INNER JOIN note_categories ON note_categories.ID = seller_notes.Category INNER JOIN reference_data on reference_data.ID = seller_notes.Status WHERE SellerID = $memberid AND seller_notes.IsActive = 1 AND seller_notes.Status IN (7,8,9,10) ORDER BY seller_notes.CreatedDate DESC";
                        $fetch_notes = mysqli_query($connection,$fetch_notes_query);
                        $i=1;

                        while ($notes = mysqli_fetch_array($fetch_notes)) {  
                            $noteid = $notes['noteid'];
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td class="purple-color" onclick="window.location.href='adminnotedetail.php?admin=1&noteid=<?php echo $noteid;?>'"><?php echo $notes['notetitle']; ?></td>
                            <td><?php echo $notes['notecategory']; ?></td>
                            <td><?php echo $notes['notestatus']; ?></td>
                            <td class="purple-color" onclick="window.location.href='downloadednotes.php?admin=1&noteid=<?php echo $noteid;?>'">
                                <?php
                            
                                    $fetch_download_count_query = "SELECT DISTINCT(Downloader) FROM downloads WHERE NoteID = $noteid";
                                    $fetch_download_count = mysqli_query($connection , $fetch_download_count_query);
                                    $download_count = mysqli_num_rows($fetch_download_count);
                                    echo $download_count;
                            
                                ?>
                            </td>
                            <td>
                                <?php
                            
                                    $fetch_earning_query = "SELECT DISTINCT(Downloader), PurchasedPrice FROM downloads WHERE NoteID = $noteid";
                                    $fetch_earning = mysqli_query($connection , $fetch_earning_query);
                                    $notetotalearning = 0 ;
                                    while($earning = mysqli_fetch_assoc($fetch_earning)){
                                        $notetotalearning += $earning['PurchasedPrice'];
                                    }
                                    echo $notetotalearning;
                            
                                ?>
                            </td>
                            <td><?php echo $notes['dateadded']; ?></td>
                            <td><?php if(empty($notes['publishdate'])){ echo "NA";}else{ echo $notes['publishdate']; }; ?></td>
                            <td class="dropdown">
                                <img class="dropdown-toggle" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="images/mydownloads/dots.png" alt="menu">
                                <div class="dropdown-menu" aria-labelledby="dLabel">
                                    <a class="dropdown-item" href="download.php?noteid=<?php echo $noteid; ?>">Download Notes</a>
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
            var table1 = $('#memberdetail-notes-table').DataTable({
                'sDom': '"top"i',
                'bInfo': true,
                "iDisplayLength": 5,
                language: {
                    paginate: {
                        next: '<img src="images/dashboard/right-arrow.png">',
                        previous: '<img src="images/dashboard/left-arrow.png">'
                    }
                }
            });

        });
    </script>


</body>
</html>