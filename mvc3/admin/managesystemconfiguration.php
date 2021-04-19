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
    if($_SESSION['ROLE'] != 1){
        header("location:admindashboard.php?admin=1");
    }
    if(isset($_SESSION['updaterecord']) and $_SESSION['updaterecord'] == 'yes'){
        $_SESSION['status'] = "Record Updated !!";
        $_SESSION['status_code'] = "success";
        unset($_SESSION['updaterecord']);
    }
    if(isset($_SESSION['profilerecord']) and $_SESSION['profilerecord'] == 'yes'){
        $_SESSION['status'] = "profile pic should be in jpg format only";
        $_SESSION['status_code'] = "warning";
        unset($_SESSION['profilerecord']);
    }
    if(isset($_SESSION['noterecord']) and $_SESSION['noterecord'] == 'yes'){
        $_SESSION['status'] = "Note pic should be in jpg format only";
        $_SESSION['status_code'] = "warning";
        unset($_SESSION['noterecord']);
    }
    if(isset($_SESSION['bothrecord']) and $_SESSION['bothrecord'] == 'yes'){
        $_SESSION['status'] = "Note and Profile both should be in jpg format only";
        $_SESSION['status_code'] = "warning";
        unset($_SESSION['noterecord']);
    }
?>
<?php
    if(isset($_POST['submit'])){
        
        $smail= mysqli_real_escape_string($connection,$_POST['supportemail'] );
        $sphone= mysqli_real_escape_string($connection,$_POST['supportphonenumber'] );
        $emails= mysqli_real_escape_string($connection,$_POST['email'] );
        $furl= mysqli_real_escape_string($connection,$_POST['facebook'] );
        $turl= mysqli_real_escape_string($connection,$_POST['twitter'] );
        $lurl= mysqli_real_escape_string($connection,$_POST['linkedin'] );
        $notep= $_FILES['defaultnote'];
        $profilep= $_FILES['defaultprofile'];

        
        $profilepname = $profilep['name'];
        $profilep_ext = explode('.',$profilepname);
        $profilep_ext_check = strtolower(end($profilep_ext));
        $valid_profilep_ext = array('jpg');
            if(in_array($profilep_ext_check,$valid_profilep_ext)){
                $file1 = "../front/images/default/profile/dp.jpg";
                unlink($file1);
                $profilepnewname = 'dp.'.$profilep_ext_check;
                $profileppath = $profilep['tmp_name'];
                if(!is_dir("../front/images/default/profile/")){
                    mkdir("../front/images/default/profile/",0777,true);
                }
                $profilep_dest = '../front/images/default/profile/'.$profilepnewname;
                move_uploaded_file( $profileppath , $profilep_dest );
            }else{
                $profilep_dest = '../front/images/default/profile/dp.jpg';
                $_SESSION['profilerecord'] = 'yes';
            }

        $notepname = $notep['name'];
        $notep_ext = explode('.',$notepname);
        $notep_ext_check = strtolower(end($notep_ext));
        $valid_notep_ext = array('jpg');
        if(in_array($notep_ext_check,$valid_notep_ext)){
            $file2 = "../front/images/default/note/dnp.jpg";
            unlink($file2);
            $notepnewname = 'dnp.'.$notep_ext_check;
            $noteppath = $notep['tmp_name'];
            if(!is_dir("../front/images/default/note/")){
                mkdir("../front/images/default/note/",0777,true);
            }
            $notep_dest = '../front/images/default/note/'.$notepnewname;
            move_uploaded_file($noteppath,$notep_dest);
        }else{
            $notep_dest = "../front/images/default/note/dnp.jpg";
            $_SESSION['noterecord'] = 'yes';
            if(isset($_SESSION['profilerecord'])){
                $_SESSION['bothrecord'] = "yes";
                unset($_SESSION['profilerecord']);
                unset($_SESSION['noterecord']);
            }
        }
        $u1 = mysqli_query($connection,"update system_configurations SET Value='$smail' , ModifiedDate = NOW() , ModifiedBy = ".$_SESSION['ID']." where ID=1");
        $u2 = mysqli_query($connection,"update system_configurations SET Value='$sphone' , ModifiedDate = NOW() , ModifiedBy = ".$_SESSION['ID']." where ID=2");
        $u3 = mysqli_query($connection,"update system_configurations SET Value='$emails' , ModifiedDate = NOW() , ModifiedBy = ".$_SESSION['ID']." where ID=3");
        $u4 = mysqli_query($connection,"update system_configurations SET Value='$notep_dest' , ModifiedDate = NOW() , ModifiedBy = ".$_SESSION['ID']." where ID=4");
        $u5 = mysqli_query($connection,"update system_configurations SET Value='$profilep_dest' , ModifiedDate = NOW() , ModifiedBy = ".$_SESSION['ID']." where ID=5");
        $u6 = mysqli_query($connection,"update system_configurations SET Value='$furl' , ModifiedDate = NOW() , ModifiedBy = ".$_SESSION['ID']." where ID=6");
        $u7 = mysqli_query($connection,"update system_configurations SET Value='$turl' , ModifiedDate = NOW() , ModifiedBy = ".$_SESSION['ID']." where ID=7");
        $u8 = mysqli_query($connection,"update system_configurations SET Value='$lurl' , ModifiedDate = NOW() , ModifiedBy = ".$_SESSION['ID']." where ID=8");


        if($u1 and $u2 and $u3 and $u4 and $u5 and $u6){
            $_SESSION['updaterecord'] = 'yes';
            header("location:managesystemconfiguration.php?admin=1");
        }
    }

    $select1 = mysqli_query($connection,"select Value from system_configurations Where ID=1");
    $select2 = mysqli_query($connection,"select Value from system_configurations Where ID=2");
    $select3 = mysqli_query($connection,"select Value from system_configurations Where ID=3");
    $select4 = mysqli_query($connection,"select Value from system_configurations Where ID=6");
    $select5 = mysqli_query($connection,"select Value from system_configurations Where ID=7");
    $select6 = mysqli_query($connection,"select Value from system_configurations Where ID=8");
    $s1 = mysqli_fetch_assoc($select1);
    $s2 = mysqli_fetch_assoc($select2);
    $s3 = mysqli_fetch_assoc($select3);
    $s4 = mysqli_fetch_assoc($select4);
    $s5 = mysqli_fetch_assoc($select5);
    $s6 = mysqli_fetch_assoc($select6);

?>
    <?php include 'includes/header.php'; ?>
    
    <!-- profile form -->
	<div class="admin-profile-form container">
            <div class="row">
                <form class="profile-form col-md-12" enctype="multipart/form-data" method="post" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
                    <div class="col-md-12 profile-form-heading">
                        <h2>Manage System Configuration</h2>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="supportemail">Support emails address &#42;</label>
                            <input type="email" class="form-control" name="supportemail" id="supportemail" placeholder="Enter email address" required value="<?php echo $s1['Value'] ?>">
                        </div>
                        <div class="form-group col-md-6">
                            
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="supportphonenumber">Support phone number &#42;</label>
                            <input type="number" class="form-control" name="supportphonenumber" id="supportphonenumber" placeholder="Enter phone number" required value="<?php echo $s2['Value'] ?>">
                        </div>
                        <div class="form-group col-md-6">
                            
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="email">Email Address(es) (for various events system will send notifications to these users)&#42;</label>
                            <input type="email" class="form-control" name="email" id="email" placeholder="Enter email address" required value="<?php echo $s3['Value'] ?>">
                        </div>
                        <div class="form-group col-md-6">
                            
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="facebook">Facebook URL</label>
                            <input type="url" class="form-control" name="facebook" id="facebook" placeholder="Enter facebook url" value="<?php echo $s4['Value'] ?>">
                        </div>
                        <div class="form-group col-md-6">
                            
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="twitter">Twitter URL</label>
                            <input type="url" class="form-control" name="twitter" id="twitter" placeholder="Enter twitter url" value="<?php echo $s5['Value'] ?>">
                        </div>
                        <div class="form-group col-md-6">
                            
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="linkedin">Linkedin URL</label>
                            <input type="url" class="form-control" name="linkedin" id="linkedin" placeholder="Enter linkedin url" value="<?php echo $s6['Value'] ?>">
                        </div>
                        <div class="form-group col-md-6">
                            
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="defaultnote">Default image for notes (if seller do not upload)</label>
                            <input type="file" name="defaultnote" class="form-control-file pp-upload" id="pp" required>
                        </div>
                        <div class="form-group col-md-6">
                            
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="defaultprofile">Default profile picture (if seller do not upload)</label>
                            <input type="file" name="defaultprofile" class="form-control-file pp-upload" id="pp" required>
                        </div>
                        <div class="form-group col-md-6">
                            
                        </div>
                    </div>
                    <button type="submit" name="submit" class="btn btn-profile">Submit</button>
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

</body>
</html>