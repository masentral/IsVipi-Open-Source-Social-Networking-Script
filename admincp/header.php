<?php 
include_once ISVIPI_ADMIN_INC_BASE. 'adminFunc.php';
isAdminLoggedIn ();
admin_base_header($site_title,$ACTION[1]);
global $adminPath;
if (!isset($logoname)){$logoname == "logo.png";}
if (!isset($faviconname)){$faviconname == "favicon.png";}
?>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo ISVIPI_STYLE_URL.'images/site/'.$faviconname.'';?>">
    <link href="<?php echo ISVIPI_STYLE_URL; ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo ISVIPI_STYLE_URL; ?>fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo ISVIPI_STYLE_URL; ?>admin/css/isvipi-admin.css">
    <link rel="stylesheet" href="<?php echo ISVIPI_STYLE_URL; ?>admin/css/bootstrap-mobile-navigation.css">
	<link rel="stylesheet" href="<?php echo ISVIPI_STYLE_URL; ?>css/alertify.core.css">
    <link rel="stylesheet" href="<?php echo ISVIPI_STYLE_URL; ?>css/alertify.default.css">
    <script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
    <script>$(function () { $("[data-toggle='tooltip']").tooltip(); });</script>
	</head>
<body>
  <div class="navbar navbar-fixed-top navbar-inverse" id="header-navigation" role="navigation">
  	<div class="navbar-header">
    <a href="<?php echo ISVIPI_URL.$adminPath.'/dashboard' ?>" title="<?php echo LOGO ?>"><img src="<?php echo ISVIPI_STYLE_URL.'images/site/'.$logoname.'';?>" width="50%" alt="" /></a><span class="admin_logo_text"><?php echo ADMIN ?></span>
    </div>
    <div class="top_admin_mid">
    <a href="<?php echo ISVIPI_URL.$adminPath.'/members' ?>" title="<?php echo MANAGE_USERS ?>" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-users"></i></a>
    </div>
    <div class="top_admin_mid">
    <a href="<?php echo ISVIPI_URL.$adminPath.'/gen_settings' ?>" title="<?php echo SITE_SETTINGS ?>" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-wrench"></i></a>
    </div>
    <div class="top_admin_mid">
    <a href="<?php echo ISVIPI_URL.$adminPath.'/pages' ?>" title="<?php echo MANAGE_PAGES ?>" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-print"></i></a>
    </div>
    <div class="version_check">
    <?php siteGenSett(); 
	if ($site_status=="5"){?>
    <div class='alert alert-info'>
    <i class='fa fa-warning'></i> <a href="<?php echo ISVIPI_URL.$adminPath.'/sys_management' ?>" title='<?php echo NEW_VERSION_AVAIL_TXT ?>' data-toggle='tooltip' data-placement='bottom'><?php echo NEW_VERSION_AVAIL ?></a>
	</div>
    <?php }?>
    </div>
    <div class="admin_top_right">
    <a href="<?php echo ISVIPI_URL.$adminPath.'/logout' ?>" title="<?php echo LOGOUT ?>" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-sign-out"></i></a>
    </div>
</div>
