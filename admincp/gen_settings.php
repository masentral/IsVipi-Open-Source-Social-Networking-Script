<?php include_once'header.php';?>
<?php include_once'sidebar.php';?>
    <!-- Start of the container-->
    <div class="container-admin">
      <div class="page-header">
		<ul class="breadcrumb breadcrumb-admin">
  			<li><i class="fa fa-home"></i> Home</li>
  			<li class="active">General Settings</li>
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
    	<div class="panel-heading"><strong>General Settings </strong></div>
          <form method="post" action="<?php echo ISVIPI_URL.'conf/adminSettings/' ?>">
          <?php siteGenSett();?>
          <input type="hidden" name="action" value="GenS">
          <table>
           <tbody>
           <tr>
           <td><input type="text" class="form-control" name="site_url" value="<?php echo $site_url ?>" required></td>
           <td width="150"><strong>Site URL</strong></td>
           </tr>
           <tr>
           <td><input type="text" class="form-control" value="<?php echo $site_title ?>" name="site_title" required></td>
           <td width="150"><strong>Site Title/Name</strong></td>
           </tr>
           <tr>
           <td><input type="email" class="form-control" value="<?php echo $site_email ?>" name="site_email" required></td>
           <td width="150"><strong>Site E-Mail</strong></td>
           </tr>
           <tr>
           <td><?php chooseTimeZone(); ?></td>
			<td width="150"><strong>Default Time Zone</strong></td>
           </tr>
           <tr>
           <td>
           <button type="submit" class="btn btn-primary">Save Settings</button></td>
           </tr>
           </tbody>
          </table>
          </form>
          <hr />
          
          <div class="panel-heading"><strong>Other Settings </strong></div>
          <?php getAdminGenSett()?>
          <form method="post" action="<?php echo ISVIPI_URL.'conf/adminSettings/' ?>">
          <input type="hidden" name="action" value="otherSett">
          <table class="table">
           <tbody>
           <tr>
           <td><strong>Disallow user registration</strong> <a href="#" title="When checked, only an admin will be able to create user accounts" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-question"></i></a></td>
           <td width="70"><input type="checkbox" name="AllowReg" value="1" <?php if ($usrReg=="1"){echo "checked='checked'";}?> /></td>
           </tr>
           <tr>
           <td><strong>Users have to validate their accounts</strong> <a href="#" title="Users will have to confirm their email addresses before they can log in after registration" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-question"></i></a></td>
           <td><input type="checkbox" name="usrValidate" value="1" <?php if ($usrValid=="1"){echo "checked='checked'";}?>></td>
           </tr>
           <tr>
           <td><strong>Switch to system Time Zone</strong> <a href="#" title="If the time indicated in user feeds, messages e.t.c is not accurate, check this box to switch to system time" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-question"></i></a></td>
           <td><input type="checkbox" name="sysZone" value="1" <?php if ($timeZ=="1"){echo "checked='checked'";}?>></td>
           </tr>
           <tr>
           <td><strong>Change site status to maintenance mode</strong> <a href="#" title="This is useful during site updates." data-toggle="tooltip" data-placement="bottom"><i class="fa fa-question"></i></a></td>
           <td width="70"><input type="checkbox" name="sysMaint" <?php if ($site_status=="3"){echo "checked='checked'";}?> / value="1"></td>
           </tr>
           <tr>
           <td><strong>Use system Cron Job </strong> <a href="#" title="When checked, the system cron job will run when a user visits your site" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-question"></i></a></td>
           <td><input type="checkbox" name="sysCron" value="1" <?php if ($sysCron=="1"){echo "checked='checked'";}?>></td>
           </tr>
           <?php if ($sysCron=="0"){?>
           <tr>
           <td>
           <div class="alert alert-info">
     You can set up a cronjob on your server to run every 5 minutes using the code below. If you can't set it up on your server then just check the box above <br />
     <hr />
     <strong>*/5 * * * * /usr/bin/wget -O /dev/null <?php global $site_url; echo $site_url.'/cron'?></strong>
     </div>
           </td>
           <td></td>
           </tr>
           <?php }?>
           <tr>
           <td><button type="submit" class="btn btn-primary">Save Settings</button></td>
           <td></td>
           </tr>
           </tbody>
           </table>
           </form>
  		</div>  
        <div class="panel panel-default midi-left2">
    	<div class="panel-heading"><strong>Theme Settings </strong></div>
          <table class="table">
           <tbody>
           <form role="form" action="<?php echo ISVIPI_URL.'conf/adminSettings/' ?>" method="post">
           <tr><td></td></tr>
           <tr>
           <td width="200"><span class="label label-info" style="font-size:14px;"><strong><?php echo $theme ?></strong></span></td>
           <td><strong>Current Theme</strong></td>
           </tr>
           <tr><td></td></tr>
           <tr><td></td></tr>
           <tr>
            <td width="200"><?php selectTheme()?></td>
           <td><strong>Available Themes</strong></td>
           </tr>
           <tr>
           <td><input type="hidden" name="action" value="c_theme"></td>
           <td><button type="submit" class="btn btn-default">Update</button></td>
           </tr>
           </form>
           </tbody>
           </table>
           <hr />
           <table class="table">
           <tbody>
           <form action="<?php echo ISVIPI_URL.'conf/adminSettings/' ?>" method="post" enctype="multipart/form-data">
           <tr>
           <label>&nbsp;&nbsp;Upload new Theme</label>
           <td width="200"><input type="file" class="form-control" name="new_theme"></td>
           </tr>
           <tr>
           <input type="hidden" name="action" value="upTheme">
           <td><button type="submit" class="btn btn-default">Upload</button></td>
           </tr>
           </form>
           </tbody>
          </table>
  		</div> 
     </div> 
<div style="clear:both"></div>
     </div>
     </div><!--end of dash_cont_stat-->
     </div><!-- End of main_content-->
    </div> <!-- End of the container-->
<?php include_once'footer.php';?>