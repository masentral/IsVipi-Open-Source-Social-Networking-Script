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
$localhost = 'localhost'; //name of server. Usually localhost
$database = 'isvipi'; //database name.
$username = 'root'; //database username.
$password = 'zorrayah'; //database password.

// connect to db  
$conn = mysql_connect($localhost, $username, $password) or die(header("Location: ./install/install.php"));   
$db = mysql_select_db($database,$conn) or die(header("Location: ./install/install.php"));    

//get important setings from the database
$select = "SELECT site_url FROM site_settings WHERE id = '1'";
$query = mysql_query($select) or die(mysql_error());
$result = mysql_result($query, 0);
$site_url = $result;
$site_url = 'http://'.$site_url;

// theme config
$select = "SELECT theme FROM site_settings WHERE id = '1'";
$query = mysql_query($select) or die(mysql_error());
$result = mysql_result($query, 0);
$theme = $result;
$theme = $theme;
?>