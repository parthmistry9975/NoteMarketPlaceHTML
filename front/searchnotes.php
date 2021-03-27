<?php ob_start(); ?>
<?php include 'includes/db.php'; ?>
<?php  

    session_start();
    
?>
<!DOCTYPE html>
<html lang="en">
<head>

	<!-- meta tags -->
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">

	<!-- Title -->
	<title>Notes MarketPlace</title>

	<!-- google fonts -->
	<link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <!-- font awesome css -->
    <link rel="stylesheet" href="css/fontawesome/css/font-awesome.min.css">   
    
    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.min.css">

    <!-- custom css -->
    <link rel="stylesheet" type="text/css" href="css/style.css">
    
    <!-- responsive css -->
    <link rel="stylesheet" type="text/css" href="css/responsive.css">

</head>
<body>
    
    <!--
	<!-- preloader -->
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    
    <!-- navigation -->
    <section id="nav-bar">
        <nav class="navbar1 navbar-expand-lg">
            <a class="navbar-brand" href="index.html"><img src="images/user-profile/logo.png" alt="logo"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"><i class="fa fa-bars" aria-hidden="true"></i></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                   <li class="nav-item">
                        <a class="nav-link" href="searchnotes.php">Search Notes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="userdashboard.php">Sell Your Notes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="faq.html">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contactus.html">Contact Us</a>
                    </li>
                    <?php
                    
                    if(isset($_SESSION['ID'])){
                        $fetch_image_path_query = "SELECT ProfilePicture FROM user_profile WHERE UserID = ".$_SESSION['ID'];
                        $fetch_image_path = mysqli_query($connection , $fetch_image_path_query);
                        $image_path = mysqli_fetch_assoc($fetch_image_path);
                        $pp_file = "../upload/".$_SESSION['ID']."/profile/".$image_path['ProfilePicture'];
                        echo "<li class='nav-item dropdown'><a class='nav-link' href='#' id='navbarDropdown' role='button' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'><img src='$pp_file' alt='login image'>
                            <div class='dropdown-menu' aria-labelledby='navbarDropdown'>
                                <a class='dropdown-item' href='userprofile.php'>My Profile</a>
                                <a class='dropdown-item' href='mydownloads.php'>My Downloads</a>
                                <a class='dropdown-item' href='mysoldnotes.php'>My Sold Notes</a>
                                <a class='dropdown-item' href='myrejectednotes.php'>My Rejected Notes</a>
                                <a class='dropdown-item' href='changepw.php'>Change Password</a>
                                <a class='dropdown-item purple' href='logout.php'>LOGOUT</a>
                            </div>
                        </a></li>";
                        echo '<li class="nav-item"><a href="logout.php"><button type="button" class="btn btn-primary btn_login">Logout</button></a></li>';
                    }else{
                        echo '<li class="nav-item"><a href="login.php"><button type="button" class="btn btn-primary btn_login">Login</button></a></li>';
                    }
                    
                    ?>
                </ul>
            </div>
        </nav>
    </section>
    
	<!-- Banner  -->
	<section class="banner">
	    <div class="content-box-banner">
	        <div class="container">
	            <div class="row">
	                <div class="col-md-12">
	                    <h1 class="text-center">Search Notes</h1>
	                </div>
	            </div>
	        </div>
	    </div>
	</section>
	<!-- Banner Ends -->
	
	<!-- filter -->
    <section class="profile">
        <div class="container">
            <div class="row">
                <div class="col-md-12 serch-heading">
                    <h2>Search and Filter notes</h2>
                </div>
            </div>
            <div class="search-form col-md-12">
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <input type="search" id="serch_for_notes" class="form-control" name="search" placeholder="&#128269; Serch notes here">
                    </div>
                </div>
                <div class="form-row filter-tab">
                    <div class="form-group col-md-2">
                        <?php
                        
                        $fetch_type_query = "SELECT * FROM note_types WHERE IsActive = 1";
                        $fetch_type = mysqli_query($connection , $fetch_type_query);
                        
                        ?>
                        <select class="form-control" id="type">
                                <option value="">Select type</option>
                                <?php
                                while($row = mysqli_fetch_assoc($fetch_type)){
                                    ?>
                                    <option value="<?php echo $row['ID']; ?>"><?php echo $row['Name']; ?></option>
                                    <?php
                                }?>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <?php
                        
                        $fetch_category_query = "SELECT * FROM note_categories WHERE IsActive = 1";
                        $fetch_category = mysqli_query($connection , $fetch_category_query);
                        
                        ?>
                        <select class="form-control" id="category">
                                <option value="">Select category</option>
                                <?php
                                while($row = mysqli_fetch_assoc($fetch_category)){
                                    ?>
                                    <option value="<?php echo $row['ID']; ?>"><?php echo $row['Name']; ?></option>
                                    <?php
                                }?>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <?php
                        
                        $fetch_University_query = "SELECT DISTINCT UniversityName FROM seller_notes";
                        $fetch_University = mysqli_query($connection , $fetch_University_query);
                        
                        ?>
                        <select class="form-control" id="university">
                                <option value="">Select university</option>
                                <?php
                                while($row = mysqli_fetch_assoc($fetch_University)){
                                    ?>
                                    <option value="<?php echo $row['UniversityName']; ?>"><?php echo $row['UniversityName']; ?></option>
                                    <?php
                                }?>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <?php
                        
                        $fetch_course_query = "SELECT DISTINCT Course FROM seller_notes";
                        $fetch_course = mysqli_query($connection , $fetch_course_query);
                        
                        ?>
                        <select class="form-control" id="course">
                                <option value="">Select course</option>
                                <?php
                                while($row = mysqli_fetch_assoc($fetch_course)){
                                    ?>
                                    <option value="<?php echo $row['Course']; ?>"><?php echo $row['Course']; ?></option>
                                    <?php
                                }?>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <?php
                        
                        $fetch_country_query = "SELECT * FROM countries WHERE IsActive = 1";
                        $fetch_country = mysqli_query($connection , $fetch_country_query);
                        
                        ?>
                        <select class="form-control" id="country">
                                <option value="">Select country</option>
                                <?php
                                while($row = mysqli_fetch_assoc($fetch_country)){
                                    ?>
                                    <option value="<?php echo $row['ID']; ?>"><?php echo $row['Name']; ?></option>
                                    <?php
                                }?>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <select class="form-control" id="rating">
                                <option value="">Select rating</option>
                                <option value="5">5</option>
                                <option value="4">4+</option>
                                <option value="3">3+</option>
                                <option value="2">2+</option>
                                <option value="1">1+</option>                        
                        </select>
                    </div>
                </div>
            </div>
            <div id="result_notes">
                
                
            </div>
            
            <section class="footer">
            <div class="container">
                <hr>
                <div class="row">
                    <div class="col-md-6 col footer_content">
                        <p>Copyright © <a href="https://www.tatvasoft.com/">TatvaSoft</a> All Rights Reserved.</p>
                    </div>
                    <div class="col-md-6 footer_social text-right">
                        <ul class="social-list">
                            <li><a href="#">
                                    <i class="fa fa-facebook"></i>
                                </a></li>
                            <li><a href="#">
                                    <i class="fa fa-twitter"></i>
                                </a></li>
                            <li><a href="#">
                                    <i class="fa fa-google-plus"></i>
                                </a></li>
                        </ul>
                    </div>
                </div>
            </div>
            </section>
        </div>
        <div class="push"></div>
    </section>
	<!-- filter ends -->
	
	
	
	
	
	<!-- jquery-->
    <script src="js/jquery.min.js"></script>

    <!-- bootstrap js -->
    <script src="js/bootstrap/bootstrap.min.js"></script>
    <script src="js/bootstrap/popper.min.js"></script>

    <!-- custom js -->
    <script src="js/script.js"></script>
    <script>
    
        $(document).ready(function() {
            
            get_notes(1);
        
            function get_notes(page){
                
                var action = "data";
                var searchValue = $('#serch_for_notes').val();
                var type = $('select#type').children("option:selected").val();  
                var category = $('select#category').children("option:selected").val();
                var universityName = $('select#university').children("option:selected").val();
                var courseName = $('select#course').children("option:selected").val();
                var country = $('select#country').children("option:selected").val();
                var rating = $('select#rating').children("option:selected").val();
                
                $.ajax({
                    url:'searchajax.php',
                    method:'POST',
                    data:{ action:action , page:page , search:searchValue , type:type , category:category , university:universityName , course:courseName , country:country , rating:rating },
                    success:function(data){
                        $('#result_notes').html(data);
                    },
                    error: function (e) {
                        console.log(e);
                    }
                });
                
            }
            
            $('#serch_for_notes').keyup(function() {
                get_notes(1);
            });

            $("#type").change(function(){
                get_notes(1);
            });

            $("#category").change(function(){
                get_notes(1);
            });

            $("select#university").change(function(){
                get_notes(1);
            });

            $("select#course").change(function(){
                get_notes(1);
            });

            $("select#country").change(function(){
                get_notes(1);
            });
            
            $("select#rating").change(function(){
                get_notes(1);
            });
            
            $(document).on("click", "#note-pagination a", function (e) {
                e.preventDefault();
                var pageID = $(this).attr("id");
                get_notes(pageID);
            });
            
        });
    
    </script>

</body>
</html>