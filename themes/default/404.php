<?php include ISVIPI_THEMES_BASE.'/global/index_header.php';?>
             <?php if (isset($_SESSION['user_id'])){?>
             <?php $user = $_SESSION['user_id'];getUserDetails($user);?>
			 <?php include ISVIPI_THEMES_BASE.'/global/sidebar_menu.php';?>    
             <?php } else{?>
             <a href="<?php echo ISVIPI_URL ?>" class="btn btn-default" style="width:150px; padding:10px;margin-left:200px; margin-top:100px; float:left" role="button">Back to Homepage</a>
             
             <?php }?>
                       <div class="dash_content">
                        <div class="panel panel-primary" style="margin-right:200px; float:right;border:none; text-align:center;">
                               <div class="panel-body">
                                <h1>404 Not Found</h1>
                                <h4>The page you are looking for could not be found</h4>
                                <p style="font-size:65px"><span class="fa-stack fa-lg"><i class="fa fa-fighter-jet fa-spin"></i></span></p>
								</div>
                               </div>
                          </div><!--end of panel-->
                        </div><!--end of dash_content-->
<?php get_home_footer();?>