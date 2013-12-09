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
  <div class="alert alert-info">
    <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
    <p>Provide your database details. Once you click proceed, your database credentials will be checked and if found to be valid, the database will be imported</p>
  </div>
  <div class="panel panel-default">
  <div class="panel-heading"><h4>Database Connection Details</h4></div>
  <div class="panel-body">
  <form role="form" action="installdb.php" method="post">
  <div class="form-group">
    <label for="dbhost">Database Host</label>
    <input type="name" class="form-control" placeholder="localhost" name="dbhost">
  </div>
  <div class="form-group">
    <label for="dbusername">Database Username</label>
    <input type="name" class="form-control" placeholder="username" name="dbusername">
  </div>
  <div class="form-group">
    <label for="dbpassword">Database Password</label>
    <input type="password" class="form-control" placeholder="Password" name="dbpassword">
  </div>
  <div class="form-group">
    <label for="dbname">Database Name</label>
    <input type="name" class="form-control" placeholder="Database" name="dbname">
  </div>
  <button type="submit" class="btn btn-default">Proceed</button>
</form>
</div>
</div>
</div>
</div>  
</div>
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.js"></script>
</body>
</html>