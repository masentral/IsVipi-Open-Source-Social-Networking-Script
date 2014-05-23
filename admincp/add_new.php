<?php include_once'header.php';?>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<?php include_once'sidebar.php';?>
    <!-- Start of the container-->
    
    <div class="container-admin">
      <div class="page-header">
		<ul class="breadcrumb breadcrumb-admin">
  			<li><i class="fa fa-home"></i> <?php echo HOME ?></li>
  			<li class="active"><?php echo ADD_NEW_USER ?></li>
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
     
       <div class="all_members_page">
     	<div class="panel panel-default maxi-left">
    	<div class="panel-heading">
        <strong><?php echo ADD_NEW_USER ?></strong>
        </div>
             <form method="post" action="<?php echo ISVIPI_URL.'conf/usersManage/' ?>" class="login-form">
     <div class="admin_new_user">
        <input type="hidden" name="adm_users" value="new">
      <div class="form-group">
        <input class="form-control" type="text" name="user" placeholder="<?php echo USERNAME ?>" required="required">
      </div>
      <div class="form-group">
        <input class="form-control" type="text" name="d_name" placeholder="<?php echo DISPLAY_NAME ?>" required="required">
      </div>
      <div class="form-group">
        <input class="form-control" type="email" name="email" placeholder="<?php echo EMAIL ?>" required="required">
      </div>
      <div class="form-group">
        <input class="form-control" type="password" name="pass" placeholder="<?php echo PASSWORD ?>" required="required">
      </div>
      <div class="form-group">
        <input class="form-control" type="password" name="pass2" placeholder="<?php echo REPEAT_PASSWORD ?>" required="required">
      </div>
      <div class="form-group">
        <select name="user_gender" class="form-control input-width-mini" required="required">
           <option><?php echo MALE ?></option>
           <option selected><?php echo FEMALE ?></option>
        </select>
      </div>
      <div class="form-group">
        <input class="form-control" id="datepicker" type="text" name="user_dob" placeholder="<?php echo DOB ?>" required="required">
      </div>
      <div class="form-group">
        <input class="form-control" type="text" name="user_city" placeholder="<?php echo CITY ?>" required="required">
      </div>
      <div class="form-group">
        <?php cSelect();?>
      </div>
      <div class="form-group pull-left">
        <select name="user_status" class="form-control input-width-mini" required="required">
           <option selected value="1"><?php echo ACTIVE ?></option>
           <option value="0"><?php echo UNVALIDATED ?></option>
           <option value="3"><?php echo SUSPENDED ?></option>
        </select>
      </div>
      <div class="checkbox">
    <label>
      <input type="checkbox" name="actEmailcheck"> <?php echo SEND_ACT_EMAIL ?>
    </label>
  </div>
       <div class="modal-body">
       <button class="btn btn-primary" type="submit"><?php echo ADD_USER ?></button>
      </div>
      </form>

  		</div>  
     </div> 
<div style="clear:both"></div>
     </div>
     </div><!--end of dash_cont_stat-->
     </div><!-- End of main_content-->
    </div> <!-- End of the container-->
<?php include_once'footer.php';?>
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  </script>