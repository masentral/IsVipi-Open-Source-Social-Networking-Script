  <!-- Bootstrap -->
  <link href="<?php echo ISVIPI_THEME_URL; ?><?php echo $theme; ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <!-- Main Style -->
  <link href="<?php echo ISVIPI_THEME_URL; ?><?php echo $theme; ?>/css/isvipi.css" rel="stylesheet" media="screen">
  <!-- FontAwesome -->
  <link rel="stylesheet" href="<?php echo ISVIPI_THEME_URL; ?><?php echo $theme; ?>/fontawesome/css/font-awesome.min.css">
        
  <!-- Vendors -->
  <link href="<?php echo ISVIPI_THEME_URL; ?><?php echo $theme; ?>/vendors/easypiechart/jquery.easy-pie-chart.css" rel="stylesheet" media="screen">
  <link href="<?php echo ISVIPI_THEME_URL; ?><?php echo $theme; ?>/vendors/easypiechart/jquery.easy-pie-chart_custom.css" rel="stylesheet" media="screen">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
           <script type="text/javascript" src="js/html5shiv.js"></script>
           <script type="text/javascript" src="js/respond.min.js"></script>
        <![endif]-->
    </head>
      <body>
        <!-- main / large navbar -->
        <div id="top-menu">
          <nav class="navbar navbar-default top-menu" role="navigation">
            <div class="container">
                <div class="row">
                  <a href="../members/" title="IsVipi Logo"><div class="admin_logo"><p class="Site_Title">IsVipi <span class="social_network">Social Network</span></p></div></a>
                      <div class="not-bar">
                        <a href="" title="Notifications"><div class="not-boxes"><i class="fa fa-bell-o"></i><sup><span class="badge badge-info">3</span></sup></div></a>
                        <a href="messages.php" title="Messages"><div class="not-boxes"><i class="fa fa-envelope-o"></i><sup><span class="badge badge-success"><?php echo intval(mysql_num_rows($req1)); ?></span></sup></div></a>
                        <a href="" title="Friends Requests"><div class="not-boxes"><i class="fa fa-user"></i><sup><span class="badge badge-warning">1</span></sup></div></a>
                      </div>
                      <div class="user_info pull-right">
                      <div class="profile_pic"><img src="<?=$getuser[0]['thumb_path'];?>" height="100%" width="100%" alt="" />
                      <div class="dropdown">
                        <a data-toggle="dropdown" href="#"><?=$getuser[0]['username'];?> <b class="caret"></b></a>
                         <ul class="dropdown-menu" role="menu">
                           <li><a href="edit_profile.php">Edit Profile</a></li>
                           <li><a href="settings.php">Settings</a></li>
                           <li role="presentation" class="divider"></li>
                           <li><a href="log_off.php?action=logoff">Log Out</a></li>
                         </ul>
                      </div><!--end of dropdown-->
                     </div><!--end of user_info-->
                    </div><!--end of row-->
                  </div><!-- /.container -->
                </div><!--end of top-menu-->
           </nav>
