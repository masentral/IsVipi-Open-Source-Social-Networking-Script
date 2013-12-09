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
    <script type="text/javascript">
 $(window).load(function(){
        $('#myModal').modal('show');
    });
</script>
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
<!-- Modal -->
<div class="modal fade shown" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="false">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title info" id="myModalLabel">Database Configuration Error!</h4>
      </div>
      <div class="modal-body">
        <p>There is an error with the database configurations you provided. Please try out the following:</p>
        <ul>
        <li>Provide database host as "localhost" or "127.0.0.1"</li>
        <li>For the username and password, check spelling, capitalizations or other special characters</li>
        </ul>
        <p>Click "back to install page" to try again</p>
      </div>
      <div class="modal-footer">
        <a href="install.php"><button type="button" class="btn btn-primary">Go back to install page</button></a>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script src="js/jquery-1.10.2.js"></script>
<script src="js/bootstrap.js"></script>
</body>
<script type="text/javascript">
$(document).ready(function($) {  
  function show_modal(){
    $('#myModal').modal();
  }
  window.setTimeout(show_modal, 0009); // your 5 seconds delay before it calls the modal function
});
</script>
</html>