<?php 
    ob_start();  
    include 'includes/db.php'; 
    session_start();
?>
<?php  
    if(isset($_SESSION['ROLE'])){  
        if($_SESSION['ROLE'] != 3){
            header("location:../admin/admindashboard.php?admin=1");
        }
    }
?>
<?php include 'includes/indexheader.php'; ?>
    
	<!-- home -->
    <section class="home">
        <div class="container">
            <div class="row">
                <div class="home-img">
                    <img src="images/home/banner-with-overlay.jpg">
                </div>
                <div class="home-overlay col-md-7 col-sm-4">
                    <span class="heading">Download Free/Paid Notes</span><br>
                    <span class="heading">or Sale your Book</span>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Repellendus debitis adipisci ad quae<br> reprehenderit voluptatem nemo eos, totam nulla animi voluptatum.</p>
                    <div class="overlay-btn">
                        <button type="button" onclick="window.location.href='faq.php'" class="btn btn-outline-light">LEARN MORE</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
	<!-- home ends -->
	
	<!-- about -->
	<section id="about">
	    <div class="content-box-md">
	        <div class="container">
	            <div class="row">
	                <div class="col-md-6 col-sm-6">
                        <div class="about-heading">
                            <h2>About</h2>
                            <h2>Notes MarketPlace</h2>
                        </div>
	                </div>
	                <div class="col-md-6 col-sm-6">
	                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque veniam accusamus excepturi odit blanditiis architecto accusantium ad, vitae eveniet, labore repudiandae porro voluptas dignissimos. Libero, aliquam molestiae.</p>
	                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Deleniti dolores facilis iusto deserunt odio suscipit repellendus, quo illo consequatur optio. Consequatur eius.</p>
	                </div>
	            </div>
	        </div>
	    </div>
	</section>
	<!-- about ends -->
	
	<!-- work -->
	<section id="work">
	    <div class="content-box-md">
	        <div class="container">
	            <div class="work-heading text-center">
	                <h2>How it Works</h2>
	            </div>
	            <div class="row">
	                <div class="col-md-6 col-sm-6 work-tab">
	                    
	                    <div class="work-img">
	                        <img src="images/home/download.png" alt="download">
	                    </div>
	                    <div class="sub-heading">
	                        <h3>Download Free/Paid Notes</h3>
	                    </div>
	                    <div class="work-text">
	                        <p>Get Material For your <br>Cource etc.</p>
	                    </div>
	                    <div class="work-btn">
	                        <a href="#"><button type="button" onclick="window.location.href='searchnotes.php'" class="btn btn-primary work-btn" id="btn1"><p>Download</p></button></a>
	                    </div>
	                       
	                </div>
	                <div class="col-md-6 col-sm-6 work-tab">
	                    <div class="work-img">
	                        <img src="images/home/seller.png" alt="seller">
	                    </div>
	                    <div class="sub-heading sub-right-heading">
	                        <h3>Seller</h3>
	                    </div>
	                    <div class="work-text">
	                        <p>Upload and Download Cource <br> and Materials etc.</p>
	                    </div>
	                    <div class="work-btn">
	                        <a href="#"><button type="button" onclick="window.location.href='userdashboard.php'" class="btn btn-primary work-btn" id="btn2"><p>Sell Book</p></button></a>
	                    </div>

	                </div>
	            </div>
	        </div>
	    </div>
	</section>
	<!-- work ends -->
	
	<!-- testimonial -->
	<section id="customers">
	    <div class="content-box-md">
	        <div class="container-fluid">
	            <div class="row">
	                <div class="customer-heading col-md-12 col-sm-12">
	                    <h2>What our Customers are Saying</h2>
	                </div>
	                <div class="col-md-6 col-sm-12">
                        <div class="customer left-customer">   
                            <div class="customer1 row">
                                <div class="customer-img col-md-3 col-sm-3">
                                    <img src="images/home/customer-1.jpg" class="img-responsive img-circle">
                                </div>
                                <div class="customer-info col-md-9 col-sm-9">
                                    <span class="customer-name">Walter Meller</span><br>
                                    <span class="profession">Founder & CEO, Matrix Group</span>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione, modi dignissimos labore unde consectetur optio aliquam sunt, saepe eaque quis neque fugiat Officia blanditiis nobis.</p>
                            </div>
                        </div>
	                </div>
	                <div class="col-md-6 col-sm-12">
                        <div class="customer right-customer"> 
                            <div class="customer2 row">
                                <div class="customer-img col-md-3 col-sm-3">
                                    <img src="images/home/customer-2.jpg" class="img-responsive img-circle">
                                </div>
                                <div class="customer-info col-md-9 col-sm-9">
                                    <span class="customer-name">Jonnie Riley</span><br>
                                    <span class="profession">Employee, Curious Snacks</span>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione, modi dignissimos labore unde consectetur optio aliquam sunt, saepe eaque quis neque fugiat Officia blanditiis nobis.</p>
                            </div>
                        </div>
	                </div>
	                <div class="col-md-6 col-sm-12">
                        <div class="customer left-customer"> 
                            <div class="customer3 row">
                                <div class="customer-img col-md-3 col-sm-3">
                                    <img src="images/home/customer-3.jpg" class="img-responsive img-circle">
                                </div>
                                <div class="customer-info col-md-9 col-sm-9">
                                    <span class="customer-name">Amilia Luna</span><br>
                                    <span class="profession">Teacher, Saint Joseph High School</span>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione, modi dignissimos labore unde consectetur optio aliquam sunt, saepe eaque quis neque fugiat Officia blanditiis nobis.</p>
                            </div>
                        </div>
	                </div>
	                <div class="col-md-6 col-sm-12">
                        <div class="customer right-customer"> 
                            <div class="customer4 row">
                                <div class="customer-img col-md-3 col-sm-3">
                                    <img src="images/home/customer-4.jpg" class="img-responsive img-circle">
                                </div>
                                <div class="customer-info col-md-9 col-sm-9">
                                    <span class="customer-name">Daniel Cardos</span><br>
                                    <span class="profession">Software Engineer, Infinitum Company</span>
                                </div>
                            </div>
                            <div class="col-md-12 col-sm-12">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione, modi dignissimos labore unde consectetur optio aliquam sunt, saepe eaque quis neque fugiat Officia blanditiis nobis.</p>
                            </div>
                        </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</section>
	<!-- testimonial ends -->
	
    <?php include 'includes/footernlink.php'; ?>
	
    <script>
    
    function sticky_header() {
                    var header_height = jQuery('.navbar').innerHeight() / 2;
                    var scrollTop = jQuery(window).scrollTop();;
                    if (scrollTop > header_height) {
                        jQuery('body').addClass('sticky-nav')
                        $(".navbar #navbarimg").attr("src", "images/home/PicsArt_12-23-12.15.33.png");
                    } else {
                        jQuery('body').removeClass('sticky-nav')
                        $(".navbar #navbarimg").attr("src", "images/login/top-logo.png");
                    }
                }

                jQuery(document).ready(function () {
                  sticky_header();
                });

                jQuery(window).scroll(function () {
                  sticky_header();  
                });
                jQuery(window).resize(function () {
                  sticky_header();
                });

                $('.navbar .navbar-toggler-icon i').click(function () {
                    iconName = $('.navbar .navbar-toggler-icon i').attr("class");
                    if (iconName == "fa fa-bars") {
                        $('.navbar .navbar-toggler-icon i').removeClass("fa fa-bars");
                        $('.navbar .navbar-toggler-icon i').addClass("fa fa-times");
                    }
                    else {
                        $('.navbar .navbar-toggler-icon i').removeClass("fa fa-times");
                        $('.navbar .navbar-toggler-icon i').addClass("fa fa-bars");
                    }
                });
                
                $('.navbar1 .navbar-toggler-icon i').click(function () {
                iconName = $('.navbar1 .navbar-toggler-icon i').attr("class");
                if (iconName == "fa fa-bars") {
                    $('.navbar1 .navbar-toggler-icon i').removeClass("fa fa-bars");
                    $('.navbar1 .navbar-toggler-icon i').addClass("fa fa-times");
                }
                else {
                    $('.navbar1 .navbar-toggler-icon i').removeClass("fa fa-times");
                    $('.navbar1 .navbar-toggler-icon i').addClass("fa fa-bars");
                }
            });
    
    </script>
    

</body>
</html>
