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

$path_to_file = '../lib/connections/db.php';

// Connect to MySQL server
mysql_connect($server, $username, $password) or die(header("Location: ./installErr.php"));
// Select database
mysql_select_db($database) or die(header("Location: ./installErr.php"));

//Save Database Connection Details
$file_contents = file_get_contents($path_to_file);
$file_contents = str_replace("DBHost","$server",$file_contents);
$file_contents = str_replace("DBName","$database",$file_contents);
$file_contents = str_replace("DBUser","$username",$file_contents);
$file_contents = str_replace("DBPass","$password",$file_contents);
file_put_contents($path_to_file,$file_contents);

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