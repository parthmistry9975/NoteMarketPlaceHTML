<!-- footer -->
    <section class="footer">
        <div class="container-fluid">
            <hr>
            <div class="row">
                <div class="col-md-6 footer_content">
                    <p>Copyright © <a href="https://www.tatvasoft.com/">TatvaSoft</a> All Rights Reserved.</p>
                </div>
                <div class="col-md-6 footer_social text-right">
                    <ul class="social-list">
                        <li>
                            <?php
                                
                                $fetch_furl = mysqli_query($connection,"SELECT Value FROM system_configurations WHERE ID = 6");
                                $furl = mysqli_fetch_assoc($fetch_furl);
                            
                            ?>
                            <a href="<?php echo $furl['Value']; ?>">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>
                        <li>
                            <?php
                            
                                $fetch_turl = mysqli_query($connection,"SELECT Value FROM system_configurations WHERE ID = 7");
                                $turl = mysqli_fetch_assoc($fetch_turl);
                            
                            ?>
                            <a href="<?php echo $turl['Value']; ?>">
                                <i class="fa fa-twitter"></i>
                            </a>
                        </li>
                        <li>
                            <?php
                           
                                $fetch_lurl = mysqli_query($connection,"SELECT Value FROM system_configurations WHERE ID = 8");
                                $lurl = mysqli_fetch_assoc($fetch_lurl);     
                           
                            ?>
                            <a href="<?php echo $lurl['Value']; ?>">
                                <i class="fa fa-google-plus"></i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
<!-- footer ends -->