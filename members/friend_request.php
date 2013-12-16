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
<title>Friend Requests</title>
</head>

<body>
<?php
require_once('../lib/connections/db.php');
require_once('../init.php');
//We delete the discussion
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
//We check if a previous unapproved friend request was sent

//We check if the ID is defined
if(isset($_GET['id']))
{
$to_id = intval($_GET['id']);
$from_id = $getuser[0]['id'];
//We check if a previous unapproved friend request was sent
$sqlcheck = mysql_query("SELECT status FROM friend_requests WHERE (from_id='".$from_id."' AND to_id='".$to_id."') OR (to_id='".$from_id."' AND from_id='".$to_id."')");
if(mysql_num_rows($sqlcheck)>0)
	{
		die ('Error: You cannot re-submit a friend request.');
		//create a redirect below
	}
	else
	{

//If no unapproved request, we submit one
$sql = "INSERT INTO friend_requests (from_id,to_id,status,timestamp) VALUES ('".$from_id."','".$to_id."','pending',NOW())";
}
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not add friend request: ' . mysql_error());
  //create a redirect below
}
echo "Friend request added successfully\n";
mysql_close($conn);
}
?>
