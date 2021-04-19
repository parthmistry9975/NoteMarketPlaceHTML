<!-- preloader -->
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    
    
    <!-- navigation -->
    <section id="nav-bar">
        <nav class="navbar1 navbar-expand-lg">
            <a class="navbar-brand" href="index.php"><img src="images/user-profile/logo.png" alt="logo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"><i class="fa fa-bars" aria-hidden="true"></i></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link <?php if(isset($Page)){ if($Page == 'searchpage'){ echo 'activepage';}} ?>" href="searchnotes.php">Search Notes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if(isset($Page)){ if($Page == 'userdashboard'){ echo 'activepage';}} ?>" href="userdashboard.php">Sell Your Notes</a>
                    </li>
                    <?php
                    if(isset($_SESSION['ID'])){
                        ?>
                        <li class="nav-item">
                            <a class="nav-link <?php if(isset($Page)){ if($Page == 'buyerrequest'){ echo 'activepage';}} ?>" href="buyerrequest.php">Buyer Requests</a>
                        </li>
                        <?php
                    }
                    ?>
                    <li class="nav-item">
                        <a class="nav-link <?php if(isset($Page)){ if($Page == 'faq'){ echo 'activepage';}} ?>" href="faq.php">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php if(isset($Page)){ if($Page == 'contactus'){ echo 'activepage';}} ?>" href="contactus.php">Contact Us</a>
                    </li>
                    <?php
                    
                    if(isset($_SESSION['ID'])){
                        $fetch_image_path_query = "SELECT ProfilePicture FROM user_profile WHERE UserID = ".$_SESSION['ID'];
                        $fetch_image_path = mysqli_query($connection , $fetch_image_path_query);
                        $image_path = mysqli_fetch_assoc($fetch_image_path);
                        if(!empty($image_path['ProfilePicture'])){
                            $pp_file = $image_path['ProfilePicture'];
                        }else{
                            $pp_file = "images/default/profile/dp.jpg";
                        }
                        
                        ?><li class='nav-item dropdown'><a class='nav-link' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><img src='<?php echo $pp_file; ?>' alt='login image'>
                            <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                                <a class='dropdown-item' href='userprofile.php'>My Profile</a>
                                <a class='dropdown-item' href='mydownloads.php'>My Downloads</a>
                                <a class='dropdown-item' href='mysoldnotes.php'>My Sold Notes</a>
                                <a class='dropdown-item' href='myrejectednotes.php'>My Rejected Notes</a>
                                <a class='dropdown-item' href='changepw.php'>Change Password</a>
                                <a class='dropdown-item purple' href='logout.php'>LOGOUT</a>
                            </div>
                        </a></li><li class="nav-item"><a href="logout.php"><button type="button" class="btn btn-primary btn_login">Logout</button></a></li><?php
                    }else{
                        ?>
                        <li class="nav-item"><a href="login.php"><button type="button" class="btn btn-primary btn_login">Login</button></a></li>
                        <?php
                    }
                    
                    ?>
                </ul>
            </div>
        </nav>
    </section>