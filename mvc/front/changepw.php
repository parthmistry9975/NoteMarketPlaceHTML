<!DOCTYPE html>
<html lang="en">
<head>

	<!-- meta tags -->
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">

	<!-- Title -->
	<title>Notes MarketPlace</title>
    
    <!-- Website Logo -->
    <link rel="shortcut icon" href="images/dashboard/favicon.ico">
	
	<!-- google fonts -->
	<link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <!-- font awesome css -->
    <link rel="stylesheet" href="css/fontawesome/css/font-awesome.min.css">    
    
    
    <!-- bootstrap css -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap/bootstrap.min.css">

    <!-- custom css -->
    <link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>
    
	<!-- preloader -->
    <div id="preloader">
        <div id="status">&nbsp;</div>
    </div>
    
    <!-- forgot password -->
    <section id="change-pw">
        
        <!-- background image -->
        <img class="bg-image img-responsive" src="images/login/banner-with-overlay.jpg" alt="login background">
        
        <div class="change-password-form">
            
            <!-- logo -->
            <img src="images/login/top-logo.png" alt="Notes MarketPlace">
            
            <!-- forgot form -->
            <div class="change-form">
                
                <div class="change-heading text-center">
                    <h2>Change Password</h2>    
                    <p>Enter your new password to change your password</p>
                </div>
                
                <form action="">
                    
                    <div class="form-group">
                    <label for="exampleInputPassword1">Old Password</label>
                    <input type="password" class="form-control form-control-sm" id="exampleInputPassword1" placeholder="Enter your old password">
                    <span toggle="#exampleInputPassword1" class="fa fa-eye-slash fa-eye field-icon toggle-password"></span>
                    </div>
                    
                    <div class="form-group">
                    <label for="exampleInputPassword2">New Password</label>
                    <input type="password" class="form-control form-control-sm" id="exampleInputPassword2" placeholder="Enter your new password">
                    <span toggle="#exampleInputPassword2" class="fa fa-eye-slash fa-eye field-icon toggle-password"></span>
                    </div>
                    
                    <div class="form-group">
                    <label for="exampleInputPassword3">Confirm Password</label>
                    <input type="password" class="form-control form-control-sm" id="exampleInputPassword3" placeholder="Enter your confirm password">
                    <span toggle="#exampleInputPassword3" class="fa fa-eye-slash fa-eye field-icon toggle-password"></span>
                    </div>
                    
                    <button type="submit" class="btn">submit</button>
                    
                </form>
                
            </div>
        
        </div>
    </section>
    <!-- forgot password ends --> 
    
	<!-- jquery-->
    <script src="js/jquery.min.js"></script>

    <!-- bootstrap js -->
    <script src="js/bootstrap/bootstrap.min.js"></script>

    <!-- custom js -->
    <script src="js/script.js"></script>

</body>
</html>