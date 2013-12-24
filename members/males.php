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
<title>Male Members</title>
</head>

<body>
<?php
//We check if the user is logged
if(isset($_SESSION['user_id']))
{
//We list his messages in a table
//Two queries are executes, one for the unread messages and another for read messages
$req1 = mysql_query('select m1.id, m1.title, m1.timestamp, count(m2.id) as reps, users.id as user_id, users.username from pm as m1, pm as m2,users where ((m1.user1="'.$_SESSION['user_id'].'" and m1.user1read="no" and users.id=m1.user2) or (m1.user2="'.$_SESSION['user_id'].'" and m1.user2read="no" and users.id=m1.user1)) and m1.id2="1" and m2.id=m1.id group by m1.id order by m1.id desc');
$req2 = mysql_query('select m1.id, m1.title, m1.timestamp, count(m2.id) as reps, users.id as user_id, users.username from pm as m1, pm as m2,users where ((m1.user1="'.$_SESSION['user_id'].'" and m1.user1read="yes" and users.id=m1.user2) or (m1.user2="'.$_SESSION['user_id'].'" and m1.user2read="yes" and users.id=m1.user1)) and m1.id2="1" and m2.id=m1.id group by m1.id order by m1.id desc');
?>    
<?php
}
else
{
	echo 'You must be logged to access this page.';
}
?> 
<?php
include ISVIPI_THEMES_BASE.'males.php';
?>
</body>
</html>