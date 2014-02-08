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
session_start();
$from_url = $_SERVER['HTTP_REFERER'];
$op = $_POST['op'];
if ($op !== 'step1' && $op !== 'step2'){
	$_SESSION['err'] ="Unknown request";
    header ('location:'.$from_url.'');
	exit();
}
/////////////////////////////////////////////////////////////
//////////////// STEP ONE //////////////////////////////////
////////////////////////////////////////////////////////////
if ($op === 'step1') {

//SERVER
$server = $_POST["dbhost"];
if (empty($server)) {
    $_SESSION['err'] ="Please fill in the server field";
    header ('location:'.$from_url.'');
	exit();
}
if (!preg_match('/^[a-zA-Z0-9_]{1,60}$/', $server)){
	$_SESSION['err'] ="Invalid input for server";
    header ('location:'.$from_url.'');
	exit();
}

//USERNAME
$username = $_POST["dbusername"];
if (empty($username)) {
    $_SESSION['err'] ="Please fill in the username field";
    header ('location:'.$from_url.'');
	exit();
}
if (!preg_match('/^[a-zA-Z0-9_ ]{1,60}$/', $username)){
	$_SESSION['err'] ="Invalid Input for username";
    header ('location:'.$from_url.'');
	exit();
}

//PASSWORD
$password = $_POST["dbpassword"];
if (empty($password)) {
    $_SESSION['err'] ="Please fill in the password field";
    header ('location:'.$from_url.'');
	exit();
}

//DATABASE
$database = $_POST["dbname"];
if (empty($database)) {
    $_SESSION['err'] ="Please fill in the database field";
    header ('location:'.$from_url.'');
	exit();
}
if (!preg_match('/^[a-zA-Z0-9_ ]{1,60}$/', $database)){
	$_SESSION['err'] ="Invalid Input for database";
    header ('location:'.$from_url.'');
	exit();
}
$filename = 'sql.sql';
// Connect to MySQL server
//Try to connect to the database
$db = new mysqli($server, $username, $password, $database);
if (mysqli_connect_errno()){
	$_SESSION['err'] ="Could not connect to the database";
    header ('location:install.php');
	exit();
}
//Create the db file
$db_file = '../inc/db/db.php';
if (file_exists($db_file)){
unlink($db_file);	
}
$handle = fopen($db_file, 'a') or die('Cannot open file:  '.$db_file);
$copyr = '<?php
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
 ';
fwrite($handle, $copyr);
$localhost = "\n".'$db_host = "'.$server.'";';
fwrite($handle, $localhost);
$database = "\n".'$db_name = "'.$database.'";';
fwrite($handle, $database);
$username = "\n".'$db_user = "'.$username.'";';
fwrite($handle, $username);
$password = "\n".'$db_pass = "'.$password.'";';
fwrite($handle, $password);
$conn_db = "\n"."\n".'//Try to connect to the database';
fwrite($handle, $conn_db);
$dbconnect = "\n".'$db = new mysqli($db_host, $db_user, $db_pass, $db_name);
if (mysqli_connect_errno())
	fail("MySQL connect", mysqli_connect_error());';
fwrite($handle, $dbconnect);
$select_sett = "\n".'//get important config settings from the database
$getconf = $db->prepare("SELECT site_url,site_title,site_email,theme,time_zone FROM site_settings");
$getconf->execute();
$getconf->store_result();
$getconf->bind_result($site_url,$site_title,$site_email,$theme,$time_zone);
$getconf->fetch();
$getconf->close( );';
fwrite($handle, $select_sett);
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
    mysqli_query($db, $templine) or print('Error performing query \'<strong>' . $templine . '\': ' . mysql_error() . '<br /><br />');
    // Reset temp variable to empty
    $templine = '';
}
}
 header("Location:install_step_2.php");
}

/////////////////////////////////////////////////////////////
//////////////// STEP TWO //////////////////////////////////
////////////////////////////////////////////////////////////

if ($op === 'step2') {

include_once '../inc/db/db.php';
//SITE URL
$site_url = $_POST["site_url"];
if (empty($site_url)) {
    $_SESSION['err'] ="Please fill in the site url field";
    header ('location:'.$from_url.'');
	exit();
}
if (!preg_match('/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i', $site_url)){
	$_SESSION['err'] ="Invalid input for site url";
    header ('location:'.$from_url.'');
	exit();
}

//SITE TITLE
$site_title = $_POST["site_title"];
if (empty($site_title)) {
    $_SESSION['err'] ="Please fill in the Site Title field";
    header ('location:'.$from_url.'');
	exit();
}
if (!preg_match('/^[a-zA-Z0-9_ ]{1,60}$/', $site_title)){
	$_SESSION['err'] ="Invalid input for site title";
    header ('location:'.$from_url.'');
	exit();
}	

//SITE EMAIL
$site_email = $_POST["site_email"];
if (empty($site_email)) {
    $_SESSION['err'] ="Please fill in the Site Email field";
    header ('location:'.$from_url.'');
	exit();
}
if (!preg_match('/([\w\-]+\@[\w\-]+\.[\w\-]+)/', $site_email)){
	$_SESSION['err'] ="Invalid input for site email";
    header ('location:'.$from_url.'');
	exit();
}	

//SITE TIMEZONE
$site_timezone = $_POST["time_zone"];
if (empty($site_timezone)) {
    $_SESSION['err'] ="Please fill in the Site Timezone field";
    header ('location:'.$from_url.'');
	exit();
}
if (!preg_match('/^[A-Za-z0-9:_.\/\\\\ ]+$/', $site_timezone)){
	$_SESSION['err'] ="Invalid input for site timezone";
    header ('location:'.$from_url.'');
	exit();
}	

//SITE THEME
$site_theme = $_POST["theme"];
if (!preg_match('/^[a-zA-Z0-9_]{1,60}$/', $site_theme)){
	$_SESSION['err'] ="Invalid input for hidden field theme";
    header ('location:'.$from_url.'');
	exit();
}	

//Add to our database
global $db;
$stmt = $db->prepare('insert into site_settings (site_url,site_title,site_email,theme,time_zone) values (?,?,?,?,?)');
	$stmt->bind_param('sssss', $site_url, $site_title,$site_email,$site_theme,$site_timezone);
	$stmt->execute();
	$stmt->close();
{	
$_SESSION['succ'] ="Site settings saved";
    header ('location:home.php');
	exit();
}
$_SESSION['err'] ="System Error. Please try again";
    header ('location:'.$from_url.'');
	exit();	
}