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
	$_SESSION['succ'] =UPD_SUCCESS;
	echo "<meta http-equiv='refresh' content='5'>";
	
	}
}
include_once'sidebar.php';?>
    <!-- Start of the container-->
    <div class="container-admin">
      <div class="page-header">
		<ul class="breadcrumb breadcrumb-admin">
  			<li><i class="fa fa-home"></i> <?php echo HOME ?></li>
  			<li class="active"><?php echo SYS_MGMT ?></li>
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
    	<div class="panel-heading"><strong><?php echo SYS_UPDATES ?> </strong></div>
        <div class="padded">
        <div class="pull-left" style="margin-right:10px">
          <form method="post" action="">
          <input type="hidden" name="checkUpdate" value="checkUpdate">
          <?php if ($site_status !="5"){?>
           <div class='alert alert-info pull-left' style="margin-top:0px; margin-right:10px; width:200px">
          <?php echo INSTALLED_VER ?> <strong><?php echo VERSION ?></strong>
          <?php if(isset($_SESSION['up-to-date'])){echo SYS_UP_TO_DATE;
		  unset ($_SESSION['up-to-date']);
		  }?>
          </div>
          <button type="submit" class="btn btn-primary pull-right"><?php echo CHECK_FOR_UPDTS ?></button>
           <?php }?>
          </form>
          </div>
          <?php if ($site_status=="5"){?>
          <div>
    		<form method="post" action="">
          	<input type="hidden" name="sysUpdate" value="sysUpdate">
            <button type="submit" class="btn btn-success"><?php echo NEW_VER_AVAIL ?></button>
          </form>
          </div>
          <div class='alert alert-info' style="margin-top:5px">
            <?php echo NEW_VER_AVAIL_INS ?>
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
          
          <div class="panel-heading"><strong><?php echo DB_BACKUP ?> </strong></div>
          <div class="padded">
          <form method="post" action="">
          <input type="hidden" name="backUp" value="backUp">
          <button type="submit" class="btn btn-primary"><?php echo BACKUP_DB_PROC ?></button>
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
          <div class='alert alert-info' style="margin:5px; padding:3px">
          <?php echo ADMIN_URL_L1 ?>
          <li><strong><?php echo ADMIN_URL_L2 ?></strong></li>
          <li><?php echo ADMIN_URL_L3 ?></li>
          <li style="color:#F00"><?php echo ADMIN_URL_L5 ?> </li>
          </div>
           <tbody>
           <form role="form" action="<?php echo ISVIPI_URL.'conf/adminSettings/' ?>" method="post">
           <input type="hidden" name="action" value="adminURL" />
           <tr>
            <td width="200"><input type="text" class="form-control" name="admPath" value="<?php echo $adminPath?>"></td>
           <td><button type="submit" class="btn btn-default"><?php echo UPDATE ?></button></td>
           </tr>
           </form>
           </tbody>
           </table>
           <?php global $site_url ?>
           <p style="padding-left:10px; margin-top:10px"><strong><?php echo ADMIN_URL_L4 ?></strong> <?php echo $site_url.'/'.$adminPath ?></p>
           <hr />
           <div class="panel-heading"><strong><?php echo GEN_SITEMAP ?> </strong></div>
          <div class="padded">
          <form method="post" action="">
          <input type="hidden" name="genSitemap" value="genSitemap">
          <button type="submit" class="btn btn-primary"><?php echo GEN_SITEMAP ?></button>
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