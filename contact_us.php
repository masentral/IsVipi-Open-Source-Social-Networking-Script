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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-GB">
<head>
	<title>Contact Us.</title>
	<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="robots" content="index, follow" />
	<link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="css/style.css" media="screen" />
	
	<script type="text/javascript" src="js/jquery-1.6.2.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
		
	<script type="text/javascript">
		$(document).ready(function(){
	
			$('#contactForm').submit(function(e) {
				contactus();
				e.preventDefault();	
			});	
		});

	</script>
</head>
<body>
	<table align="center" width="100%" cellspacing="1" cellpadding="1" border="0">
	  <tr>
		<td align="left"><a href="index.php">Home</a> | <a href="login.php">Log in</a> | <a href="register.php">Register</a> | <a href="pass_reset.php">Reset Password</a> | <a href="contact_us.php">Contact Us</a></td><td align="right"><a href="admin/login.php">Admin Login</a></td>
	  </tr>
	</table>
	<hr/>
		<h3 align="center">Contact Us</h3>
			<div class="done"><H3>Thank you for your inquiry/comment.</H3> We will reply to you as soon as possible.</div><!--close done-->
				<div class="form">
					<p>All fields must be filled.</p>
					<HR/>
					<form id="contactForm" action="contact_submit.php" method="post">
						<table width="auto" align="center" border="0" cellspacing="2" cellpadding="0">
						  <tr>
							<td><label class="label" for="name">Your Names:</label></td>
							<td><input onclick="this.value='';" class="input" name="name" type="text" value="<?php if(isset($_POST['name'])){echo $_POST['name'];}?>" size="25" maxlength="50" /></td>
						  </tr>
						  <tr>
							<td><label class="label" for="email">Email Address:</label></td>
							<td><input onclick="this.value='';" class="input" name="email" type="text" value="<?php if(isset($_POST['email'])){echo $_POST['email'];}?>" size="25" maxlength="30"  /></td>
						  </tr>
						  <tr>
							<td><label class="label" for="message">Query/Comment:</label></td>
							<td align="center"><textarea class="input" name="message" cols="20" rows="4"></textarea></td>
						  </tr>
						  <tr>
							<td>&nbsp;</td>
							<td>
								<input type="submit" value="Submit" /><img id="loading" src="images/loading.gif" alt="Sending.." />
							</td>
						  </tr>
						  <tr>
							<td colspan="2"><div id="error">&nbsp;</div></td>
						  </tr>
						</table>
					</form>
				</div><!--close form-->
</body>
</html>