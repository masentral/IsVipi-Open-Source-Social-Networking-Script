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
 
$db_host = "localhost";
$db_name = "my_database_name";
$db_user = "my_database_username";
$db_pass = "my_database_password";

//Try to connect to the database
$db = new mysqli($db_host, $db_user, $db_pass, $db_name);
if (mysqli_connect_errno())
	fail("MySQL connect", mysqli_connect_error());
//get important config settings from the database
$getconf = $db->prepare("SELECT site_url,site_title,site_email,theme,time_zone FROM site_settings");
$getconf->execute();
$getconf->store_result();
$getconf->bind_result($site_url,$site_title,$site_email,$theme,$time_zone);
$getconf->fetch();
$getconf->close( );
?>