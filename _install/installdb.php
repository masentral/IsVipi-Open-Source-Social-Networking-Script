<?php 
$server = $_POST["dbhost"];
$username = $_POST["dbusername"];
$password = $_POST["dbpassword"];
$database = $_POST["dbname"];
$filename = 'isvipi.sql';

$path_to_file = '../config/config.php';

//Save Database Connection Details
$file_contents = file_get_contents($path_to_file);
$file_contents = str_replace("DBHost","$server",$file_contents);
$file_contents = str_replace("DBName","$database",$file_contents);
$file_contents = str_replace("DBUser","$username",$file_contents);
$file_contents = str_replace("DBPass","$password",$file_contents);
file_put_contents($path_to_file,$file_contents);

// Connect to MySQL server
mysql_connect($server, $username, $password) or die('Error connecting to MySQL server');
// Select database
mysql_select_db($database) or die('Error selecting MySQL database');

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