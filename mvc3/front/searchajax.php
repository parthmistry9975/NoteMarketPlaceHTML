<?php ob_start(); ?>
<?php include 'includes/db.php'; ?>
<?php  

    session_start();
?>


<?php
if(isset($_POST['action'])){
    
    $fetch_notes = "SELECT seller_notes.* ,AVG(Ratings) AS avgratings FROM seller_notes LEFT JOIN seller_notes_reviews ON seller_notes.ID = seller_notes_reviews.NoteID GROUP BY seller_notes.ID HAVING seller_notes.Status = 9"; 
    if(isset($_SESSION['ID'])){
        $fetch_notes .=" AND seller_notes.SellerID != ".$_SESSION['ID'];
    }
    
    if(isset($_POST['type'])){
        
        $type = $_POST['type'];
        if( $type != "" ){
            $fetch_notes .= " AND NoteType IN($type) ";
        }
        
    }
    
    if(isset($_POST['category'])){
        
        $category = $_POST['category'];
        if( $category != "" ){
            $fetch_notes .= " AND Category IN('".$category."')";
        }
       
    }
    
    if(isset($_POST['university'])){
        
        $university = $_POST['university'];
        if( $university != "" ){ 
            $fetch_notes .= " AND UniversityName IN('".$university."')";
        }
        
    }
    
    if(isset($_POST['course'])){
        
        $course = $_POST['course'];
        if( $course != "" ){ 
            $fetch_notes .= " AND Course IN('".$course."')";
        }
        
    }
    
    if(isset($_POST['country'])){
        
        $country = $_POST['country'];
        if( $country != "" ){ 
            $fetch_notes .= " AND Country IN('".$country."')";
        }
    }
    
    if(isset($_POST['search'])){
        if($_POST['search'] != ""){
            $search_val = $_POST["search"];
            $fetch_notes .= " AND Title LIKE '%".$_POST["search"]."%'";
        }
    }
    
    if(isset($_POST['rating'])){
        
        $rating = $_POST['rating'];
        if( $rating != "" ){
            $fetch_notes .= " AND avgratings > $rating";
        }
    }
    $fetch_notes .= " ORDER BY seller_notes.PublishedDate DESC";
    
}   
    if(empty($_POST['page'])){
        
        $page = 1;
        
    }else{
        
        $page = $_POST['page'];
        
    }
    $_SESSION['currentpage']=$page;
    $num_per_page = 9;
    $links = 1;
    $start_from = ($page-1) * $num_per_page;
    $for_pagination_fetch_notes = $fetch_notes ;
    $fetch_notes .= " LIMIT $start_from,$num_per_page";
    $final_fetch_notes = mysqli_query($connection , $fetch_notes);
    $final_pagination_fetch_notes = mysqli_query($connection , $for_pagination_fetch_notes);
    $totalrecords = mysqli_num_rows($final_pagination_fetch_notes);
    $totalpages = ceil($totalrecords / $num_per_page);
    $start = (($page - $links) > 0 ) ? $page - $links : 1;
    $end = (($page + $links) < $totalpages ) ? $page + $links : $totalpages;
    
?>

<div class="col-md-12 serch-heading">
    <h2>Total <?php echo $totalrecords; ?> Notes</h2>
</div>
<div class="row">
<?php
        while($result = mysqli_fetch_assoc($final_fetch_notes)){
        $sellerid = $result['SellerID'];
?>

    <div class="note col-md-4 col-sm-6">
        <div class="border">
            <div class="note-poster">
                   <?php
                        if($result['DisplayPicture'] != ''){
                            
                            $np_file = "../upload/$sellerid/".$result['ID']."/".$result['DisplayPicture'];
                            
                        }else{
                            
                            $np_file = "images/default/note/dnp.jpg";
                        }
                                    
                   ?>
                <img class="img-responsive" src="<?php echo $np_file; ?>" alt="poster">
            </div>
            <div class="note-heading">
                <a href="notedetails.php?noteid=<?php echo $result['ID']; ?>">
                    <p><?php echo $result['Title']; ?></p>
                </a>
            </div>
            <div class="note-info">
                <ul>
                    <?php
                        $country = $result['Country'];
                        $countryquery = "select Name From countries where ID=$country";
                        $country = mysqli_query($connection,$countryquery);
                        $final_country = mysqli_fetch_array($country);

                        $noteid = $result['ID'];
                        $checkreportquery = "SELECT * FROM seller_notes_reported_issues WHERE NoteID=$noteid";
                        $checkreport = mysqli_query($connection,$checkreportquery);
                        $final_checkreport = mysqli_num_rows($checkreport);

                        $getreviewquery = "SELECT AVG(Ratings) AS rating , COUNT(Ratings) AS numberofreviews FROM seller_notes_reviews WHERE NoteID = $noteid AND IsActive = 1 ";
                        $getreview = mysqli_query($connection,$getreviewquery);
                        $final_getreview = mysqli_fetch_array($getreview);
                        $rating_stars = round($final_getreview['rating']);
                        $numberofreview = $final_getreview['numberofreviews'];

                    ?>
                    <li><i class="fa fa-university" aria-hidden="true"></i> <?php if(!empty($result['UniversityName'])){ echo $result['UniversityName']." , ";}else{ echo " ";} ?> <?php if(!empty($final_country['Name'])){ echo $final_country['Name'];}else{ echo " -";} ?></li>
                    <li><i class="fa fa-columns" aria-hidden="true"></i> <?php if($result['NumberofPages'] != 0){echo $result['NumberofPages']." Pages";}else{ echo "-"; } ?></li>
                    <li><i class="fa fa-calendar" aria-hidden="true"></i> <?php
                                    $date = $result['PublishedDate'];
                                    $timestamp = strtotime($date);
                                    $new_date = date("D, M d Y", $timestamp);
                                    echo $new_date;
                                    ?></li>
                    <li id="inappropriate-text"><?php if($final_checkreport > 0 ){ echo "<i class='fa fa-flag-o' aria-hidden='true'></i>".$final_checkreport." Users marked this note as inappropriate"; }else{ echo " ";} ?></li>


                    <li>
                        <div id="serchpagerate">
                            <?php
                                for ($i = 0; $i < $rating_stars; $i++) {
                                    echo "<img src='images/note-details/star.png'>&nbsp;";
                                }
                                for ($j = 0; $j < (5 - $rating_stars); $j++) {
                                    echo "<img src='images/note-details/star-white.png'>&nbsp;";
                                }
                            ?>
                            <span><?php echo $numberofreview; ?> Review</span>
                        </div>

                    </li>
                </ul>
            </div>

        </div>
    </div>
<?php
        }
?> 
</div>


<div class="row">
    <ul class="pagination" id="note-pagination">
        <li class="<?php if($page == 1){ echo 'disabled'; }?> page-item">
            <?php 
            $prev_page = $page - 1;
            ?>
            <a class="page-link" id="<?php echo $prev_page; ?>" href="#" aria-label="Previous">
                <span aria-hidden="true"><img src="images/dashboard/left-arrow.png" alt="previous"></span>
                <span class="sr-only">Previous</span>
            </a>
        </li>
        <?php 
            for ($i = $start; $i <= $end; $i++) {
                ?>
                <li class='page-item <?php if ($page == $i) { echo "active"; } ?>'>
                    <a id='<?php echo $i; ?>' class='page-link' href='#'>
                        <?php echo $i; ?>
                    </a>
                </li>
                <?php
            }
        ?>
        
        
        <li class="<?php if($page == $totalpages){ echo 'disabled'; }?> page-item">
            <?php 
            $next_page = $page + 1;
            ?>
            <a class="page-link" id="<?php echo $next_page; ?>" href="#" aria-label="Next">
                <span aria-hidden="true"><img src="images/dashboard/right-arrow.png" alt="Next"></span>
                <span class="sr-only">Next</span>
            </a>
        </li>
    </ul>
</div>
