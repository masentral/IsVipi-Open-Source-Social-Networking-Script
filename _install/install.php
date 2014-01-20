<?php
/*******************************************************
 *   Copyright (C) 2014  http://isvipi.com

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License along
    with this program; if not, write to the Free Software Foundation, Inc.,
    51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
 ******************************************************/
 session_start(); 
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
<title>Install IsVipi Social Network</title>
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/isvipi-install.css" rel="stylesheet">
    <link rel="stylesheet" href="css/alertify.core.css">
    <link rel="stylesheet" href="css/alertify.default.css">
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script type="text/javascript" src="js/isvipi_alerts.js"></script>
</head>
<body>
    <nav class="navbar navbar-fixed-top navbar-inverse" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="install.php">IsVipi Installation</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse pull-right">
          <ul class="nav navbar-nav">
            <li><a href="#about">Documentation</a></li>
            <li><a href="#contact">Help</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container -->
    </nav>
  <div class="row">
  <div class="alert alert-info">
    <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
    <p>Please provide your database details.</p>
  </div>
  <div class="panel panel-default">
  <div class="panel-heading"><h4>Database Connection Details</h4></div>
  <div class="panel-body">
  <form role="form" action="installdb.php" method="post">
  <div class="form-group">
    <label for="dbhost">Database Host</label>
    <input type="name" class="form-control" placeholder="localhost" name="dbhost" required>
  </div>
  <div class="form-group">
    <label for="dbusername">Database Username</label>
    <input type="name" class="form-control" placeholder="username" name="dbusername" required>
  </div>
  <div class="form-group">
    <label for="dbpassword">Database Password</label>
    <input type="password" class="form-control" placeholder="Password" name="dbpassword" required>
  </div>
  <div class="form-group">
    <label for="dbname">Database Name</label>
    <input type="name" class="form-control" placeholder="Database" name="dbname" required>
  </div>
  <input type="hidden" name="op" value="step1">
  <button type="submit" class="btn btn-default">Proceed</button>
</form>
</div>
</div>
</div>
</div>  
</div>
<?php
if (isset($_GET['action'])) {
$action = $_GET['action'];
//Sanitize GET code
if (!preg_match('/^[a-zA-Z0-9_]{1,60}$/', $action));
 }
 if (isset($_SESSION['err']))$err = $_SESSION['err'];
 if (isset($_SESSION['succ']))$succ = $_SESSION['succ'];
 
if (isset($action)){($action =="logout")?>
<script>
$(document).ready( function () {
alertify.success("You have successfully logged out");
})
</script>
<?php } else if (isset($err)) {?>
 <script>
$(document).ready( function () {
alertify.error("<?php echo $err?>");
})
</script>
<?php 
unset ($_SESSION['err']);
 } else if (isset($succ)) {?>
 <script>
$(document).ready( function () {
alertify.success("<?php echo $succ ?>");
})
</script>
<?php 
unset ($_SESSION['succ']);
 }
?>
<script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
<script src="js/bootstrap.js"></script>
<script type="text/javascript" src="js/alertify.min.js"></script>
</body>
</html>