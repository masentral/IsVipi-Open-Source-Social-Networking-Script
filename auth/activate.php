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
 require_once '../init.php';
 include_once ISVIPI_DB_BASE.'db.php';
 include_once ISVIPI_USER_INC_BASE. 'users.func.php';
 session_start();

if (isset($_GET['code'])) {
$activation_code = $_GET['code'];
//Sanitize our activation code
if (!preg_match('/^[a-zA-Z0-9_]{1,60}$/', $activation_code))
	{
	$_SESSION['err'] ="Invalid characters in activation code";
    header ('location:../index.php');
	exit();	
	}
// Check if the activation code exists in the database
$validateusr = $db->prepare("SELECT active FROM members WHERE a_code=?");
$validateusr->bind_param("s",$activation_code);
$validateusr->execute();
$validateusr->store_result();
if ($validateusr->num_rows === 0){
	$_SESSION['err'] ="The activation code is not valid";
    header ('location:../index.php');
	exit();	
	}
else
{
	//Generate Random string to replace the existing one in the database
	//This will ensure that the same code is not used twice. The new one will also be prefixed
    generateRandomString();
		$randomstring = 'ACTIVATED=='.generateRandomString();
		$activated = "1";
		$actvusr = $db->prepare('update members set active=?, a_code=? where a_code=?');
		$actvusr->bind_param('iss', $activated, $randomstring, $activation_code);
		$actvusr->execute();

	$_SESSION['succ'] ="Your account has been validated. Please log in.";
    header ('location:../index.php');
	exit();	
	};
 }
 else
 {
	 fail('Sorry! Nothing for you here');
 }
 ?>