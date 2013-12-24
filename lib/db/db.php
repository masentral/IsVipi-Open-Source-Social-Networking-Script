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
$localhost = "localhost";
$database = "isvipi";
$username = "root";
$password = "zorrayah";

//connect to database
$conn = mysql_connect($localhost, $username, $password) or die("Error: Could not connect to database");
//select database
$db = mysql_select_db($database,$conn) or die("Error: Could not select a database");


date_default_timezone_set ("Africa/Nairobi");
?>