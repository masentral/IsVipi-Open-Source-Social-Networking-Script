  <!-- Bootstrap -->
  <link href="<?php echo ISVIPI_THEME_URL; ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <!-- Main Style -->
  <link href="<?php echo ISVIPI_THEME_URL; ?>css/isvipi.css" rel="stylesheet" media="screen">
  <!-- FontAwesome -->
  <link rel="stylesheet" href="<?php echo ISVIPI_THEME_URL; ?>fontawesome/css/font-awesome.min.css">
  <!-- Alertify -->
  <link rel="stylesheet" href="<?php echo ISVIPI_THEME_URL; ?>css/alertify.core.css">
  <link rel="stylesheet" href="<?php echo ISVIPI_THEME_URL; ?>css/alertify.default.css">
   <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
   <script type="text/javascript" src="<?php echo ISVIPI_THEME_URL; ?>js/isvipi_alerts.js"></script>
  </head>
      <body>
        <!-- main / large navbar -->
        <div id="top-menu">
          <nav class="navbar navbar-default top-menu" role="navigation">
            <div class="container">
                <div class="row">
                  <a href="../members/" title="IsVipi Logo"><div class="admin_logo"><p class="Site_Title">IsVipi <span class="social_network">Social Network</span></p></div></a>
                      <div class="not-bar">
                        <a href="notifications.php" title="Notifications"><div class="not-boxes"><i class="fa fa-bell-o"></i><?php getUnseenNotices($user); if ($noticesno >0){ echo '<span class="badge badge-info"> '.$noticesno.' </span>';}else{};?></div></a>
                        <a href="messages.php" title="Messages"><div class="not-boxes"><i class="fa fa-envelope-o"></i><sup><?php newMsgs($user); if ($newmsg >0){ echo '<span class="badge badge-success"> '.$newmsg.' </span>';}else{};?></sup></div></a>
                        <a href="friend_requests.php" title="Friends Requests"><div class="not-boxes"><i class="fa fa-user"></i><sup>
                        <?php if(pendingFReq($user)){ echo '<span class="badge badge-warning"> '.$pendreq.' </span>';}else{};?></sup></div></a>
                      </div>
                      <div class="user_info pull-right">
                      <?php if(htmlspecialchars($thumbnail, ENT_QUOTES, 'utf-8') == ""){$thumbnail="no-image.gif";}?>
                      <div class="profile_pic"><img src="<?php echo ISVIPI_MEMBER_URL.'pics/'.htmlspecialchars($thumbnail, ENT_QUOTES, 'utf-8');?>" height="100%" width="100%" alt="" />
                      <div class="dropdown">
                        <a data-toggle="dropdown" href="#"><?php echo htmlspecialchars($username, ENT_QUOTES, 'utf-8');?><b class="caret"></b></a>
                         <ul class="dropdown-menu" role="menu">
                           <li><a href="edit_profile.php">Edit Profile</a></li>
                           <li class="disabled"><a href="#">Settings</a></li>
                           <li role="presentation" class="divider"></li>
                           <li><a href="logout.php?action=logout">Log Out</a></li>
                         </ul>
                      </div><!--end of dropdown-->
                     </div><!--end of user_info-->
                    </div><!--end of row-->
                  </div><!-- /.container -->
                </div><!--end of top-menu-->
           </nav>
