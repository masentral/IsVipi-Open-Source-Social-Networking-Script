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
 isLoggedIn();
 if (isset($_SESSION['user_id'])){
 $user = $_SESSION['user_id'];
 getUserDetails($user);
 pollUser($user);
 }
 //Define key actions
//It will return fail if no correct action is defined from a POST command
//We retrieve the message id then update the message as read
	/*if (strlen($ACTION[1]) !== 23)
	{
	$_SESSION['err'] ="Error! No such conversation found";
    die404();
	exit();
	}	*/
	$string = $ACTION[1];
	if (isset($string)){
	$str = decrypt_str($string);
	$str = strip_tags($str);
	$str = substr($str, 0, 110);
	
    $parts = explode("/", $str);
	if ((!$parts[0])||(!$parts[1])||(!$parts[2])||(!$parts[3])){$_SESSION['err'] ="No such conversation";die404();}
    $msg_from = $parts[0];
    $unique_id = $parts[1];
	$msg_to = $parts[2];
	$msg_id = $parts[3];
	//Update as read
	updMsgRead($msg_from,$user,$unique_id);
	}
	else
	{
		$_SESSION['err'] ="No such conversation";
		die404();
	}
 base_header($site_title,$ACTION[0]);
 include_once ISVIPI_THEMES_BASE.'read_pm.php';
 globalAlerts();?>
</body>
</html>