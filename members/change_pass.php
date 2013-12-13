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
<?PHP
require_once('../lib/connections/db.php');
include('../lib/functions/functions.php');

checkLogin('2');

$getuser = getUserRecords($_SESSION['user_id']);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
	<title>Change Password</title>
	<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="robots" content="index, follow" />
	<link rel="shortcut icon" href="../favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="../css/style.css" media="screen" />

	<script type="text/javascript" src="../js/jquery-1.6.2.js"></script>
	<script type="text/javascript" src="../js/script.js"></script>
		<script type="text/javascript">
			$(document).ready(function(){
		
				$('#updatepassForm').submit(function(e) {
					updatepass();
					e.preventDefault();	
				});	
			});

		</script>
</head>

<body>
	<div align="right"><a href="index.php">Home</a> | <? if (!empty($getuser[0]['thumb_path'])){echo "<a href='manage_photo.php'>Manage My Photo</a> | ";} else {echo "<a href='upload_photo.php'>Upload Photo</a> | ";} ?><a href="change_pass.php">change password</a> | <a href="edit_profile.php">Edit Profile</a> | <a href="log_off.php?action=logoff">sign out</a></div></td>
	<p><?php if(empty($getuser[0]['first_name']) || empty($getuser[0]['last_name'])){echo $getuser[0]['username'];} else {echo $getuser[0]['first_name']." ".$getuser[0]['last_name'];} ?>, change your password.</p>
		<p class="done">Password successfully changed.</p><!--close done-->
			<div class="form">
			<h3>Change Password</h3>
			<hr/>
				<table class="searchForm" border="0" align="center">
					<form id="updatepassForm" action="change_pass_submit.php" method="post">
					<tr>
						<td><label for="old password">Old Password:</label></td><td><input name="oldpassword" type="password"/></td>
					</tr>
					<tr>
						<td><label for="new password">New Password:</label></td><td><input name="newpassword" type="password"/></td>
					</tr>
					<tr>
						<td colspan="2" align="center"><input type="submit" name="submit" value="Change Password" /><img id="loading" src="../images/loading.gif" alt="Updating.." /></td>
					</tr>
					<tr>
						<td colspan="2"><div id="error">&nbsp;</div></td>
					</tr>
					</form>
				</table>
			</div><!--close form-->
</body>
</html>