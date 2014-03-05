<?php include_once'header.php';?>
<?php include_once'sidebar.php';?>
    <!-- Start of the container-->
    <div class="container-admin">
      <div class="page-header">
		<ul class="breadcrumb breadcrumb-admin">
  			<li><i class="fa fa-home"></i> Home</li>
  			<li class="active">Email Settings</li>
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
     <div class="alert alert-danger">
     Be careful while making changes to these templates. <strong>DO NOT ALTER the structure unless you know what you are doing</strong>!
     </div>
       <div class="row">
     	<div class="panel panel-default midi-left">
    	<div class="panel-heading"><strong>Activation Email </strong></div>
          <form method="post" action="<?php echo ISVIPI_URL.'conf/adminEmails/' ?>">
          <input type="hidden" name="eml" value="ActEmail">
          <table>
           <tbody>
           <tr>
           <td>Subject: <input type="text" class="form-control" name="subject" value="<?php actEmail(); echo $act_subject?>"></td>
           </tr>
           <tr>
           <td width="450">Message: <textarea class="form-control" name="activationEmail" rows="8" required="required"><?php actEmail(); echo $activation_email?></textarea></td>
           </tr>
           <tr>
           <td>
           <button type="submit" class="btn btn-primary">Save Message Template</button></td>
           </tr>
           </tbody>
          </table>
          </form>
  		</div>  
        <div class="panel panel-default midi-left2">
    	<div class="panel-heading"><strong>Password Recovery Email </strong></div>
          <table class="table">
           <tbody>
          <form method="post" action="<?php echo ISVIPI_URL.'conf/adminEmails/' ?>">
          <input type="hidden" name="eml" value="recEmail">
          <table>
           <tbody>
           <tr>
           <td>Subject: <input type="text" class="form-control" name="subject" value="<?php passRecovEmail(); echo $rec_subject?>"></td>
           </tr>
           <tr>
           <td width="450">Message: <textarea class="form-control" name="rec_email" rows="8" required="required"><?php passRecovEmail(); echo $recov_email?></textarea></td>
           </tr>
           <tr>
           <td>
           <button type="submit" class="btn btn-primary">Save Message Template</button></td>
           </tr>
           </tbody>
          </table>
          </form>
           </tbody>
           </table>
  		</div> 
     </div> 
     <div class="alert alert-info">
     $site_title (Your website title), $user (username of email recipient), $site_url (your site url)</strong>
     </div>
<div style="clear:both"></div>
     </div>
     </div><!--end of dash_cont_stat-->
     </div><!-- End of main_content-->
    </div> <!-- End of the container-->
<?php include_once'footer.php';?>