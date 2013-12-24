<!DOCTYPE html>
<html class="bootstrap-admin-vertical-centered">
    <head>
        <title>IsVipi - Open Source Social Networking Script</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <!-- Bootstrap -->
  <link href="<?php echo ISVIPI_THEME_URL; ?>/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

  <!-- Main Style -->
  <link href="<?php echo ISVIPI_THEME_URL; ?>/css/homepage.css" rel="stylesheet" media="screen">
        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
           <script type="text/javascript" src="js/html5shiv.js"></script>
           <script type="text/javascript" src="js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>
    <!-- Full Page Image Header Area -->
    <div id="top" class="header">
                  <div class="row">
                  <div class="home_register">
                  <form method="post" action="<?php echo ISVIPI_CORE_URL; ?>user_login.php" class="login-form">
                    <h1>Login</h1>
                    <div class="form-group">
                        <input class="form-control" type="text" name="username" value="<?php if(isset($_POST['username'])){echo $_POST['username'];}?>" placeholder="Username" onclick="this.value='';">
                    </div>
                    <div class="form-group">
                        <input class="form-control" type="password" name="password" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label>
                            <input type="checkbox" name="remember_me">
                            Remember me
                        </label>
                    </div>
                    <button class="btn btn-lg btn-primary" type="submit">Submit</button>
                </form>
            </div>
          </div>
    </div>
        <div class="container">
        </div>

        <script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript">
            $(function() {
                // Setting focus
                $('input[name="email"]').focus();

                // Setting width of the alert box
                var formWidth = $('.bootstrap-admin-login-form').innerWidth();
                var alertPadding = parseInt($('.alert').css('padding'));
                $('.alert').width(formWidth - 2 * alertPadding);
            });
        </script>
    </body>
</html>
