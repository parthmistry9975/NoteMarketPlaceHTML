<?php ob_start(); ?>
<?php include 'includes/db.php'; ?>
<?php 
    
    session_start();
    if(isset($_SESSION['ROLE'])){
        if($_SESSION['ROLE'] != 3){
            header("location:../admin/admindashboard.php?admin=1");
        }
    }
    $Page = "faq";
?>
<?php include 'includes/header.php'; ?>
    
	<!-- Banner  -->
    <section class="banner">
        <div class="content-box-banner">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h1 class="text-center">Frequently Asked Questions</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Ends <-->
	
	<!-- faq section -->
	<section class="faq-section">
	    <div class="container">
	        <div class="row">
	            <div class="col-md-12 general-que-heading">
	                <h4>General Questions</h4>
	            </div>
	            <div class="container demo">


	                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

	                    <div class="panel panel-default">
	                        <div class="panel-heading" role="tab" id="headingOne">
	                            <h4 class="panel-title">
	                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
	                                    <i class="more-less fa fa-plus"></i>
	                                    <span>What is Marketplace Notes ?</span>
	                                </a>
	                            </h4>
	                        </div>
	                        <div id="collapseOne" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingOne">
	                            <div class="panel-body">
	                                Notes Marketplace is an online marketplace for university students to buy and sell their course notes.
	                            </div>
	                        </div>
	                    </div>

	                    <div class="panel panel-default">
	                        <div class="panel-heading" role="tab" id="headingTwo">
	                            <h4 class="panel-title">
	                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
	                                    <i class="more-less fa fa-plus"></i>
	                                    <span>What do the University say?</span>
	                                </a>
	                            </h4>
	                        </div>
	                        <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
	                            <div class="panel-body">
	                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor.
	                            </div>
	                        </div>
	                    </div>

	                    <div class="panel panel-default">
	                        <div class="panel-heading" role="tab" id="headingThree">
	                            <h4 class="panel-title">
	                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
	                                    <i class="more-less fa fa-plus"></i>
	                                    <span>Is this legal?</span>
	                                </a>
	                            </h4>
	                        </div>
	                        <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
	                            <div class="panel-body">
	                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
	                            </div>
	                        </div>
	                    </div>

	                </div><!-- panel-group -->


	            </div><!-- container -->
	            <div class="col-md-12 general-que-heading">
	                <h4>Uploaders</h4>
	            </div>
	            <div class="container demo">


	                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

	                    <div class="panel panel-default">
	                        <div class="panel-heading" role="tab" id="headingFour">
	                            <h4 class="panel-title">
	                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
	                                    <i class="more-less fa fa-plus"></i>
	                                    <span>What can't I Sell?</span>
	                                </a>
	                            </h4>
	                        </div>
	                        <div id="collapseFour" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFour">
	                            <div class="panel-body">
	                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
	                            </div>
	                        </div>
	                    </div>

	                    <div class="panel panel-default">
	                        <div class="panel-heading" role="tab" id="headingFive">
	                            <h4 class="panel-title">
	                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
	                                    <i class="more-less fa fa-plus"></i>
	                                    <span>What notes can I sell?</span>
	                                </a>
	                            </h4>
	                        </div>
	                        <div id="collapseFive" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingFive">
	                            <div class="panel-body">
	                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
	                            </div>
	                        </div>
	                    </div>

	                </div><!-- panel-group -->


	            </div><!-- container -->
	            <div class="col-md-12 general-que-heading">
	                <h4>General Questions</h4>
	            </div>
	            <div class="container demo">


	                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">

	                    <div class="panel panel-default">
	                        <div class="panel-heading" role="tab" id="headingSix">
	                            <h4 class="panel-title">
	                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
	                                    <i class="more-less fa fa-plus"></i>
	                                    <span>How do I buy notes?</span>
	                                </a>
	                            </h4>
	                        </div>
	                        <div id="collapseSix" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSix">
	                            <div class="panel-body">
	                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et.
	                            </div>
	                        </div>
	                    </div>

	                    <div class="panel panel-default">
	                        <div class="panel-heading" role="tab" id="headingSeven">
	                            <h4 class="panel-title">
	                                <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
	                                    <i class="more-less fa fa-plus"></i>
	                                    <span>Can i edit the notes I Purchased?</span>
	                                </a>
	                            </h4>
	                        </div>
	                        <div id="collapseSeven" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingSeven">
	                            <div class="panel-body">
	                                Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica.
	                            </div>
	                        </div>
	                    </div>

	                </div><!-- panel-group -->


	            </div><!-- container -->
            </div>
	    </div>
	</section>
	<!-- faq section ends -->
	
	<?php include 'includes/footernlink.php'; ?>

</body>
</html>