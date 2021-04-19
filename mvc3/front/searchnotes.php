<?php ob_start(); ?>
<?php include 'includes/db.php'; ?>
<?php  

    session_start();
    if(isset($_SESSION['ROLE'])){
        if($_SESSION['ROLE'] != 3){
            header("location:../admin/admindashboard.php?admin=1");
        }
    }
    $Page = "searchpage";
?>

<?php include 'includes/header.php'; ?>
    
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
            
            
        </div>
        
        <?php include 'includes/footer.php'; ?>
        
    </section>
	<!-- filter ends -->
	
	<?php include 'includes/scriptlink.php'; ?>
    
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
    
        $(document).ready(function() {
            
            get_notes(<?php if(isset($_SESSION['currentpage'])){ echo $_SESSION['currentpage']; }else { echo "1";}?>);
        
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
                get_notes();
            });

            $("#type").change(function(){
                get_notes();
            });

            $("#category").change(function(){
                get_notes();
            });

            $("select#university").change(function(){
                get_notes();
            });

            $("select#course").change(function(){
                get_notes();
            });

            $("select#country").change(function(){
                get_notes();
            });
            
            $("select#rating").change(function(){
                get_notes();
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