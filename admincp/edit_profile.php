<?php include_once'header.php';?>
<?php include_once'sidebar.php';?>
    <!-- Start of the container-->
    <div class="container-admin">
      <div class="page-header">
		<ul class="breadcrumb breadcrumb-admin">
  			<li><i class="fa fa-home"></i> Home</li>
  			<li class="active">Edit Profile</li>
            <span class="donate_support"><span class="label label-danger">Support IsVipi, Donate!</span></span>
        <div class="donate">
        <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=8EKWYJABNLDE2" data-toggle="tooltip" data-placement="bottom" target="_blank" title="Support us by making a donation"><img src="<?php echo ISVIPI_STYLE_URL.'images/donate.png';?>" width="100%" alt="" /></a>
        </div>
        </ul>
     </div>
     <!-- Start of main_content-->
     <div class="main_content">
     <div style="clear:both"></div>
     <div class="dash_admin_panel_cont"> <!--start of dash_cont_stat-->
       <div class="row">
     	<div class="panel panel-default midi-left">
    	<div class="panel-heading"><strong>Change Password </strong></div>
        <div class="admin_change_pass">
          <form method="POST" action="<?php echo ISVIPI_URL.'conf/adminSelf/' ?>">
          <input type="hidden" name="action" value="change_pass">
          <input type="hidden" name="admin_email" value="<?php getAdminDetails($_SESSION['admin_id']); echo $email?>">
          <div class="form-group">
        	<input type="password" class="form-control" name="new_pass" placeholder="New password" required>
      	  </div>
          <div class="form-group">
        	<input type="password" class="form-control" name="new_pass2" placeholder="Repeat new password" required>
      	  </div>
          <button class="btn btn-lg btn-primary" type="submit">Change Password</button>
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