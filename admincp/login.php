<?php admin_base_header($site_title,$ACTION[1]);?>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo ISVIPI_STYLE_URL; ?>images/favicon.png">
    <link href="<?php echo ISVIPI_STYLE_URL; ?>css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="<?php echo ISVIPI_STYLE_URL; ?>fontawesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo ISVIPI_STYLE_URL; ?>admin/css/isvipi-admin.css">
    <link rel="stylesheet" href="<?php echo ISVIPI_STYLE_URL; ?>admin/css/bootstrap-mobile-navigation.css">
	<link rel="stylesheet" href="<?php echo ISVIPI_STYLE_URL; ?>css/alertify.core.css">
    <link rel="stylesheet" href="<?php echo ISVIPI_STYLE_URL; ?>css/alertify.default.css">
  </head>
  <body>
<div class="row">
	    <div class="panel panel-primary panel-admin">
	  		<div class="panel-heading">
	    		<h3 class="panel-title">Login to Admin Area</h3>
	  		</div>
	  		
	  		<div class="panel-body">
      <form method="post" action="<?php echo ISVIPI_URL.'conf/adminSelf/' ?>" class="login-form">
        <input type="hidden" name="action" value="login">
      <div class="form-group">
        <input type="email" class="form-control" name="admin_email" placeholder="Enter Email" required>
      </div>
      <div class="form-group">
        <input type="password" class="form-control" name="admin_pass" placeholder="Password" required>
      </div>
		        	<button class="btn btn-lg btn-primary btn-block" type="submit"><i class="fa fa-unlock"></i> Sign in</button>
		      	</form>
		  	</div>

		</div>            
	    
	</div>
   <script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
   <script type="text/javascript" src="<?php echo ISVIPI_STYLE_URL; ?>js/bootstrap.min.js"></script>
   <script type="text/javascript" src="<?php echo ISVIPI_STYLE_URL; ?>js/alertify.min.js"></script>
   <?php globalAlerts();?>
  </body>
</html>
