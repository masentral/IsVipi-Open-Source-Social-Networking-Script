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
include_once ISVIPI_USER_INC_BASE. 'PasswordHash.php';
	$hash_cost_log2 = 8;
	$hash_portable = FALSE;
	$hasher = new PasswordHash($hash_cost_log2, $hash_portable);

$from_url = $_SERVER['HTTP_REFERER'];
$adm = $_POST['action'];
if ($adm !== 'login' && $adm !== 'change_pass'){
	$_SESSION['err'] =UNKNOWN_REQ;
    header ('location:'.$from_url.'');
	exit();
} 
/////////////////////////////////////////////////////////////
//////////////// ADMIN LOGIN ///////////////////////////////
////////////////////////////////////////////////////////////
if ($adm == 'login') {
		$adm_email = $_POST["admin_email"];	
		if (empty($adm_email)) {
			echo
			$_SESSION['err'] =EMAIL.E_IS_EMPTY;
			header ('location:'.$from_url.'');
			exit();
		  }
		 if (!filter_var($adm_email, FILTER_VALIDATE_EMAIL)) 
			{
			$_SESSION['err'] =E_INVALID_EMAIL;
			header ('location:'.$from_url.'');
			exit();
			}

		 $adm_pass = $_POST["admin_pass"];
		 
		 if (empty($adm_pass)) {
			$_SESSION['err'] =PASSWORD.E_IS_EMPTY;
			header ('location:'.$from_url.'');
			exit();
			}
			
		if (strlen($adm_pass) < 6)
			{
			$_SESSION['err'] =E_SHORT_PASS;
			header ('location:'.$from_url.'');
			exit();
			}
			
		if (strlen($adm_pass) > 72)
			{
			$_SESSION['err'] =E_LONG_PASS;
			header ('location:'.$from_url.'');
			exit();
			}
		// Check if the email is already in the database
		$chkemail = $db->prepare("SELECT id,password,active FROM admin WHERE email=?");
		$chkemail->bind_param("s",$adm_email);
		$chkemail->execute();
		$chkemail->store_result();
		$chkemail->bind_result($id,$hash,$active);
		$chkemail->fetch();
		if ($chkemail->num_rows === 0)
			{
				$_SESSION['err'] =N_EMAIL_NOT_FOUND;
				header ('location:'.$from_url.'');
				exit();
			}
		else if ($active === 0){
				$_SESSION['err'] =N_ACCOUNT_NOT_VALID;
				header ('location:'.$from_url.'');
				exit();
			}
 	else if ($hasher->CheckPassword($adm_pass, $hash)) {
			//Regenerate a session user based on the user's email
			session_regenerate_id(true);
			$useragent = $_SERVER['HTTP_USER_AGENT'];
			$ip = $_SERVER['REMOTE_ADDR'];
			$_SESSION['admin_id'] = $id;
			$_SESSION['admin_logged_in'] = TRUE;
			$_SESSION['succ'] =S_SUCCESS;
			session_write_close();
	
			//Update database with logged in details
			$online = "1";
	  		$updadmin = $db->prepare("UPDATE admin SET online=?, ip=?, user_agent=?, last_activity=NOW() WHERE email=?");
			$updadmin->bind_param("isss",$online,$ip,$useragent,$adm_email);
			$updadmin->execute();
			header ('location:'.ISVIPI_URL.$adminPath.'/dashboard/');
			exit();
		} else
			$_SESSION['err'] =N_EMAIL_PASS_INCORRECT;
			header ('location:'.$from_url.'');
			exit();
  $db->close();
}
/////////////////////////////////////////////////////////////
//////////////// CHANGE ADMIN PASSWORD /////////////////////
////////////////////////////////////////////////////////////
if ($adm == 'change_pass') {
	$admin_email = $_POST["admin_email"];
	$admin_newpass = $_POST["new_pass"];
	if (empty($admin_newpass)) 
	{
		$_SESSION['err'] =NEW_PASS.E_IS_EMPTY;
		header ('location:'.$from_url.'');
		exit();
	}
	if (strlen($admin_newpass) < 6)
	{
	$_SESSION['err'] =E_SHORT_PASS;
    header ('location:'.$from_url.'');
	exit();
	}	
		$admin_newpass2 = $_POST["new_pass2"];
		if (empty($admin_newpass2)) {
		$_SESSION['err'] =REP_NEW_PASS.E_IS_EMPTY;
		header ('location:'.$from_url.'');
		exit();
		}
		//Check if the new passwords match 
       if ($admin_newpass!= $admin_newpass2)
         {
			$_SESSION['err'] =E_PASS_NOT_MATCH;
			header ('location:'.$from_url.'');
			exit();
		  }
		if (strlen($admin_newpass) > 72)
		  {
			$_SESSION['err'] =E_LONG_PASS;
			header ('location:'.$from_url.'');
			exit();
		  }
		$hash = $hasher->HashPassword($admin_newpass);
		if (strlen($hash) < 20)
			{
				$_SESSION['err'] =E_SYS_ERR;
				header ('location:'.$from_url.'');
				exit();
			}
		$updtpass = $db->prepare('UPDATE admin set password=? where email=?');
		$updtpass->bind_param('ss', $hash, $admin_email);
		$updtpass->execute();
			$_SESSION['succ'] =S_SUCCESS;
			header ('location:'.$from_url.'');
			exit();
			$db->close();
		unset($hasher);
	}
?>