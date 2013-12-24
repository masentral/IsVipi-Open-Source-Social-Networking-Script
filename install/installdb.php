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
$server = $_POST["dbhost"];
$username = $_POST["dbusername"];
$password = $_POST["dbpassword"];
$database = $_POST["dbname"];
$filename = 'sql.sql';

// Connect to MySQL server
mysql_connect($server, $username, $password) or die(header("Location: ./installErr.php"));
// Select database
mysql_select_db($database) or die(header("Location: ./installErr.php"));

//Create the db file
$my_file = '../lib/db/db.php';
$handle = fopen($my_file, 'a') or die('Cannot open file:  '.$my_file);
$test = '<?php
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
 ?>';
fwrite($handle, $test);
$open_php = "\n".'<?php';
fwrite($handle, $open_php);
$localhost = "\n".'$localhost = "'.$server.'";';
fwrite($handle, $localhost);
$database = "\n".'$database = "'.$database.'";';
fwrite($handle, $database);
$username = "\n".'$username = "'.$username.'";';
fwrite($handle, $username);
$password = "\n".'$password = "'.$password.'";';
fwrite($handle, $password);
$conn_db = "\n"."\n".'//connect to database';
fwrite($handle, $conn_db);
$dbconnect = "\n".'$conn = mysql_connect($localhost, $username, $password) or die("Error: Could not connect to database");';
fwrite($handle, $dbconnect);
$select_db = "\n".'//select database';
fwrite($handle, $select_db);
$dbselect = "\n".'$db = mysql_select_db($database,$conn) or die("Error: Could not select a database");';
fwrite($handle, $dbselect);
$theme_conf = "\n"."\n".'// theme config
$select = "SELECT theme FROM site_settings";
$query = mysql_query($select) or die(mysql_error());
$result = mysql_result($query, 0);
$theme = $result;
$theme = $theme;
date_default_timezone_set ("Africa/Nairobi");';
fwrite($handle, $theme_conf);
$close_php = "\n".'?>';
fwrite($handle, $close_php);

// Temporary variable, used to store current query
$templine = '';
// Read in entire file
$lines = file($filename);
// Loop through each line
foreach ($lines as $line)
{
// Skip it if it's a comment
if (substr($line, 0, 2) == '--' || $line == '')
    continue;

// Add this line to the current segment
$templine .= $line;
// If it has a semicolon at the end, it's the end of the query
if (substr(trim($line), -1, 1) == ';')
{
    // Perform the query
    mysql_query($templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
    // Reset temp variable to empty
    $templine = '';
}
}
 header("Location:install_step_2.php");

?>