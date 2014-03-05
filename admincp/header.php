<?php 
include_once ISVIPI_ADMIN_INC_BASE. 'adminFunc.php';
isAdminLoggedIn ();
admin_base_header($site_title,$ACTION[1]);?>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo ISVIPI_STYLE_URL; ?>images/favicon.png">
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
    <a href="<?php echo ISVIPI_URL.'admin/dashboard' ?>" title="IsVipi Logo"><img src="<?php echo ISVIPI_STYLE_URL.'images/logo.png';?>" width="50%" alt="" /></a><span class="admin_logo_text">Admin</span>
    </div>
    <div class="top_admin_mid">
    <a href="<?php echo ISVIPI_URL.'admin/members' ?>" title="Manage Users" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-users"></i></a>
    </div>
    <div class="top_admin_mid">
    <a href="<?php echo ISVIPI_URL.'admin/gen_settings' ?>" title="Site Settings" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-wrench"></i></a>
    </div>
    <div class="top_admin_mid">
    <a href="<?php echo ISVIPI_URL.'admin/email_settings' ?>" title="Email Settings" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-envelope"></i></a>
    </div>
    <div class="version_check">
    <?php siteGenSett();?>
    <?php if($site_status=="0"||isTwoWeeks()){checkVersion();upSiteStatus("1");}?>
    </div>
    <div class="admin_top_right">
    <a href="<?php echo ISVIPI_URL.'admin/logout' ?>" title="Log Out" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-sign-out"></i></a>
    </div>
</div>
