<?php include_once'header.php';?>
<?php include_once'sidebar.php';?>
    <!-- Start of the container-->
    <div class="container-admin">
      <div class="page-header">
		<ul class="breadcrumb breadcrumb-admin">
  			<li><i class="fa fa-home"></i> <?php echo HOME ?></li>
  			<li class="active"><?php echo GENERAL_SETT ?></li>
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
    	<div class="panel-heading"><strong><?php echo GENERAL_SETT ?> </strong></div>
          <form method="post" action="<?php echo ISVIPI_URL.'conf/adminSettings/' ?>">
          <?php siteGenSett();?>
          <input type="hidden" name="action" value="GenS">
          <table>
           <tbody>
           <tr>
           <td><input type="text" class="form-control" name="site_url" value="<?php echo $site_url ?>" required></td>
           <td width="150"><strong><?php echo S_URL ?></strong></td>
           </tr>
           <tr>
           <td><input type="text" class="form-control" value="<?php echo $site_title ?>" name="site_title" required></td>
           <td width="150"><strong><?php echo S_TITLE ?></strong></td>
           </tr>
           <tr>
           <td><input type="email" class="form-control" value="<?php echo $site_email ?>" name="site_email" required></td>
           <td width="150"><strong><?php echo S_EMAIL ?></strong></td>
           </tr>
           <tr>
           <td><?php chooseTimeZone(); ?></td>
			<td width="150"><strong><?php echo DEF_TIMEZONE ?></strong></td>
           </tr>
           <tr>
           <td><?php selectLang() ?></td>
			<td width="150"><strong><?php echo SITE_LANGUAGE ?></strong></td>
           </tr>
           <tr>
           <td>
           <button type="submit" class="btn btn-primary"><?php echo SAVE_SETT ?></button></td>
           </tr>
           </tbody>
          </table>
          </form>
          <hr />
          <div class="panel-heading"><strong><?php echo OTHER_SETT ?> </strong></div>
          <?php getAdminGenSett()?>
          <form method="post" action="<?php echo ISVIPI_URL.'conf/adminSettings/' ?>">
          <input type="hidden" name="action" value="otherSett">
          <table class="table">
           <tbody>
           <tr>
           <td><strong><?php echo DISALLOW_REG ?></strong> <a href="#" title="<?php echo DISALLOW_REG_I ?>" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-question"></i></a></td>
           <td width="70"><input type="checkbox" name="AllowReg" value="1" <?php if ($usrReg=="1"){echo "checked='checked'";}?> /></td>
           </tr>
           <tr>
           <td><strong><?php echo VALIDATE_ACC ?></strong> <a href="#" title="<?php echo VALIDATE_ACC_I ?>" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-question"></i></a></td>
           <td><input type="checkbox" name="usrValidate" value="1" <?php if ($usrValid=="1"){echo "checked='checked'";}?>></td>
           </tr>
           <tr>
           <td><strong><?php echo SYS_TIMEZONE ?></strong> <a href="#" title="<?php echo SYS_TIMEZONE_I ?>" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-question"></i></a></td>
           <td><input type="checkbox" name="sysZone" value="1" <?php if ($timeZ=="1"){echo "checked='checked'";}?>></td>
           </tr>
           <tr>
           <td><strong><?php echo MAINT_MODE ?></strong> <a href="#" title="<?php echo MAINT_MODE_I ?>" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-question"></i></a></td>
           <td width="70"><input type="checkbox" name="sysMaint" <?php if ($site_status=="3"){echo "checked='checked'";}?> / value="1"></td>
           </tr>
           <tr>
           <td><strong><?php echo ENABLE_MOBILE_THEME ?></strong> <a href="#" title="<?php echo ENABLE_MOBILE_THEME_TXT ?>" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-question"></i></a></td>
           <td width="70"><input type="checkbox" name="mobileTheme" <?php if ($mobileEnabled=="1"){echo "checked='checked'";}?> / value="1"></td>
           </tr>
           <tr>
           <td><strong><?php echo SYS_CRON ?> </strong> <a href="#" title="<?php echo SYS_CRON_I ?>" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-question"></i></a></td>
           <td><input type="checkbox" name="sysCron" value="1" <?php if ($sysCron=="1"){echo "checked='checked'";}?>></td>
           </tr>
           <?php if ($sysCron=="0"){?>
           <tr>
           <td>
           <div class="alert alert-info">
     <?php echo SYS_CRON_I_HINT ?> <br />
     <hr />
     <strong>*/5 * * * * /usr/bin/wget -O /dev/null <?php global $site_url; echo $site_url.'/cron'?></strong>
     </div>
           </td>
           <td></td>
           </tr>
           <?php }?>
           <tr>
           <td><button type="submit" class="btn btn-primary"><?php echo SAVE_SETT ?></button></td>
           <td></td>
           </tr>
           </tbody>
           </table>
           </form>
                     <div class="panel-heading"><strong><?php echo ADD_NEW_LANGUAGE ?> </strong></div>
          <div class='alert alert-info' style="margin:5px; padding:3px">
          <ul>
			<?php echo LANG_INSTR_TXT?>
          </ul>
          </div>
          <form method="post" action="<?php echo ISVIPI_URL.'conf/adminSettings/' ?>">
          <input type="hidden" name="action" value="newLang">
          <table>
           <tr>
           <td width="200"><input type="text" class="form-control" name="officialName" value="" placeholder="<?php echo LANG_OFF_EG;?>" required></td>
           <td width="200"><strong><?php echo OFFICIAL_NAME ?></strong></td>
           </tr>
           <tr>
           <td width="200"><input type="text" class="form-control" name="abbrev" value="" placeholder="<?php echo LANG_ABBR_EG;?>" required></td>
           <td width="200"><strong><?php echo ABBREV ?> (<?php echo MAX_5_CHR ?>)</strong></td>
           </tr>
           <td>
           <button type="submit" class="btn btn-primary"><?php echo ADD_LANGUAGE ?></button>
           </td>
           </tr>
          </table>
          </form>
          <hr />

  		</div>  
        <div class="panel panel-default midi-left2">
    	<div class="panel-heading"><strong><?php echo THEME_SETT ?> </strong></div>
          <table class="table">
           <tbody>
           <form role="form" action="<?php echo ISVIPI_URL.'conf/adminSettings/' ?>" method="post">
           <tr><td></td></tr>
           <tr>
           <td width="200"><span class="label label-info" style="font-size:14px;"><strong><?php echo $theme ?></strong></span></td>
           <td><strong><?php echo CURR_THEME ?></strong></td>
           </tr>
           <tr><td></td></tr>
           <tr><td></td></tr>
           <tr>
            <td width="200"><?php selectTheme()?></td>
           <td><strong><?php echo AVAILABLE_THEMES ?></strong></td>
           </tr>
           <tr>
           <td><input type="hidden" name="action" value="c_theme"></td>
           <td><button type="submit" class="btn btn-default"><?php echo UPDATE ?></button></td>
           </tr>
           </form>
           </tbody>
           </table>
           <hr />
           <table class="table">
           <tbody>
           <form action="<?php echo ISVIPI_URL.'conf/adminSettings/' ?>" method="post" enctype="multipart/form-data">
           <tr>
           <label>&nbsp;&nbsp;<?php echo UPLOAD_NEW_THEME ?></label>
           <td width="200"><input type="file" class="form-control" name="new_theme"></td>
           </tr>
           <tr>
           <input type="hidden" name="action" value="upTheme">
           <td><button type="submit" class="btn btn-default"><?php echo UPLOAD ?></button></td>
           </tr>
           </form>
           </tbody>
          </table>
          <div style="clear:both; margin-top:20px"></div>
    	<div class="panel-heading"><strong><?php echo SEO_SETT ?> </strong></div>
        <div class="seo_form">
        <div class="alert alert-info">
        <strong><?php echo N_SEO_TXT ?></strong>
        </div>
        <?php getSEO() ?>
        <form role="form" action="<?php echo ISVIPI_URL.'conf/adminSettings/' ?>" method="post"> 
       	<input type="hidden" name="action" value="updSEO">
        <div class="form-group">
        <p style="margin-left:10px"><label><?php echo META_TAGS_TXT ?></label></p>
        <input type="text" class="form-control" name="meta_tags" value="<?php echo $meta_tags ?>" required>
      	</div>
        <div class="form-group">
        <p style="margin-left:10px"><label><?php echo META_DESC ?></label></p>
        <textarea class="form-control" name="meta_description"><?php echo $meta_description ?></textarea>
      	</div>
        <button class="btn btn-primary" type="submit"> <?php echo UPDATE ?></button>
        </form>
        </div>
        
        <hr />
        <div class="panel-heading"><strong><?php echo LOGO_FAVICON ?> </strong></div>
        <div class="alert alert-info">
        <?php echo N_LOGO_FAVICON_TXT ?>
        </div>
        <hr />
           <table class="table">
           <tbody>
           <form action="<?php echo ISVIPI_URL.'conf/SiteImages/' ?>" method="post" enctype="multipart/form-data">
           <tr>
           <label>&nbsp;&nbsp;<?php echo "Upload Logo" ?></label>
           <td width="200"><input type="file" class="form-control" name="file"></td>
           </tr>
           <tr>
           <input type="hidden" name="op" value="logo">
           <td><button type="submit" class="btn btn-default"><?php echo UPLOAD ?></button></td>
           </tr>
           <tr>
           <td><div class="admin_logo"><img src="<?php echo ISVIPI_STYLE_URL.'images/site/'.$logoname.'';?>" width="70%" /></div></td>
           </tr>
           </form>
           </tbody>
          </table>
          <hr />
           <table class="table">
           <tbody>
           <form action="<?php echo ISVIPI_URL.'conf/SiteImages/' ?>" method="post" enctype="multipart/form-data">
           <tr>
           <label>&nbsp;&nbsp;<?php echo "Upload favicon" ?></label>
           <td width="200"><input type="file" class="form-control" name="file"></td>
           </tr>
           <tr>
           <input type="hidden" name="op" value="favicon">
           <td><button type="submit" class="btn btn-default"><?php echo UPLOAD ?></button></td>
           </tr>
           <tr>
           <td><div class="favicon_admin"><img src="<?php echo ISVIPI_STYLE_URL.'images/site/'.$faviconname.'';?>" width="70%" /></div></td>
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