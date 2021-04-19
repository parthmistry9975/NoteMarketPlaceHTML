<?php ob_start(); ?>
<?php include 'includes/db.php'; ?>
<?php 
    session_start();
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;

    if(!isset($_SESSION['ID'])){
        header("location:login.php");
    }
    if($_SESSION['ROLE'] != 3){
            header("location:../admin/admindashboard.php?admin=1");
    }
    if(isset($_SESSION['publishtoreview']) and $_SESSION['publishtoreview'] == 'yes'){
        $_SESSION['status'] = "Note is gone to admin for review !!";
        $_SESSION['status_code'] = "info";
        unset($_SESSION['publishtoreview']);
    }
?>

<?php
        $ID = $_SESSION['ID'];
        
        if(isset($_POST['save'])) {
            
            $title= mysqli_real_escape_string($connection,$_POST['notetitle']);
            $_SESSION['title'] = $title;
            
            $category= mysqli_real_escape_string($connection,$_POST['notecategory'] );
            $_SESSION['category'] = $category;
            
            $displaypic= $_FILES['displaypicture'];
            $_SESSION['displaypic'] = $displaypic;
            $displaypicnewname = "";
            
            $uploadnote= $_FILES['notes-file'];
            $_SESSION['uploadnote'] = $uploadnote;
            
            $type= mysqli_real_escape_string($connection,$_POST['notetype'] );
            if(!$type){
                $type = 6;
            }
            $_SESSION['type'] = $type;
            
            $pages= mysqli_real_escape_string($connection,$_POST['numberofpages'] );
            $_SESSION['pages'] = $pages;
            
            $description= mysqli_real_escape_string($connection,$_POST['description'] );
            $_SESSION['description'] = $description;
            
            $country= mysqli_real_escape_string($connection,$_POST['country'] );
            if(!$country){
                $country = 6;
            }
            $_SESSION['country'] = $country;
            
            $institution= mysqli_real_escape_string($connection,$_POST['institutename'] );
            $_SESSION['institution'] = $institution;
            
            $course= mysqli_real_escape_string($connection,$_POST['coursename'] );
            $_SESSION['course'] = $course;
            
            $coursecode= mysqli_real_escape_string($connection,$_POST['coursecode'] );
            $_SESSION['coursecode'] = $coursecode;
            
            $professor= mysqli_real_escape_string($connection,$_POST['author'] );
            $_SESSION['professor'] = $professor;
            
            $sellfor= mysqli_real_escape_string($connection,$_POST['sellfor'] );
            $_SESSION['sellfor'] = $sellfor;
            if($sellfor == 1){
                $sellfor = 'True';
            }else{
                $sellfor = 'False';
            }
            
            $price= mysqli_real_escape_string($connection,$_POST['sellprice'] );
            if($sellfor == 0){
                $price = 0;
            }
            $_SESSION['price'] = $price;
            
            $preview= $_FILES['notepreview'];
            $_SESSION['preview'] = $preview;
            
            $loginID = $_SESSION['ID'];
            
            $displaypicname = $displaypic['name'];
            $displaypic_ext = explode('.',$displaypicname);
            $displaypic_ext_check = strtolower(end($displaypic_ext));
            $valid_displaypic_ext = array('png','jpg','jpeg');
            $displaypicnewname = "bp_".date("dmyhis").'.'.$displaypic_ext_check;
            $previewname = $preview['name'];
            $preview_ext = explode('.',$previewname);
            $preview_ext_check = strtolower(end($preview_ext));
            $valid_preview_ext = array('pdf');
            $previewnewname = "preview_".date("dmyhis").'.'.$preview_ext_check;
            $countfiles = count($uploadnote['name']);
            for($i=0 ; $i<$countfiles ; $i++){
                $uploadnotename = $uploadnote['name'][$i];
                $uploadnote_ext = explode('.',$uploadnotename);
                $uploadnote_ext_check = strtolower(end($uploadnote_ext));
                $valid_uploadnote_ext = array('pdf');
            }
            
            if (!empty($displaypicname)) {
                if (in_array($displaypic_ext_check,$valid_displaypic_ext)) {

                    $displaypicnewname = $displaypicnewname = "bp_".date("dmyhis").'.'.$displaypic_ext_check;
                } else {
                    ?>
                    <script>
                        alert("select proper file type for preview 2")
                    </script>
                    <?php
                }
            }else{
                $displaypicnewname = "";
            }
            
            if(in_array($uploadnote_ext_check,$valid_uploadnote_ext) && in_array($preview_ext_check,$valid_preview_ext) ) {
            
            $insertquery = "INSERT INTO seller_notes(SellerID, Status,ActionedBy,Title,Category,DisplayPicture, NoteType, NumberofPages, Description, UniversityName,Country, Course, CourseCode, Professor, IsPaid, SellingPrice,NotesPreview,CreatedBy,ModifiedBy) VALUES ('$loginID','6','$loginID','$title','$category','$displaypicnewname','$type','$pages','$description','$institution','$country','$course','$coursecode','$professor',$sellfor,'$price','$previewnewname','$loginID','$loginID')";
            $iquery= mysqli_query($connection,$insertquery);
            if(!$iquery){
                die('query failed'.mysqli_error($connection));
            }
            $noteid = mysqli_insert_id($connection);
            $_SESSION['noteid'] = $noteid;
            $_SESSION['notetitle'] = $title;
            
            
            $displaypicpath = $displaypic['tmp_name'];
            if(!is_dir("'../upload/'.$loginID.'/'.$noteid.'/'")){
                mkdir("../upload/".$loginID."/".$noteid."/",0777,true);
            }
            $displaypic_dest = '../upload/'.$loginID.'/'.$noteid.'/'.$displaypicnewname;
            move_uploaded_file($displaypicpath,$displaypic_dest);
    
            $previewpath = $preview['tmp_name'];
            $preview_dest = '../upload/'.$loginID.'/'.$noteid.'/'.$previewnewname;
            move_uploaded_file($previewpath,$preview_dest);
            
            if(!is_dir("'../upload/'.$loginID.'/'.$noteid.'/Attachment'.'/'")){
                mkdir("../upload/".$loginID."/".$noteid."/Attachment"."/",0777,true);
            }
            for($i=0;$i<$countfiles;$i++){
                $uploadnotenewname = "Attachment_[$i]_".date("dmyhis").'.'.$uploadnote_ext_check;
                $uploadnotepath = $uploadnote['tmp_name'];
    
                $uploadnote_dest = '../upload/'.$loginID.'/'.$noteid.'/Attachment'.'/'.$uploadnotenewname;
                move_uploaded_file($uploadnotepath[$i],$uploadnote_dest);
            
                $insertquery1 ="INSERT INTO seller_notes_attachements( NoteID , FileName , FilePath , CreatedBy, ModifiedBy, IsActive) VALUES ('$noteid','$uploadnotenewname','$uploadnote_dest','$loginID','$loginID', 1 )";
                $iquery1= mysqli_query($connection,$insertquery1);
                $attachmentid = mysqli_insert_id($connection);
            
            }
                
            if($iquery && $iquery1){
                
                $_SESSION['status'] = "Note Added As Draft !!";
                $_SESSION['status_code'] = 'success';
                
            }
            else{
            ?>
                <script>
                    alert("note isn't added !! ");
                    location.href = "addnote.php";
                </script>
            <?php
            }
           
            
        
        }
        else{
        ?>
            <script>
                alert("please choose proper file type !! for display picture jpg , jpeg , png !! for preview and attachment file pdf ");
                location.href = "addnote.php";
            </script>
        <?php
        }
        }
            
        

        if(isset($_POST['publish'])){
            
        ?>
            <script>
            if (confirm('Publishing this note will send note to administrator for review, once administrator review and approve then this note will be published to portal. Press yes to continue.')) {
                <?php 
                    $noteid = $_SESSION['noteid'];
                    $note_title = $_SESSION['notetitle'];
                    $seller_name = $_SESSION['FNAME'];
                    $query2 = "UPDATE seller_notes SET Status = 7 WHERE ID =$noteid";
                    $uquery = mysqli_query($connection, $query2);

                    require 'src/Exception.php';
                    require 'src/PHPMailer.php';
                    require 'src/SMTP.php';

                    $mail = new PHPMailer(true);

                    try{

                        $mail->isSMTP();
                        $mail->Host = 'smtp.gmail.com';
                        $mail->SMTPAuth = true;
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                        $mail->Port = 587;

                        $config_email = '170320116025.it.parth@gmail.com';
                        $mail->Username = $config_email;
                        $mail->Password = 'Parth@1234';

                        $mail->setFrom($config_email, 'NotesMarketPlace');  // This email address and name will be visible as sender of email

                        $mail->addAddress('parthmistry7227843533@gmail.com', 'Receiver name');  // This email is where you want to send the email
                        $mail->addReplyTo($config_email, 'NotesMarketPlace');   // If receiver replies to the email, it will be sent to this email address

                        // Setting the email content
                        $mail->IsHTML(true);  
                        $mail->Subject = "varification of NotesMarketPlace account";    
                        $mail->Body ="<table style='height:60%;width: 60%; position: absolute;margin-left:10%;font-family:Open Sans !important;background: white;border-radius: 3px;padding-left: 2%;padding-right: 2%;'>
                            <thead>
                                <th>
                                    <img src='https://i.ibb.co/HVyPwqM/top-logo1.png' alt='logo' style='margin-top: 5%;'>
                                </th>
                            </thead>
                            <tbody>
                                <br>
                                <tr style='height: 60px;font-family: Open Sans;font-size: 26px;font-weight: 600;line-height: 30px;color: #6255a5;'>
                                    <td class='text-1'>New Note Published</td>
                                </tr>
                                <tr style='height: 40px;font-family: Open Sans;font-size: 18px;font-weight: 600;line-height: 22px;color: #333333;margin-bottom: 20px;'>
                                    <td class='text-2'>Hello Admin,</td>
                                </tr>
                                <tr style='height: 60px;'>
                                    <td class='text-3'>
                                        We want to inform you that, <b>$seller_name</b> sent his note <br> <b>$note_title</b> for review. Please look at the notes and take required actions.
                                    </td>
                                </tr>
                                <tr style='height: 60px;'>
                                    <td class='text-3'>
                                        Regards <br>
                                        NotesMarketPlace
                                    </td>
                                </tr>
                            </tbody>
                        </table>";   //Email body
                        $mail->AltBody = 'Plain text message body for non-HTML email client. Gmail SMTP email body.';   //Alternate body of email
                        $_SESSION['publishtoreview'] = "yes";
                        $mail->send();
                        header("location:addnote.php");

                    } catch (Exception $e) {
                        echo "Error in sending email. Mailer Error: {$mail->ErrorInfo}";
                    }
                    ?>

                    } else{
            
                    }
                
            </script>
            <?php
        }
?>

<?php include 'includes/header.php'; ?>
    
    
    
	<!-- Banner  -->
        <section class="banner">
            <div class="content-box-banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="text-center">Add Notes</h1>
                    </div>
                </div>
            </div>
        </div>
        </section>
        <!-- Banner Ends -->
	
	<!-- profile form -->
	<div class="container">
            <div class="row">
                <form class="profile-form col-md-12" action="addnote.php" method="post" enctype="multipart/form-data">
                    <div class="col-md-12 profile-form-heading">
                        <h2>Basic Note Details</h2>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="title">Title &#42;</label>
                            <input type="text" title="must have 3 characters" name="notetitle" class="form-control" id="title" placeholder="Enter your notes title" required <?php if(isset($_POST['save'])){ echo "value="."'".$_SESSION['title']."'" ; }?>>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="category">Category &#42;</label>
                            <?php 
                            
                                $category_query = "SELECT ID,Name FROM note_categories";
                                $cquery = mysqli_query($connection, $category_query);
                                $cqueryrows = mysqli_num_rows($cquery);
                            
                            ?>
                            <select id="category" name="notecategory" class="form-control" required>
                                <option value="">Select your category</option>
                                <?php
                                
                                    for($i=1;$i<=$cqueryrows;$i++){
                                        $categoryrow = mysqli_fetch_array($cquery);
                                        ?>
                                        <option value="<?php echo $categoryrow['ID'];?>" <?php if(isset($_POST['save'])){if($categoryrow['ID']==$_SESSION['category']){echo "selected";}}?>><?php echo $categoryrow['Name'] ?></option>
                                <?php
                            }
                            ?>

                               
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 file-upload">
                            <label for="displaypicture">Display Picture</label>
                            <input type="file" name="displaypicture" class="form-control-file display-picture" id="displaypicture" <?php if(isset($_POST['save'])){ echo "disabled" ; }?>>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="uploadnote">Upload Notes &#42;</label>
                            <input type="file" name="notes-file[]" class="form-control-file upload-notes" id="uploadnote" required multiple <?php if(isset($_POST['save'])){ echo "disabled" ; }?>>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="notetype">Type</label>
                            <?php
                            
                                $type_query = "SELECT ID,Name FROM note_types";
                                $tquery = mysqli_query($connection, $type_query);
                                $typerows = mysqli_num_rows($tquery);
                            
                            ?>
                            <select id="notetype" name="notetype" class="form-control">
                                <option value="">Select your note type</option>
                                <?php
                                    for($i=1;$i<=$typerows;$i++){
                                        $typerow = mysqli_fetch_array($tquery);
                                ?>
                                    <option value="<?php echo $typerow['ID'] ?>" <?php if(isset($_POST['save'])){if($typerow['ID']==$_SESSION['type']){echo "selected";}}?>><?php echo $typerow['Name'] ?></option>
                                <?php
                            }
                            ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="pages">Number of Pages</label>
                            <input type="text" name="numberofpages" title="only numbers are allowed" class="form-control" id="pages" placeholder="Enter number of note pages" <?php if(isset($_POST['save'])){ echo "value="."'".$_SESSION['pages']."'" ; }?>>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="description">Description &#42;</label>
                            <textarea name="description" title="must have 5 characters" class="form-control hw" id="description" cols="50" rows="5" placeholder="Enter your description" required><?php if(isset($_POST['save'])){  echo $_SESSION['description']; }?></textarea>
                        </div>
                    </div>
                
                    <div class="col-md-12 profile-form-heading">
                        <h2>Institution Information</h2>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="country">Country</label>
                            <?php
                            
                                $country_query = "SELECT ID,Name FROM countries";
                                $coquery = mysqli_query($connection, $country_query);
                                $countryrows = mysqli_num_rows($coquery);
                            
                            ?>
                            <select id="country" name="country" class="form-control">
                                <option value="">Select your country</option>
                                <?php
                                    for($i=1;$i<=$countryrows;$i++){
                                        $countryrow = mysqli_fetch_array($coquery);
                                ?>
                                    <option value="<?php echo $countryrow['ID'] ?>" <?php if(isset($_POST['save'])){if($countryrow['ID']==$_SESSION['country']){echo "selected";}}?>><?php echo $countryrow['Name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="institute">Instituion Name</label>
                            <input type="text" title="numbers are not allowed must have 3 characters" name="institutename" class="form-control" id="institute" placeholder="Enter your institution name" <?php if(isset($_POST['save'])){ echo "value="."'".$_SESSION['institution']."'" ; }?>>
                        </div>
                    </div>
                    
                    <div class="col-md-12 profile-form-heading">
                        <h2>Course Details</h2>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="coursename">Course Name</label>
                            <input type="text" title="must have 2 characters" name="coursename" class="form-control" id="coursename" placeholder="Enter your course name" <?php if(isset($_POST['save'])){ echo "value="."'".$_SESSION['course']."'" ; }?>>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="coursecode">Course Code</label>
                            <input type="text" title="maximum 20 characters" name="coursecode" class="form-control" id="coursecode" placeholder="Enter your course code" <?php if(isset($_POST['save'])){ echo "value="."'".$_SESSION['coursecode']."'" ; }?>>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="professor">Professor / Lecturer</label>
                            <input type="text" title="numbers are not allowed must have 3 characters" name="author" class="form-control" id="professor" placeholder="Enter your professor name" <?php if(isset($_POST['save'])){ echo "value="."'".$_SESSION['professor']."'" ; }?>>
                        </div>
                        <div class="form-group col-md-6">
                            
                        </div>
                    </div>
                    
                    <div class="col-md-12 profile-form-heading">
                        <h2>Selling information</h2>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label for="sellfor">Sell For &#42;</label>
                                    <br>
                                    <label class="radio-inline radio-layout">
                                        <input type="radio" id="free" onclick="javascript:yesnoCheck();" class="radio-size" name="sellfor" value="0" required <?php if(isset($_POST['save'])){if($_SESSION['sellfor']==0){echo "checked"; } }?>><label class="radio-label" for="free">&nbsp;&nbsp;&nbsp;Free</label>
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" id="paid" onclick="javascript:yesnoCheck();" class="radio-size" name="sellfor" value="1" <?php if(isset($_POST['save'])){if($_SESSION['sellfor']==1){echo "checked"; } }?>><label class="radio-label" for="free">&nbsp;&nbsp;&nbsp;Paid</label>
                                    </label>
                                </div>
                                <div class="form-group col-md-12 margin-layout">
                                    <label style="visibility:hidden" id="pricelabel" for="sellprice">Sell Price &#42;</label>
                                    <input type="text" pattern="[0-9]{1,}" style="visibility:hidden" title="only numbers allowed must have 1 characters" name="sellprice" class="form-control" id="sellprice" placeholder="Enter your price" required <?php if(isset($_POST['save'])){ echo "value="."'".$_SESSION['price']."'" ; }?>>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="notepreview">Note Preview</label>
                            <input type="file" name="notepreview" class="form-control note-preview" id="noteprevie" name="Upload a picture" required <?php if(isset($_POST['save'])){ echo "disabled" ; }?>>
                        </div>
                    </div>
                    <button type="submit" name="save" class="btn btn-profile add-note-button"<?php if(isset($_POST['save'])){echo "disabled";}?>>Save</button>
                    <span></span><button name="publish" type="submit" class="btn btn-profile add-note-button" <?php if(!isset($_POST['save'])){echo "disabled";}?>>Publish</button>
                    
                    
                </form>
            </div>
        </div>
	<!-- profile form ends -->
	
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
    
        function yesnoCheck() {
            if (document.getElementById('paid').checked) {
                document.getElementById('sellprice').style.visibility = 'visible';
                document.getElementById('pricelabel').style.visibility = 'visible';
            }
            else {
                document.getElementById('sellprice').style.visibility = 'hidden';
                document.getElementById('pricelabel').style.visibility = 'hidden';
                document.getElementById('sellprice').value = '0';
            }
        }
    
    </script>
    
    <?php if(isset($_POST['save'])){  

    ?>
    <script>
        document.getElementById('sellprice').style.visibility = 'visible';
        document.getElementById('pricelabel').style.visibility = 'visible';
    </script>
    <?php
    
    }?>

</body>
</html>