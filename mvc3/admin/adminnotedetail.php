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
    
	<section id="notedetails">

        <div class="container line">

            <div class="row">
                <div class="col-md-12">
                    <h4>Note Details</h4>
                </div>
            </div>
            
            <?php

            if(isset($_GET['noteid'])){

                $noteid = $_GET['noteid'];

                $fetch_note_general_data_query = "SELECT users.FirstName AS sellerfname , users.LastName AS sellerlname , seller_notes.SellerID AS sellerid , seller_notes.DisplayPicture AS displaypicname , seller_notes.Title AS notetitle , note_categories.Name AS notecategory , seller_notes.Description AS notedescription , seller_notes.IsPaid AS sellfor , seller_notes.SellingPrice AS noteprice , seller_notes.UniversityName AS UniversityName , countries.Name AS countryname , seller_notes.Course AS coursename , seller_notes.CourseCode AS coursecode , seller_notes.Professor AS professor , seller_notes.NumberofPages AS pages , seller_notes.PublishedDate AS publisheddate , seller_notes.NotesPreview AS notepreview FROM seller_notes INNER JOIN note_categories ON note_categories.ID = seller_notes.Category INNER JOIN countries ON countries.ID = seller_notes.Country INNER JOIN users ON users.ID = seller_notes.SellerID WHERE seller_notes.ID = $noteid AND seller_notes.IsActive = 1 ";
                $fetch_note_general_data = mysqli_query($connection, $fetch_note_general_data_query);
                $note_general_data = mysqli_fetch_assoc($fetch_note_general_data);
                $_SESSION['sellername'] = $note_general_data['sellerfname'] . " " . $note_general_data['sellerlname'];
                
                
                $fetch_note_rate_data_query = "SELECT AVG(seller_notes_reviews.Ratings) AS ratings , COUNT(seller_notes_reviews.Ratings) AS ratecount , seller_notes_reviews.Comments AS comments FROM seller_notes_reviews WHERE seller_notes_reviews.NoteID = $noteid AND IsActive = 1 ";
                $fetch_note_rate_data = mysqli_query($connection ,$fetch_note_rate_data_query);
                $note_rate_data = mysqli_fetch_assoc($fetch_note_rate_data);
                $note_ratenum_data = $note_rate_data['ratecount'];
                $note_ratestar_data = round($note_rate_data['ratings']);
                
                $fetch_note_report_data_query = "SELECT * FROM seller_notes_reported_issues WHERE NoteID = $noteid";
                $fetch_note_report_data = mysqli_query($connection ,$fetch_note_report_data_query);
                $note_report_data = mysqli_num_rows($fetch_note_report_data);

            }else{
                ?>
                <script>

                    alert('note is deleted');
                    location.replace("userdashboard.php");

                </script>
                <?php
            }

            ?>

            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="row">
                        <div class="col-md-5 col-12">
                            <?php
                            
                                $displaypicname = $note_general_data['displaypicname'];
                                $sellerid = $note_general_data['sellerid'] ;  
                                if($displaypicname == ""){
                                    $displaypicpath = "../front/images/default/note/dnp.jpg";
                                }else{
                                    $displaypicpath = "../upload/$sellerid/$noteid/$displaypicname";
                                }
                            
                            ?>
                            <img src="<?php echo $displaypicpath; ?>" alt="book" class="img-fluid" style="height: 300px">
                        </div>
                        <div class="col-lg-7 col-md-12 col-sm-12 col-12">
                            <h3><?php echo $note_general_data['notetitle']; ?></h3>
                            <p><span><?php echo $note_general_data['notecategory']; ?></span></p>
                            <p id="review"><?php echo $note_general_data['notedescription']; ?></p>
                            <a class="download-button" href="download.php?noteid=<?php echo $noteid; ?>"><button role="button" class="btn btn-primary">DOWNLOAD</button></a>

                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-12 col-sm-12 col-12">
                    <div class="row">
                        <div class="col-md-7 col-6">
                            <div class="details">
                                <p>Institution:</p>
                                <p>Country:</p>
                                <p>Course Name:</p>
                                <p>Course Code:</p>
                                <p>Professor:</p>
                                <p>Number of Pages:</p>
                                <p>Approved Date:</p>
                                <p>Rating:</p>
                            </div>
                        </div>
                        <div class="col-md-5 col-6">
                            <div class="details-info">
                                <p><?php if(!empty($note_general_data['UniversityName'])){ echo $note_general_data['UniversityName']; }else{ echo "-"; } ?></p>
                                <p><?php if(!empty($note_general_data['countryname'])){echo $note_general_data['countryname'];}else{ echo "-";} ?></p>
                                <p><?php if(!empty($note_general_data['coursename'])){echo $note_general_data['coursename'];}else{ echo "-";} ?></p>
                                <p><?php if(!empty($note_general_data['coursecode'])){echo $note_general_data['coursecode'];}else{ echo "-";} ?></p>
                                <p><?php if(!empty($note_general_data['professor'])){echo $note_general_data['professor'];}else{ echo "-";} ?></p>
                                <p><?php echo $note_general_data['pages']; ?></p>
                                <p class="<?php if(empty($note_general_data['publisheddate'])){ echo "text-right";} ?>">
                                    <?php 
                                        if(empty($note_general_data['publisheddate'])){
                                            echo "-";
                                        }else{
                                            echo $note_general_data['publisheddate'];
                                        }
                                    ?>
                                </p>
                                <div id="notedetailsrate">
                                    <?php
                                        for ($i = 0; $i < $note_ratestar_data; $i++) {
                                            echo "<img style='width:20px;height:20px;' src='images/note-details/star.png'>&nbsp;";
                                        }
                                        for ($j = 0; $j < (5 - $note_ratestar_data); $j++) {
                                            echo "<img style='width:20px;height:20px;' src='images/note-details/star-white.png'>&nbsp;";
                                        }
                                    ?>
                                    <span style="color: #6255a5;line-height: 16px;text-align: right;font-weight: 600;font-size: 14px;margin-left: 15px;" id="numberreview">
                                    <?php
                                        echo $note_ratenum_data . " reviews";
                                    ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row"> 
                        <p id="red-text">
                        <?php
                            
                            if($note_report_data >= 1){
                                $reportnum = $note_report_data;
                                echo $reportnum;
                                echo " users marked this note as inappropriate";
                            }
                            
                        ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="general-height">
    <section id="notepreview">
        <div class="container">
            <div class="row">
                <div class="col-lg-5 col-md-12 col-sm-12 col-12">
                    <h4>Notes Preview</h4>
                    <?php
                    
                        $previewname = $note_general_data['notepreview'];
                        $sellerid = $note_general_data['sellerid'] ;  
                        $previewpath = "../upload/$sellerid/$noteid/$previewname";
                    
                    ?>
                    

                    <!-- responsive iframe -->
                    <!-- ============== -->

                    <div id="Iframe-Cicis-Menu-To-Go" class="set-margin-cicis-menu-to-go set-padding-cicis-menu-to-go set-border-cicis-menu-to-go set-box-shadow-cicis-menu-to-go center-block-horiz">
                        <div class="responsive-wrapper 
     responsive-wrapper-padding-bottom-90pct" style="-webkit-overflow-scrolling: touch; overflow: auto;">
                            <iframe src="<?php echo $previewpath; ?>">
                                <p style="font-size: 110%;"><em><strong>ERROR: </strong>
                                        An &#105;frame should be displayed here but your browser version does not support &#105;frames.</em> Please update your browser to its most recent version and try again, or access the file <a href="http://unec.edu.az/application/uploads/2014/12/pdf-sample.pdf">with this link.</a></p>
                            </iframe>
                        </div>
                    </div>


               
                </div>
                
                
                
                
                <div class="col-lg-7 col-md-12 col-sm-12 col-12">
                    <h4>Customer Review</h4>
                    
                    
                    
                    <div class="container border-black">
                        
                        <?php
                    
                            $fetch_customer_review_query = "SELECT seller_notes_reviews.ID AS reviewid, users.ID AS reviewerid , users.FirstName AS reviewerfname , users.LastName AS reviewerlname , user_profile.ProfilePicture AS profilepicname , seller_notes_reviews.Ratings , seller_notes_reviews.Comments AS comments FROM seller_notes_reviews INNER JOIN users ON users.ID = seller_notes_reviews.ReviewedByID INNER JOIN user_profile ON user_profile.UserID = seller_notes_reviews.ReviewedByID WHERE seller_notes_reviews.NoteID = $noteid AND seller_notes_reviews.IsActive = 1";
                            $fetch_customer_review = mysqli_query($connection ,$fetch_customer_review_query);
                            $check_comment = mysqli_num_rows($fetch_customer_review);
                            if($check_comment == 0 ){
                                echo "<h1 class='text-center' style='color:#6255a5;margin-top:150px;font-weight:600;'> 0 Reviews</h1>";
                            }else{
                            while($review_row = mysqli_fetch_assoc($fetch_customer_review)){

                        ?>
                        
                        <div class="row bottom-black">
                            <div class="col-md-2">
                                <?php 
                                
                                $reviewid = $review_row['reviewid'];
                                $profilepicname = $review_row['profilepicname'];
                                $reviewerid = $review_row['reviewerid'] ;  
                                if(!empty($profilepicname)){
                                    $displaypicpath = $profilepicname;   
                                }else{
                                    $displaypicpath = "../front/images/default/profile/dp.jpg";
                                }
                                
                                
                                ?>
                                <img class="reviewer-photo" src="<?php echo $displaypicpath; ?>" class="img-fluid rounded-circle" alt="user">
                            </div>
                            <div class="col-md-10">
                               <div class="row">
                               <div class="col-lg-11 col-md-11 col-sm-11 col-10">
                                   <h6><?php echo $review_row['reviewerfname']." ".$review_row['reviewerlname']; ?></h6>
                                <div class="rate1 rate-space">
                                    <div class="rate">&nbsp;&nbsp;
                                        <?php
                                            for ($i = 0; $i <$review_row['Ratings']; $i++) {
                                                echo "<img src='images/note-details/star.png'>&nbsp;";
                                            }
                                            for ($j = 0; $j < (5 - $review_row['Ratings']); $j++) {
                                                echo "<img src='images/note-details/star-white.png'>&nbsp;";
                                            }
                                        ?>
                                    </div>
                                </div>
                               </div>
                               <img style="width:20px;height:25px;" onclick="window.location.href='deletereview.php?admin=1&reviewid=<?php echo $reviewid;?>&noteid=<?php echo $noteid; ?>'" src="images/note-details/delete.png" class="text-right" alt="delete">
                                
                                </div>
                            </div>



                            <div class="col-md-2"></div>
                            <div class="col-md-10">
                                <p><?php echo $review_row['comments'];  ?></p>
                            </div>


                        </div>
                        <?php
                            }
                            }
                        ?>

                        
                    </div><br>
                
                </div>
            </div>
        </div>
    </section>
    </div>
	
	<?php include 'includes/footernlink.php'; ?>

</body>
</html>