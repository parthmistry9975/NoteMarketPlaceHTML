<?php ob_start(); ?>
<?php include 'includes/db.php'; ?>
<?php  

    session_start();
    if(!isset($_SESSION['ID'])){
        header("location:login.php");
    }
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
                        <a class="nav-link" href="searchnotes.html">Search Notes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="addnote.html">Sell Your Notes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="buyerrequest.php">Buyer Requests</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="faq.html">FAQ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contactus.html">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><img src="images/user-profile/login-image.png" alt="login image"></a>
                    </li>
                    <li class="nav-item">
                        <a href="logout.php"><button type="button" class="btn btn-primary btn_login">Logout</button></a>
                    </li>
                </ul>
            </div>
        </nav>
    </section>

    <!-- Stats -->
    <div id="dashboard-stats" class="box">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 col-6">
                    <h2>Dashboard</h2>
                </div>
                <div class="col-md-6 col-6 text-right">
                    <a href="addnote.php"><button>Add Note</button></a>
                </div>
            </div>

            <div class="row" id="stats">
                <div class="col-lg-6 col-md-12">
                    <div id="stats-left">
                        <div class="row">
                            <div class="col-md-4 state-head stats-text">
                                <div>
                                    <img src="images/dashboard/earning-icon.svg" alt="icon">
                                    <h4>My Earning</h4>
                                </div>
                            </div>
                            <div class="col-md-4 text-center stats-text">
                                <div>
                                    <h4>100</h4>
                                    <h6>Number of Notes Sold</h6>
                                </div>
                            </div>
                            <div class="col-md-4 text-center stats-text">
                                <div>
                                    <h4>$10,00,000</h4>
                                    <h6>Money Earned</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-4 text-center">
                    <div class="stat-item stats-text">
                        <div>
                            <h4>38</h4>
                            <h6>My Downloads</h6>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-4 text-center">
                    <div class="stat-item stats-text">
                        <div>
                            <h4>12</h4>
                            <h6>My Rejected Notes</h6>
                        </div>
                    </div>
                </div>

                <div class="col-lg-2 col-md-4 text-center">
                    <div class="stat-item stats-text">
                        <div>
                            <h4>102</h4>
                            <h6>Buyer Requests</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Stats Ends-->
   
   
    
    
    
    
    <section class="data-table dashboard-table">
        <div class="container table1">
            <div class="row">
                <div class="data-table-intro col-md-6">In Progress Notes</div>
                <form action="userdashboard.php" method="post" class="search-part col-md-6 text-right">
                    <input name="search_value" type="text" placeholder="&#x1F50D; Search">
                    <button name="search" type="submit" class="btn search-btn">Search</button> 
                </form>
            </div>
            <div class="row table-data table-responsive">
                <table class="table">
                    <tr class="table-heading text-center">
                        <th class="addeddate" scope="col">ADDED DATE</th>
                        <th class="title" scope="col">TITLE</th>
                        <th class="category" scope="col">CATEGORY</th>
                        <th class="status" scope="col">STATUS</th>
                        <th class="actions" scope="col">ACTIONS</th>
                    </tr>
                    
                    <?php  
                    
                    if(isset($_GET['page'])){
                        $page = $_GET['page'];
                        $page =mysqli_real_escape_string($connection,$page);
                        $page = htmlentities($page);
                    }else{
                        $page = 1;
                    }
                    
                    $num_per_page = 05;
                    $start_from = ($page-1) * $num_per_page;
                    $construct = "";
                    if(isset($_POST['search'])){
                        $search = $_POST['search_value'];
                        echo $search;
                        $search_exploded = explode(" ",$search);
                        print_r($search_exploded);
                        $parameters = array('seller_notes.Title','note_categories.Name','seller_notes.Status');
                        foreach($search_exploded as $search_each){
                            foreach($parameters as $parameter){
                               $construct .= " OR $parameter LIKE '%".$search_each."%'"; 
                            }
                            echo $construct;
                        }
                    }
                    
                    
                    
                    $fetch_progress_query = "SELECT seller_notes.ID,seller_notes.Status AS s_id,seller_notes.CreatedDate AS added_date,seller_notes.Title AS title,note_categories.Name AS category,reference_data.Value AS status FROM seller_notes,reference_data,note_categories WHERE seller_notes.Status = reference_data.ID AND seller_notes.Category = note_categories.ID AND seller_notes.Status IN ( 6, 7, 8) ORDER BY seller_notes.CreatedDate DESC LIMIT $start_from,$num_per_page";
                    $progress_notes = mysqli_query($connection,$fetch_progress_query);
                    
                    $fetch_num_query = "SELECT * FROM seller_notes WHERE Status IN ( 6, 7, 8)";
                    $fetch_num = mysqli_query($connection,$fetch_num_query);
                    $total_records = mysqli_num_rows($fetch_num);
                    $total_pages = ceil($total_records / $num_per_page);
                    
                   
                    
                    
                    while ($progress_row = mysqli_fetch_array($progress_notes)) {  
                    ?>
                        <tr>
                            <td><?php echo $progress_row["added_date"]; ?></td>
                            <td><?php echo $progress_row["title"]; ?></td>
                            <td><?php echo $progress_row["category"]; ?></td>
                            <td><?php echo $progress_row["status"]; ?></td>
                            <td><?php 
                        
                                if( $progress_row["s_id"] == 6 ){ echo '&nbsp;<a href="editnote.php?id_note='.$progress_row["ID"].'"><img src="images/dashboard/edit.png" alt="edit"></a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="deletenote.php?delete_id='.$progress_row["ID"].'"><img src="images/dashboard/delete.png" alt="delete"></a>'; }
                                else{

                                echo '&nbsp;&nbsp;&nbsp;&nbsp;<a href="notedetails.php?note_id='.$progress_row["ID"].'"><img src="images/dashboard/eye.png" alt="view"></a>';

                                }?></td>
                        </tr>
                    <?php  
                    };  
                    ?>
                </table>
            </div>
            
            <div class="row">
                <ul class="pagination">
                    <li class="<?php if($page == 1){ echo 'disabled'; }?> page-item">
                        <a class="page-link" href="userdashboard.php?page=<?php echo $page-1 ; ?>" aria-label="Previous">
                            <span aria-hidden="true"><img src="images/dashboard/left-arrow.png" alt="previous"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    
                    <?php
                    
                        for($i=1;$i<=$total_pages;$i++){
                            ?>
                                
                                <li class="<?php if($page == $i) { echo 'active'; }
                                ?> page-item"><a class="page-link" href="userdashboard.php?page=<?php echo $i ; ?>"><?php echo $i ;?></a></li>
                            
                            <?php
                        }
                    
                    ?>
                    
                    <li class="<?php if($page == $total_pages){ echo 'disabled'; }?> page-item">
                        <a class="page-link" href="userdashboard.php?page=<?php echo $page+1 ; ?>" aria-label="Next">
                            <span aria-hidden="true"><img src="images/dashboard/right-arrow.png" alt="next"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        
        <div class="container table2">
            <div class="row">
                <div class="data-table-intro col-md-6">Published Notes</div>
                <form class="search-part col-md-6 text-right">
                    <input type="text" placeholder="&#x1F50D; Search">
                    <button type="button" class="btn search-btn">Search</button>
                </form>
            </div>
            <div class="row table-data table-responsive">
                <table class="table">
                    <tr class="table-heading text-center">
                        <th class="addeddate" scope="col">ADDED DATE</th>
                        <th class="title" scope="col">TITLE</th>
                        <th class="category" scope="col">CATEGORY</th>
                        <th class="selltype" scope="col">SELL TYPE</th>
                        <th class="price" scope="col">PRICE</th>
                        <th class="actions2" scope="col">ACTIONS</th>
                    </tr>
                    <?php  
                    
                    if(isset($_GET['page1'])){
                        $page1 = $_GET['page1'];
                        $page1 =mysqli_real_escape_string($connection,$page1);
                        $page1 = htmlentities($page1);
                    }else{
                        $page1 = 1;
                    }
                    
                    $num_per_page1 = 05;
                    $start_from1 = ($page1-1) * $num_per_page1;
                    $fetch_progress_query1 = "SELECT seller_notes.ID,seller_notes.CreatedDate AS added_date , seller_notes.Title AS title , note_categories.Name AS category , seller_notes.IsPaid AS ispaid , seller_notes.SellingPrice AS price FROM seller_notes, note_categories WHERE seller_notes.Category = note_categories.ID AND seller_notes.Status = 9 LIMIT $start_from1,$num_per_page1";
                    $progress_notes1 = mysqli_query($connection,$fetch_progress_query1);
                    
                    $fetch_num_query1 = "SELECT * FROM seller_notes WHERE Status = 9";
                    $fetch_num1 = mysqli_query($connection,$fetch_num_query1);
                    $total_records1 = mysqli_num_rows($fetch_num1);
                    $total_pages1 = ceil($total_records1 / $num_per_page1);
                    
                   
                    
                    
                    while ($progress_row1 = mysqli_fetch_array($progress_notes1)) {  
                    ?>
                        <tr>
                            <td><?php echo $progress_row1["added_date"]; ?></td>
                            <td><?php echo $progress_row1["title"]; ?></td>
                            <td><?php echo $progress_row1["category"]; ?></td>
                            <td><?php if($progress_row1["ispaid"] == 1)
                                        { 
                                            echo "Paid";
                                        }else
                                        {
                                            echo "Free";
                                        }
                                ?>
                            </td>
                            <td><?php echo $progress_row1["price"]; ?></td>
                            <td><a href="notedetails.php?note_id=<?php echo $progress_row1['ID'] ; ?>"><img src="images/dashboard/eye.png" alt="view"></a></td>
                        </tr>
                    <?php  
                    };  
                    ?>
                </table>
            </div>
            <div class="row">
                <ul class="pagination">
                    <li class="<?php if($page1 == 1){ echo 'disabled'; }?> page-item">
                        <a class="page-link" href="userdashboard.php?page1=<?php echo $page1-1 ; ?>" aria-label="Previous">
                            <span aria-hidden="true"><img src="images/dashboard/left-arrow.png" alt="previous"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    
                    <?php
                    
                        for($i=1;$i<=$total_pages1;$i++){
                            ?>
                                
                                <li class="<?php if($page1 == $i) { echo 'active'; }
                                ?> page-item"><a class="page-link" href="userdashboard.php?page1=<?php echo $i ; ?>"><?php echo $i ;?></a></li>
                            
                            <?php
                        }
                    
                    ?>
                    
                    <li class="<?php if($page1 == $total_pages1){ echo 'disabled'; }?> page-item">
                        <a class="page-link" href="userdashboard.php?page1=<?php echo $page1+1 ; ?>" aria-label="Next">
                            <span aria-hidden="true"><img src="images/dashboard/right-arrow.png" alt="next"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        
    </section>
    
    <!-- footer -->
    <section class="footer">
        <div class="container">
            <hr>
            <div class="row">
                <div class="col-md-6 footer_content">
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
	<!-- footer ends -->
	
	<!-- jquery-->
    <script src="js/jquery.min.js"></script>

    <!-- bootstrap js -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- custom js -->
    <script src="js/script.js"></script>

</body>
</html>