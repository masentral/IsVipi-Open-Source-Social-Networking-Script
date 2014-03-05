<?php include_once'header.php';?>
<link href="<?php echo ISVIPI_STYLE_URL; ?>css/tcal.css" rel="stylesheet" type="text/css" />
<?php include_once'sidebar.php';?>
    <!-- Start of the container-->
    
    <div class="container-admin">
      <div class="page-header">
		<ul class="breadcrumb breadcrumb-admin">
  			<li><i class="fa fa-home"></i> Home</li>
  			<li class="active">Add New User</li>
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
        <strong>Add New User</strong>
        </div>
             <form method="post" action="<?php echo ISVIPI_URL.'conf/usersManage/' ?>" class="login-form">
     <div class="admin_new_user">
        <input type="hidden" name="adm_users" value="new">
      <div class="form-group">
        <input class="form-control" type="text" name="user" placeholder="Username" required="required">
      </div>
      <div class="form-group">
        <input class="form-control" type="text" name="d_name" placeholder="Display Name" required="required">
      </div>
      <div class="form-group">
        <input class="form-control" type="email" name="email" placeholder="Email" required="required">
      </div>
      <div class="form-group">
        <input class="form-control" type="password" name="pass" placeholder="Password" required="required">
      </div>
      <div class="form-group">
        <input class="form-control" type="password" name="pass2" placeholder="Repeat Password" required="required">
      </div>
      <div class="form-group">
        <select name="user_gender" class="form-control input-width-mini" required="required">
           <option>Male</option>
           <option selected>Female</option>
        </select>
      </div>
      <div class="form-group">
        <input class="tcal form-control" type="text" name="user_dob" placeholder="Date of Birth" required="required">
      </div>
      <div class="form-group">
        <input class="form-control" type="text" name="user_city" placeholder="City" required="required">
      </div>
      <div class="form-group">
        <?php cSelect();?>
      </div>
      <div class="form-group pull-left">
        <select name="user_status" class="form-control input-width-mini" required="required">
           <option selected value="1">Active</option>
           <option value="0">Unvalidated</option>
           <option value="3">Suspended</option>
        </select>
      </div>
      <div class="checkbox">
    <label>
      <input type="checkbox" name="actEmailcheck"> Send Activation Email
    </label>
  </div>
       <div class="modal-body">
       <button class="btn btn-lg btn-primary" type="submit">Add User</button>
      </div>
      </form>

  		</div>  
     </div> 
<div style="clear:both"></div>
     </div>
     </div><!--end of dash_cont_stat-->
     </div><!-- End of main_content-->
    </div> <!-- End of the container-->
    
    <!--/////////////////////////////-->
   <div class="modal fade" id="AddNew" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
   <div class="modal-dialog">
   <div class="modal-content">
   <div class="modal-header">
   <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="myModalLabel">Add New User</h4>
    </div>


     </div><!-- /.modal-content -->
     </div><!-- /.modal-dialog -->
     </div><!-- /.modal -->  
     
<?php include_once'footer.php';?>
<script type="text/javascript" src="<?php echo ISVIPI_STYLE_URL; ?>js/tcal.js"></script>