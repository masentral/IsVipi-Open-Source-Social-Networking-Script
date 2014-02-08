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
  <div class="row">
  <div class="alert alert-success">
    <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
    <p>Installation successful.</p>
  </div>
  <div class="panel panel-default">
  <div class="panel-body">
  <p>Your site should be working fine now. We are still working on the admin side of the script and will be released soon. Please visit our <a href="http://forum.isvipi.com" target="_blank">forum</a> if you have questions or suggestions for the next releases.</p>
   <p>You can also subscribe to our feeds by email to be notified when we release the admin side of the script.</p>
   <p>You can also donate to the project to help provide more scripts like these for free. To donate please <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=8EKWYJABNLDE2" target="_blank">follow this link</a></p>
   <p><a href="../" target="_blank">Visit my site</a></p>
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
</html>