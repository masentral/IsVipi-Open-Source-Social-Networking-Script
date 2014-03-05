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
include_once ISVIPI_ADMIN_INC_BASE. 'adminFunc.php';
$from_url = $_SERVER['HTTP_REFERER'];
$admeml = $_POST['eml'];
if ($admeml !== 'ActEmail' && $admeml !=='recEmail'){
	$_SESSION['err'] ="Unknown request";
    header ('location:'.$from_url.'');
	exit();
} 
/////////////////////////////////////////////////////////////
//////////////// ACTIVATION EMAIL //////////////////////////
////////////////////////////////////////////////////////////
if ($admeml == 'ActEmail') {
		$subject = $_POST["subject"];
		$message = $_POST["activationEmail"];	
		if (empty($subject)) {
			echo
			$_SESSION['err'] ="The subject field cannot be empty";
			header ('location:'.$from_url.'');
			exit();
		  }
		if (empty($message)) {
			echo
			$_SESSION['err'] ="The Activation Email cannot be empty";
			header ('location:'.$from_url.'');
			exit();
		  }
	global $db;
	$purpose ="activation";
	$ActEm = $db->prepare('UPDATE site_messages set subject=?,message=? where purpose=?');
	$ActEm->bind_param("sss",$subject,$message,$purpose);
	$ActEm->execute();
	$ActEm->close();
	$_SESSION['succ'] ="Activation Email updated";
			header ('location:'.$from_url.'');
			exit();

}

/////////////////////////////////////////////////////////////
//////////////// PASSWORD RECOVERY EMAIL ///////////////////
////////////////////////////////////////////////////////////
if ($admeml == 'recEmail') {
		$subject = $_POST["subject"];
		$message = $_POST["rec_email"];
		if (empty($subject)) {
			echo
			$_SESSION['err'] ="The subject field cannot be empty";
			header ('location:'.$from_url.'');
			exit();
		  }	
		if (empty($message)) {
			echo
			$_SESSION['err'] ="The Activation Email cannot be empty";
			header ('location:'.$from_url.'');
			exit();
		  }
	global $db;
	$purpose ="recovery";
	$ActEm = $db->prepare('UPDATE site_messages set subject=?,message=? where purpose=?');
	$ActEm->bind_param("sss",$subject,$message,$purpose);
	$ActEm->execute();
	$ActEm->close();
	$_SESSION['succ'] ="Password Recovery Email updated";
			header ('location:'.$from_url.'');
			exit();

}
		$db->close();
?>