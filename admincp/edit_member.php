<?php 
	 if (isset($ACTION[2])){
		 $xid = $ACTION[2];
			xtractUID($xid);
	} else {
		$_SESSION['err'] =E_EDIT_USER;
		header ('location:'.ISVIPI_URL.'admin/members/.');
		exit();
	}
	 getUserDetails($uid);
	 getMemberDet($uid);
	 ?>
<?php include_once'header.php';?>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<?php include_once'sidebar.php';?>
    <!-- Start of the container-->
    
    <div class="container-admin">
      <div class="page-header">
		<ul class="breadcrumb breadcrumb-admin">
  			<li><i class="fa fa-home"></i> <?php echo HOME ?></li>
  			<li class="active"><?php echo EDIT_USER ?></li>
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
        <strong><?php echo EDIT_USER ?></strong>
        </div>
      <form method="post" action="<?php echo ISVIPI_URL.'conf/usersManage/' ?>" class="login-form">
     <div class="admin_new_user">
        <input type="hidden" name="adm_users" value="edit_user">
        <input type="hidden" name="userid" value="<?php echo $uid ?>">
      <div class="form-group">
      <label><?php echo USERNAME ?></label>
        <input class="form-control" type="text" name="user" value="<?php echo $username ?>" required="required" disabled="disabled">
      </div>
      <div class="form-group">
      <label><?php echo DISPLAY_NAME ?></label>
        <input class="form-control" type="text" name="d_name" value="<?php echo $m_name ?>" required="required">
      </div>
      <div class="form-group">
      <label><?php echo EMAIL ?></label>
        <input class="form-control" type="email" name="email" value="<?php echo $email ?>" required="required">
      </div>
      <div class="form-group">
      <label><?php echo GENDER ?></label>
        <select name="user_gender" class="form-control">
        <option <?php if(htmlspecialchars($m_gender, ENT_QUOTES, 'utf-8') == "Male"){echo("selected");}?>><?php echo MALE ?></option>
        <option <?php if(htmlspecialchars($m_gender, ENT_QUOTES, 'utf-8') == "Female"){echo("selected");}?>><?php echo FEMALE ?></option>
        </select>
      </div>
      <div class="form-group">
      <label><?php echo DOB ?></label>
        <input type="text" name="dob" class="form-control" id="datepicker" value="<?php echo htmlspecialchars($m_dob, ENT_QUOTES, 'utf-8');?>" />
      </div>
      <div class="form-group">
      <label><?php echo PHONE_NO ?></label>
         <input type="text" name="phone" class="form-control" value="<?php echo htmlspecialchars($m_phone, ENT_QUOTES, 'utf-8');?>"/>
     </div>
      <div class="form-group">
      <label><?php echo CITY ?></label>
        <input class="form-control" type="text" name="user_city" value="<?php echo $m_city ?>" required="required">
      </div>
      <div class="form-group">
      <label><?php echo COUNTRY ?></label>
        <input class="form-control" type="text" value="<?php echo $m_country ?>"  disabled="disabled">
      </div>
      <div class="form-group">
        <?php cSelect();?>
      </div>
      <div class="form-group">
       <button class="btn btn-primary" type="submit"><?php echo UPDATE_PROFILE ?></button>
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