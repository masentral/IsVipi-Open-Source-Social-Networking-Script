<?php 
	 if (isset($ACTION[2])){
		 $xid = $ACTION[2];
			xtractUID($xid);
	} else {
		$_SESSION['err'] ="Please select a user to edit";
		header ('location:'.ISVIPI_URL.'admin/members/.');
		exit();
	}
	 getUserDetails($uid);
	 getMemberDet($uid);
	 ?>
<?php include_once'header.php';?>
<link href="<?php echo ISVIPI_STYLE_URL; ?>css/tcal.css" rel="stylesheet" type="text/css" />
<?php include_once'sidebar.php';?>
    <!-- Start of the container-->
    
    <div class="container-admin">
      <div class="page-header">
		<ul class="breadcrumb breadcrumb-admin">
  			<li><i class="fa fa-home"></i> Home</li>
  			<li class="active">Edit User</li>
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
     
       <div class="all_members_page">
     	<div class="panel panel-default maxi-left">
    	<div class="panel-heading">
        <strong>Edit User</strong>
        </div>
      <form method="post" action="<?php echo ISVIPI_URL.'conf/usersManage/' ?>" class="login-form">
     <div class="admin_new_user">
        <input type="hidden" name="adm_users" value="edit_user">
        <input type="hidden" name="userid" value="<?php echo $uid ?>">
      <div class="form-group">
        <input class="form-control" type="text" name="user" value="<?php echo $username ?>" required="required" disabled="disabled">
      </div>
      <div class="form-group">
        <input class="form-control" type="text" name="d_name" value="<?php echo $m_name ?>" required="required">
      </div>
      <div class="form-group">
        <input class="form-control" type="email" name="email" value="<?php echo $email ?>" required="required">
      </div>
      <div class="form-group">
        <select name="user_gender" class="form-control">
        <option <?php if(htmlspecialchars($m_gender, ENT_QUOTES, 'utf-8') == "Male"){echo("selected");}?>>Male</option>
        <option <?php if(htmlspecialchars($m_gender, ENT_QUOTES, 'utf-8') == "Female"){echo("selected");}?>>Female</option>
        </select>
      </div>
      <div class="form-group">
        <input type="text" name="dob" class="form-control tcal" size="1" value="<?php echo htmlspecialchars($m_dob, ENT_QUOTES, 'utf-8');?>" />
      </div>
      <div class="form-group">
         <input type="text" name="phone" class="form-control" value="<?php echo htmlspecialchars($m_phone, ENT_QUOTES, 'utf-8');?>" placeholder="Phone number"/>
     </div>
      <div class="form-group">
        <input class="form-control" type="text" name="user_city" value="<?php echo $m_city ?>" required="required">
      </div>
      <div class="form-group">
        <input class="form-control" type="text" value="<?php echo $m_country ?>"  disabled="disabled">
      </div>
      <div class="form-group">
        <?php cSelect();?>
      </div>
       <button class="btn btn-primary" type="submit">Save Details</button>
      </form>

  		</div>  
     </div> 
<div style="clear:both"></div>
     </div>
     </div><!--end of dash_cont_stat-->
     </div><!-- End of main_content-->
    </div> <!-- End of the container-->
    
<?php include_once'footer.php';?>
<script type="text/javascript" src="<?php echo ISVIPI_STYLE_URL; ?>js/tcal.js"></script>