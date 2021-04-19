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
    if(isset($_SESSION['deactivatemember']) and $_SESSION['deactivatemember'] == 'yes'){
        $_SESSION['status'] = "member deactivated !!";
        $_SESSION['status_code'] = "success";
        unset($_SESSION['deactivatemember']);
    }
    if(isset($_SESSION['deactivatemember']) and $_SESSION['deactivatemember'] == 'no'){
        $_SESSION['status'] = "member isn't deactivated !!";
        $_SESSION['status_code'] = "error";
        unset($_SESSION['deactivatemember']);
    }
?>
   
    <?php include 'includes/header.php'; ?>
   
    <section class="members-table">
        <div class="container table1">
            <div class="row">
                <div class="data-table-intro col-md-12 col-sm-12">Members</div>
                <div class="search-part col-md-12 col-sm-12 col-xs-12 text-right">
                    <input type="text" id="searchtext1" placeholder="&#x1F50D; Search">
                    <button type="button" class="btn search1 search-btn">Search</button>
                    <select id="member-month-filter" class="month-filter">
                        <?php                                    
                                    $currentMonthName = date('F');
                                    // $currentMonthValue = date('n');
                                    for ($i = 0; $i < 6; $i++) {
                                        $MonthName = date("F", strtotime(date('Y-m-01')." -$i months"));
                                        $MonthValue = date("-m-Y", strtotime(date('Y-m-01')." -$i months"));
                                        if ($MonthName == $currentMonthName) {
                                            echo "<option value='{$MonthValue}' selected>{$MonthName}</option>";
                                        } else {
                                            echo "<option value='{$MonthValue}'>{$MonthName}</option>";
                                        }                                                                                                                  
                                    }
                                    ?>
                    </select>
                </div>
            </div>
            <div class="row table-data">
                <table class="table table-responsive">
                    <thead>
                        <tr class="table-heading text-center">
                            <th class="msrno" scope="col">SR NO.</th>
                            <th class="firstname" scope="col">FIRST NAME</th>
                            <th class="lastname" scope="col">LAST NAME</th>
                            <th class="email" scope="col">EMAIL</th>
                            <th class="joiningdate" scope="col">JOINING DATE</th>
                            <th class="underreviewnotes" scope="col">UNDER REVIEW NOTES</th>
                            <th class="publishednotes" scope="col">PUBLISHED NOTES</th>
                            <th class="downloadednotes" scope="col">DOWNLOADED NOTES</th>
                            <th class="totalexpenses" scope="col">TOTAL EXPENSES</th>
                            <th class="totalearnings" scope="col">TOTAL EARNINGS</th>
                            <th class="mdropdown" scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        
                            $loginid = $_SESSION['ID'];
                            $fetch_members_query = "SELECT * FROM users WHERE IsActive = 1 AND RoleID = 3";
                            $fetch_members = mysqli_query($connection,$fetch_members_query);
                            $i=1;

                            while ($members = mysqli_fetch_array($fetch_members)) {
                            $memberid = $members['ID'];
                        ?>
                        <tr>
                            <td><?php echo $i; ?></td>
                            <td><?php echo $members['FirstName']; ?></td>
                            <td><?php echo $members['LastName']; ?></td>
                            <td><?php echo $members['EmailID']; ?></td>
                            <td><?php echo date("d-m-Y, h:i", strtotime($members['CreatedDate'])); ?></td>
                            <td class="purple-color" onclick="window.location.href='underreview.php?admin=1&memberid=<?php echo $memberid;?>'">
                                <?php
                                
                                    $fetch_underreview_query = "SELECT COUNT(ID) AS underreview FROM seller_notes WHERE SellerID = $memberid AND Status IN (7,8) AND IsActive = 1";
                                    $fetch_underreview = mysqli_query($connection, $fetch_underreview_query);
                                    $underreview_count = mysqli_fetch_assoc($fetch_underreview);
                                    echo $underreview_count["underreview"];
                                
                                ?>
                            </td>
                            <td class="purple-color" onclick="window.location.href='publishednotes.php?admin=1&memberid=<?php echo $memberid;?>'">
                                <?php
                                
                                    $fetch_published_query = "SELECT COUNT(ID) AS published FROM seller_notes WHERE SellerID = $memberid AND Status = 9 AND IsActive = 1";
                                    $fetch_published = mysqli_query($connection, $fetch_published_query);
                                    $published_count = mysqli_fetch_assoc($fetch_published);
                                    echo $published_count["published"];
                                ?>
                            </td>
                            <td class="purple-color" onclick="window.location.href='downloadednotes.php?admin=1&memberid=<?php echo $memberid;?>'">
                                <?php
                                
                                    $fetch_downloaded_query = "SELECT DISTINCT(downloads.NoteID) FROM downloads WHERE downloads.Downloader = $memberid";
                                    $fetch_downloaded = mysqli_query($connection, $fetch_downloaded_query);
                                    $downloaded_count = mysqli_num_rows($fetch_downloaded);
                                    echo $downloaded_count;
                                ?>
                            </td>
                            <td class="purple-color" onclick="window.location.href='downloadednotes.php?admin=1&memberid=<?php echo $memberid;?>'">
                                <?php
                                    $fetch_expenses_query  = "SELECT NoteID,PurchasedPrice AS expenses FROM downloads WHERE Downloader = $memberid GROUP BY NoteID , Downloader";
                                    $fetch_expenses = mysqli_query($connection , $fetch_expenses_query);
                                    $total_expense = 0;
                                    while($expenses = mysqli_fetch_assoc($fetch_expenses)){
                                        $total_expense += $expenses['expenses'];
                                    }
                                    echo $total_expense;
                                ?>
                            </td>
                            <td>
                                <?php
                                
                                    $fetch_earning_query  = "SELECT PurchasedPrice AS earnings FROM downloads WHERE seller = $memberid GROUP BY Downloader,NoteID";
                                    $fetch_earning = mysqli_query($connection , $fetch_earning_query);
                                    $total_earning = 0;
                                    while($earnings = mysqli_fetch_assoc($fetch_earning)){
                                        $total_earning += $earnings['earnings'];
                                    }
                                    echo $total_earning;
                                
                                ?>
                            </td>
                            <td class="dropdown">
                                <img class="dropdown-toggle" id="dLabel" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" src="images/mydownloads/dots.png" alt="menu">
                                <div class="dropdown-menu" aria-labelledby="dLabel">
                                    <a class="dropdown-item" href="memberdetails.php?admin=1&memberid=<?php echo $memberid; ?>">View More Details</a>
                                    <a class="dropdown-item" href="#" onclick="deactivatemember('<?php echo $memberid; ?>')">Deactivate</a>
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

    <!-- custom js -->
    <script src="js/script.js"></script>
    <script>
        $(document).ready(function() {
            var table1 = $('table').DataTable({
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

            $('.search1').click(function() {
                var x = $('#searchtext1').val();
                table1.search(x).draw();

            });
            
            $(document).on('change', '#member-month-filter', function () {
            loadPublishedNotesByMonth($(this).val());
            });

            function loadPublishedNotesByMonth(month) {
                let monthVal = month;
                table1.column(4).search(monthVal).draw();
            }

            var currentMonth = $('#member-month-filter').val();
            loadPublishedNotesByMonth(currentMonth);

            

        });
    </script>
    <script>
    
        function deactivatemember(memberid){
            var approvecheck = confirm("Are you sure you want to make this member inactive?");
            if(approvecheck == true){
                location.replace("deactivatemember.php?memberid="+memberid);
            }else{
                
            }
        }
    
    </script>

</body>
</html>