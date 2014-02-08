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
include_once '../init.php';
include_once DOC_ROOT. '../inc/users.inc/users.func.php';
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>IsVipi System Installation</title>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo ISVIPI_STYLE_URL; ?>images/favicon.png">
  <!-- Bootstrap -->
  <link href="../inc/style.lib/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
  <link href="../inc/style.lib/css/isvipi-install.css" rel="stylesheet" media="screen">
  <!-- FontAwesome -->
  <link rel="stylesheet" href="../inc/style.lib/fontawesome/css/font-awesome.min.css">
  <!-- Alertify -->
  <link rel="stylesheet" href="../inc/style.lib/css/alertify.core.css">
  <link rel="stylesheet" href="../inc/style.lib/css/alertify.default.css">
   <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
</head>
<body>
    <nav class="navbar navbar-fixed-top navbar-inverse" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="install.php">IsVipi Installation</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse navbar-ex1-collapse pull-right">
          <ul class="nav navbar-nav">
            <li><a href="http://isvipi.com/documentation" target="_blank">Documentation</a></li>
            <li><a href="http://forum.isvipi.com" target="_blank">Help/Forum</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container -->
    </nav>
    <div class="system_requirements">
    <h4>System Requirements Check</h4>
    <div class="alert alert-warning">
   <?php 
   if (phpversion()<5.3){
	$sys_req = 'err';
   echo '<div class="alert alert-danger">';
   echo 'Your php version is below 5.3';
   echo '</div>';
   }
   else{
   echo '<div class="alert alert-success">';
   echo 'Your php version is above 5.3';
   echo '</div>';
   }
ob_start(); 
phpinfo(INFO_MODULES); 
$info = ob_get_contents(); 
ob_end_clean(); 
$info = stristr($info, 'Client API version'); 
preg_match('/[1-9].[0-9].[1-9][0-9]/', $info, $match); 
$gd = $match[0]; 
if ($gd<4.1){
	$sys_req = 'err';
   echo '<div class="alert alert-danger">';
   echo 'Your mysql version is below 4.1';
   echo '</div>';
   }
else{
   echo '<div class="alert alert-success">';
   echo 'Your mysql version is above 4.1';
   echo '</div>';
   }
?>
    </div>
    </div>
  <div class="row">
  <?php 
  $db_file_path = '../inc/db/db.php';
if (file_exists($db_file_path)){
?>
  <div class="alert alert-danger">
    <p>db.php file exists. Proceeding with the installation will delete the current db.php file and create a new one. If you are aware of this please proceed with the installation.</p>
  </div>
  <?php
}?>
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
  <?php if (isset($sys_req)){ echo '<span class="label label-info">Your server failed system check and cannot continue with installation</span>'; } else {?>
  <button type="submit" class="btn btn-default" >Proceed</button>
  <?php }?>
</form>
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
<script type="text/javascript" src="../inc/style.lib/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../inc/style.lib/js/alertify.min.js"></script>
</body>
</html>