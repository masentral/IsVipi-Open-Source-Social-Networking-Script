<?php include_once'header.php';?>
<?php include_once'sidebar.php';?>
    <!-- Start of the container-->
    <div class="container-admin">
      <div class="page-header">
		<ul class="breadcrumb breadcrumb-admin">
  			<li><i class="fa fa-home"></i> <?php echo HOME ?></li>
  			<li class="active"><?php echo EDIT_PROFILE ?></li>
            <span class="donate_support"><span class="label label-danger"><?php echo DONATE ?></span></span>
        <div class="donate">
        <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=8EKWYJABNLDE2" data-toggle="tooltip" data-placement="bottom" target="_blank" title="<?php echo DONATE_TEXT ?>"><img src="<?php echo ISVIPI_STYLE_URL.'images/donate.png';?>" width="100%" alt="" /></a>
        </div>
        </ul>
     </div>
     <!-- Start of main_content-->
     <div class="main_content">
     <div style="clear:both"></div>
     <div class="dash_admin_panel_cont"> <!--start of dash_cont_stat-->
       <div class="row">
     	<div class="panel panel-default midi-left">
    	<div class="panel-heading"><strong><?php echo CHANGE_PASS ?> </strong></div>
        <div class="admin_change_pass">
          <form method="POST" action="<?php echo ISVIPI_URL.'conf/adminSelf/' ?>">
          <input type="hidden" name="action" value="change_pass">
          <input type="hidden" name="admin_email" value="<?php getAdminDetails($_SESSION['admin_id']); echo $email?>">
          <div class="form-group">
        	<input type="password" class="form-control" name="new_pass" placeholder="<?php echo NEW_PASS ?>" required>
      	  </div>
          <div class="form-group">
        	<input type="password" class="form-control" name="new_pass2" placeholder="<?php echo REP_NEW_PASS ?>" required>
      	  </div>
          <button class="btn btn-lg btn-primary" type="submit"><?php echo CHANGE_PASS ?></button>
          </form>
  		</div> 
        </div> 
        <!--<div class="panel panel-default midi-left2">
    	<div class="panel-heading"><strong>Password Recovery Email </strong></div>
        <div class="admin_change_pass">
        
        </div>
  		</div> -->
     </div> 
<div style="clear:both"></div>
     </div>
     </div><!--end of dash_cont_stat-->
     </div><!-- End of main_content-->
    </div> <!-- End of the container-->
<?php include_once'footer.php';?>