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
<?php
require_once('../db/db.php');
include('../functions/admin_functions.php');

//For registration

	// we check if everything is filled in and perform checks

	if(!$_POST['site_url'])
	{
		die("<p>Please provide the site URL. </p>");
	}
	elseif(!$_POST['site_email'])
	{
		die("<p>Please provide your site's official email address.</p>");
	}

	else
		{
$site_url = $_POST['site_url'];
$site_email = $_POST['site_email'];
$theme = $_POST['theme'];
$time_zone = $_POST['time_zone'];
$sql = "INSERT INTO site_settings (site_url,site_email,theme,time_zone) VALUES ('".$site_url."','".$site_email."','".$theme."','".$time_zone."')";
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not add friend request: ' . mysql_error());
  //create a redirect below
}
die(header("Location: ../../install/install_step_3.php"));
mysql_close($conn);
		}
?>
