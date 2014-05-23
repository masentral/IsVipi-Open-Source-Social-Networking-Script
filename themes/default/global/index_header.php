<?php global $adminPath; global $logoname; global $faviconname;
if (!isset($logoname)){$logoname == "logo.png";}
if (!isset($faviconname)){$faviconname == "favicon.png";}
?>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo ISVIPI_STYLE_URL.'images/site/'.$faviconname.'';?>">
  <!-- Bootstrap -->
  <link href="<?php echo ISVIPI_STYLE_URL; ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <!-- Main Style -->
  <link href="<?php echo ISVIPI_STYLE_URL; ?>css/isvipi.css" rel="stylesheet" media="screen">
  <!-- FontAwesome -->
  <link rel="stylesheet" href="<?php echo ISVIPI_STYLE_URL; ?>fontawesome/css/font-awesome.min.css">
  <!-- Alertify -->
  <link rel="stylesheet" href="<?php echo ISVIPI_STYLE_URL; ?>css/alertify.core.css">
  <link rel="stylesheet" href="<?php echo ISVIPI_STYLE_URL; ?>css/alertify.default.css">
   <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
   <script type="text/javascript" src="<?php echo ISVIPI_STYLE_URL; ?>js/isvipi_alerts.js"></script>
  </head>
      <body>
        <!-- main / large navbar -->
        <div id="top-menu">
          <nav class="navbar navbar-default top-menu" role="navigation">
            <div class="container">
                <div class="row">
                  <a href="<?php echo ISVIPI_URL ?>" title="IsVipi Logo"><div class="admin_logo"><img src="<?php echo ISVIPI_STYLE_URL.'images/site/'.$logoname.'';?>" width="70%" alt="" /></div></a>
                  
                  			<div class="index_login">
                            <?php if (signedIn()){?>
                            <span class="label label-info" style="font-size:12px; min-width:100px;padding:12px;"><?php echo CURRENTLY_LOGGED_IN ?><a class="home_link" href="<?php echo ISVIPI_URL.'home/' ?>"> <?php echo MY_HOME ?></a>
							<?php echo OR_HOME ?> <a class="home_link" href="<?php echo ISVIPI_URL.'logout/' ?>"> <?php echo LOGOUT ?></a> </span>
                            <?php } else if (isAdmin()){?>
                            <span class="label label-info" style="font-size:12px; min-width:100px;padding:12px;"><?php echo LOGGED_IN_AS_ADMIN ?><a class="home_link" href="<?php echo ISVIPI_URL.$adminPath.'/dashboard/' ?>"> <?php echo TO_ADMIN_BACKEND ?></a></span>
                            <?php } else {?>
                            <form class="form-inline" action="<?php echo ISVIPI_USER_PROCESS; ?>" method="POST">
                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" placeholder="<?php echo ENTER_EMAIL ?>" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="pass" placeholder="<?php echo PASSWORD ?>" required>
                                </div>
                                <input type="hidden" name="op" value="login">
                                <button type="submit" class="btn btn-primary"><?php echo SIGN_IN ?></button>
                                <script>$(function () { $("[data-toggle='tooltip']").tooltip(); });</script>
                                <a href="<?php echo ISVIPI_URL.'auth/forgot_password' ?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo FORGOT_PASSWORD ?>"><span style="margin-left:10px; font-size:20px; color:#0C0;"><i class="fa fa-question-circle"></i></span></a>
                            </form>
                            <?php }?>
                           </div>
                    </div><!--end of row-->
                  </div><!-- /.container -->
                </div><!--end of top-menu-->
           </nav>