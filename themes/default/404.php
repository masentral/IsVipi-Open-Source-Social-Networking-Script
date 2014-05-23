<?php get_home_header()?>
             <?php if (isset($_SESSION['user_id'])){?>
             <?php $user = $_SESSION['user_id'];getUserDetails($user);?>
			 <?php include ISVIPI_THEMES_BASE.'/global/sidebar_menu.php';?>    
             <?php } else{?>
             <a href="<?php echo ISVIPI_URL ?>" class="btn btn-default" style="width:150px; padding:10px;margin-left:200px; margin-top:100px; float:left" role="button"><?php echo BACK_TO_HOME ?></a>
             
             <?php }?>
                       <div class="dash_content">
                        <div class="panel panel-primary" style="margin-right:200px; float:right;border:none; text-align:center;">
                               <div class="panel-body" style="border:solid thin #CCC; border-radius:5px">
                                <h1><?php echo E404_NOT_FOUND ?></h1>
                                <h4><?php echo E404_TXT ?></h4>
								</div>
                               </div>
                               <div style="clear:both"></div>
                          </div><!--end of panel-->
                        </div><!--end of dash_content-->
<?php get_home_footer()?>