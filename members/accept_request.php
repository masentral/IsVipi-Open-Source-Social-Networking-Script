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
require_once('../lib/core/load.class.php');
include_core_files();
checkLogin('2');

$getuser = getUserRecords($_SESSION['user_id']);
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Accept Request</title>
</head>

<body>
<?php
//We check if the ID of the discussion is defined
if(isset($_GET['id']))
{
$reqid = intval($_GET['id']);
//Retrieve IDs of the sender and receiver based on the request ID
$getids = mysql_query('SELECT from_id,to_id from friend_requests WHERE request_id = "'.$reqid.'"');
while($row = mysql_fetch_array($getids))
{
  $from_id = $row['from_id'];
  $to_id = $row['to_id'];
}
//We check if they are already friends
$sqlcheck = mysql_query("SELECT * FROM my_friends WHERE (user1='".$from_id."' AND user2='".$to_id."') OR (user2='".$from_id."' AND user1='".$to_id."')");
if(mysql_num_rows($sqlcheck)>0)
	{
		die ('Error: Cannot accept friend request again.');
		//create a redirect below
	}
else
	{
//Add retrieved IDs to my friendlist table
$sql = 'INSERT INTO my_friends '.
       '(id,user1, user2, timestamp) '.
       'VALUES ( "", "'.$from_id.'", "'.$to_id.'", NOW() ),
	   ( "", "'.$to_id.'", "'.$from_id.'", NOW() )';
if(! $sql )
{
  die('Could not enter data: ' . mysql_error());
}
//Delete friend request from friend requests table
$update = mysql_query('UPDATE friend_requests SET status = "0" WHERE request_id = "'.$reqid.'"');
if(! $update )
{
  die('Update not successfull' . mysql_error());
}
echo "Updated successfully\n";
mysql_query($sql);
}
}
?>
