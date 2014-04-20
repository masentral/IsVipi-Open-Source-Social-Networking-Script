<?php 
include_once'header.php';
if(isset($_POST['checkUpdate']))
{
    $check = $_POST['checkUpdate'];
	$sanitized = get_post_var($check);
	if ($sanitized = "checkUpdate"){
	$checkUpdate = TRUE;
	}
}
if(isset($_POST['backUp']))
{
    $check = $_POST['backUp'];
	$sanitized = get_post_var($check);
	if ($sanitized = "backUp"){
	$dbBackUp = TRUE;
	}
}
if(isset($_POST['genSitemap']))
{
    $check = $_POST['genSitemap'];
	$sanitized = get_post_var($check);
	if ($sanitized = "genSitemap"){
	$genSitemap = TRUE;
	}
}
if(isset($_POST['sysUpdate']))
{
    $check = $_POST['sysUpdate'];
	$sanitized = get_post_var($check);
	if ($sanitized = "sysUpdate"){
	updateSystem();
	upSiteStatus('1');
	$_SESSION['succ'] ="Update successful. The site will be auto-refreshed in 5 seconds";
	echo "<meta http-equiv='refresh' content='5'>";
	
	}
}
include_once'sidebar.php';?>
    <!-- Start of the container-->
    <div class="container-admin">
      <div class="page-header">
		<ul class="breadcrumb breadcrumb-admin">
  			<li><i class="fa fa-home"></i> Home</li>
  			<li class="active">System Management</li>
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
    	<div class="panel-heading"><strong>System Updates </strong></div>
        <div class="padded">
        <div class="pull-left" style="margin-right:10px">
          <form method="post" action="">
          <input type="hidden" name="checkUpdate" value="checkUpdate">
          <?php if ($site_status !="5"){?>
           <div class='alert alert-info pull-left' style="margin-top:0px; margin-right:10px; width:200px">
          Installed Version: <strong><?php echo VERSION ?></strong>
          <?php if(isset($_SESSION['up-to-date'])){echo "system up to date";
		  unset ($_SESSION['up-to-date']);
		  }?>
          </div>
          <button type="submit" class="btn btn-primary pull-right">Check for Updates</button>
           <?php }?>
          </form>
          </div>
          <?php if ($site_status=="5"){?>
          <div>
    		<form method="post" action="">
          	<input type="hidden" name="sysUpdate" value="sysUpdate">
            <button type="submit" class="btn btn-success">New Version Available, click to install</button>
          </form>
          </div>
          <div class='alert alert-info' style="margin-top:5px">
            <h4>NOTE: Before your update, make sure you...</h4>
            <li>..have a backup of your database</li>
            <li>..have a backup of your themes folder if you made any changes</li>
            <li>..have a backup of any other changes you made to the system files</li>
            <br />
            <p><strong>Clicking update will overwrite all the existing files and therefore any custom mods will be lost.</strong><br /><br />
            During the update process your site will switch to "<strong>Maintenance Mode</strong>" then switch back once done!
            </p>
            </div>
		  <?php } ?>
          <div style="clear:both"></div>
          </div>
          <?php if (isset($checkUpdate)){
			  checkVersion();
			 echo "<meta http-equiv='refresh' content='0'>";
		  }
		  ?>
          <hr />
          
          <div class="panel-heading"><strong>Database Backup </strong></div>
          <div class="padded">
          <form method="post" action="">
          <input type="hidden" name="backUp" value="backUp">
          <button type="submit" class="btn btn-primary">Backup Database</button>
           </form>
           <?php if (isset($dbBackUp)){
			  genBackUp();
		   }
			  ?>
           </div>
  		</div>  
        <div class="panel panel-default midi-left2">
    	<div class="panel-heading"><strong>Admin URL </strong></div>
          <table class="table">
          <div class='alert alert-success' style="margin:5px; padding:3px">
          Changing the url to your admin backend will make your site more secure. 
          <li><strong>MAXIMUM 50 characters!</strong></li>
          <li>You can choose any name apart from "<strong>admincp</strong>"</li>
          </div>
           <tbody>
           <form role="form" action="<?php echo ISVIPI_URL.'conf/adminSettings/' ?>" method="post">
           <input type="hidden" name="action" value="adminURL" />
           <tr>
            <td width="200"><input type="text" class="form-control" name="admPath" value="<?php echo $adminPath?>"></td>
           <td><button type="submit" class="btn btn-default">Update</button></td>
           </tr>
           </form>
           </tbody>
           </table>
           <?php global $site_url ?>
           <p style="padding-left:10px; margin-top:10px"><strong>Current path to admin:</strong> <?php echo $site_url.'/'.$adminPath ?></p>
           <hr />
           <div class="panel-heading"><strong>Generate Sitemap </strong></div>
          <div class="padded">
          <form method="post" action="">
          <input type="hidden" name="genSitemap" value="genSitemap">
          <button type="submit" class="btn btn-primary">Generate Sitemap</button>
           </form>
           <?php if (isset($genSitemap)){
			  genSitemap();
		   }
			  ?>
              <?php if (isset($_SESSION['sitemap'])){?>
              <span style="color:#090; font-size:16px"><i class="fa fa-check-circle"></i></span>
              <?php echo $site_url.'/sitemap'?>
              <?php unset ($_SESSION['sitemap']);}?>
           </div>
  		</div>  
  		</div> 
     </div> 
<div style="clear:both"></div>
     </div>
     </div><!--end of dash_cont_stat-->
     </div><!-- End of main_content-->
    </div> <!-- End of the container-->
<?php include_once'footer.php';?>