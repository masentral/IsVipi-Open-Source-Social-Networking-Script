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
                  <a href="<?php echo ISVIPI_URL ?>" title="IsVipi Logo"><div class="admin_logo"><p class="Site_Title">IsVipi <span class="social_network">Social Network</span></p></div></a>
                  
                  			<div class="index_login">
                            <?php /** if(checkLogin())
								{
									$user = $_SESSION['user_id'];
 									getUserDetails($user);
									echo '<div class="alert alert-success">';
									echo 'welcome back '.$d_name.'. ';
									echo 'Go to <a href="members/">My Dashboard</a> or <a href="members/logout.php?action=logout">Logout</a>';
									echo '</div>';
								}
								else{ **/
								?>
                            <form class="form-inline" action="<?php echo ISVIPI_USER_INC_URL. 'users.process.php'?>" method="POST">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="user" placeholder="Enter Username" required>
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control" name="pass" placeholder="Password" required>
                                </div>
                                <input type="hidden" name="op" value="login">
                                <button type="submit" class="btn btn-primary">Sign in</button>
                            </form>
                            <?php // }?>
                           </div>
                    </div><!--end of row-->
                  </div><!-- /.container -->
                </div><!--end of top-menu-->
           </nav>
