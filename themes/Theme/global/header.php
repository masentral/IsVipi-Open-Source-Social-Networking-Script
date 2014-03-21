  <link rel="shortcut icon" type="image/x-icon" href="<?php echo ISVIPI_STYLE_URL; ?>images/favicon.png">
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
   <script>$(function () { $("[data-toggle='tooltip']").tooltip(); });</script>
 </head>
      <body>
        <!-- main / large navbar -->
        <div id="top-menu">
          <nav class="navbar navbar-default top-menu" role="navigation">
            <div class="container">
                <div class="row">
                  <a href="<?php echo ISVIPI_URL.'home/' ?>" title="IsVipi Logo"><div class="admin_logo"><img src="<?php echo ISVIPI_STYLE_URL.'images/logo.png';?>" width="70%" alt="" /></div></a>
                      <div class="refresh">
                      <div id="not-bar">
                        <a href="<?php echo ISVIPI_URL.'notifications/' ?>" data-toggle="tooltip" data-placement="bottom" title="Notifications"><div class="not-boxes"><i class="fa fa-bell-o"></i><?php global $user; global $noticesno; global $pendreq; global $username; global $ getUnseenNotices($user); if ($noticesno >0){ echo '<span class="badge badge-info"> '.$noticesno.' </span>';}else{};?></div></a>
                        <a href="<?php echo ISVIPI_URL.'messages/' ?>" data-toggle="tooltip" data-placement="bottom" title="New Messages"><div class="not-boxes"><i class="fa fa-envelope-o"></i><sup><?php global $newmsg; newMsgs($user); if ($newmsg >0){ echo '<span class="badge badge-success"> '.$newmsg.' </span>';}else{};?></sup></div></a>
                        <a href="<?php echo ISVIPI_URL.'friend_requests/' ?>" data-toggle="tooltip" data-placement="bottom"title="Friends Requests"><div class="not-boxes"><i class="fa fa-user"></i><sup>
                        <?php if(pendingFReq($user)){ echo '<span class="badge badge-warning"> '.$pendreq.' </span>';}else{};?></sup></div></a>
                      </div>
                      </div>
                      <div class="user_info pull-right">
                      <?php global $t_thumb; t_thumb($user);?>
                      <?php if(htmlspecialchars($t_thumb, ENT_QUOTES, 'utf-8') == ""){$t_thumb="no-image.gif";}?>
                      <div class="profile_pic"><a href="<?php echo ISVIPI_URL.'profile/' ?><?php echo htmlspecialchars($username, ENT_QUOTES, 'utf-8');?>"><img src="<?php echo ISVIPI_PROFILE_PIC_URL.htmlspecialchars($t_thumb, ENT_QUOTES, 'utf-8');?>" height="100%" width="100%" alt="" /></a>
                      <div class="dropdown">
                        <a data-toggle="dropdown" href="#"><?php echo htmlspecialchars($username, ENT_QUOTES, 'utf-8');?><b class="caret"></b></a>
                         <ul class="dropdown-menu" role="menu">
                           <li><a href="<?php echo ISVIPI_URL.'edit_profile/' ?>">Edit Profile</a></li>
                           <li class="disabled"><a href="#">Settings</a></li>
                           <li role="presentation" class="divider"></li>
                           <li><a href="<?php echo ISVIPI_URL.'logout/' ?>">Log Out</a></li>
                         </ul>
                      </div><!--end of dropdown-->
                     </div><!--end of user_info-->
                     
                    </div><!--end of row-->
                  </div><!-- /.container -->
                </div><!--end of top-menu-->
           </nav>
