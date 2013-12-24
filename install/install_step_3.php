<?php
/*******************************************************
 *   Copyright (C) 2013  http://isvipi.com

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
  <div class="alert alert-success">
    <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
    <p><strong>Success!</strong> The database has been imported successfully</a>.</p>
  </div>
  <div class="panel panel-default">
  <div class="panel-heading"><h4>Create Admin Account</h4></div>
  <div class="panel-body">
  
  <form role="form" action="../lib/core/admin_registration.php" method="post" onSubmit="return validate()">
  <div class="form-group">
    <label for="dbhost">Admin Username</label>
    <input type="username" class="form-control" placeholder="Admin Username" name="username">
  </div>
  <div class="form-group">
    <label for="dbpassword">Admin E-Mail</label>
    <input type="email" class="form-control" placeholder="Admin E-Mail" name="email">
  </div>
  <div class="form-group">
    <label for="dbname">Password</label>
    <input type="password" class="form-control" placeholder="Password" name="password">
  </div>
  <div class="form-group">
    <label for="dbname">Repeat Password</label>
    <input type="password" class="form-control" placeholder="Repeat Password" name="rpassword">
  </div>
  <button type="submit" class="btn btn-default">Create</button>
</form>
</div>
  </div>
</div>
</div>  
<script type="text/javascript">
function validate(){

    if(!document.getElementById("password").value==document.getElementById("rpassword").value)alert("Passwords do no match");
    return document.getElementById("password").value==document.getElementById("rpassword").value;
   return false;
    }
	</script>
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>