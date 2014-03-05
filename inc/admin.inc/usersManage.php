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
if (isset($ACTION[2])){
	$adm = $ACTION[2];
	}
if (isset($_POST['adm_users'])){$adm = $_POST['adm_users'];}
if ($adm !== 'new' && $adm !== '1'/*Validate*/ && $adm !== '2'/*Suspend*/ && $adm !== '3'/*Unsuspend*/ && $adm !== '4'/*Delete*/ && $adm !== 's_All'/*Suspend All*/ && $adm !== 'uns_All'/*Unsuspend All*/ && $adm !== 'del_unv_All'/*Delete All Unvalidated*/ && $adm !== 'del_sus_All'/*Delete All Suspended*/ && $adm !== 'edit_user'/*Delete All Suspended*/ ){
	$_SESSION['err'] ="Unknown request";
    header ('location:'.$from_url.'');
	exit();
} 
/////////////////////////////////////////////////////////////
//////////////// ADD NEW USER //////////////////////////////
////////////////////////////////////////////////////////////
if ($adm == 'new') {
	include_once ISVIPI_USER_INC_BASE. 'PasswordHash.php';
	$hash_cost_log2 = 8;
	$hash_portable = FALSE;
	$hasher = new PasswordHash($hash_cost_log2, $hash_portable);
	
	$user = get_post_var('user');
if (empty($user)) {
    $_SESSION['err'] ="Please fill in a username";
    header ('location:'.$from_url.'');
	exit();
}

if (!preg_match('/^[a-zA-Z0-9_]{1,60}$/', $user)){
	$_SESSION['err'] ="Invalid characters in the username";
    header ('location:'.$from_url.'');
	exit();
}

	$d_name = get_post_var('d_name');
if (empty($d_name)) {
	$_SESSION['err'] ="Please fill in a display name";
    header ('location:'.$from_url.'');
	exit();
}
if (!preg_match('/^[a-zA-Z0-9_ ]{1,60}$/', $d_name))
	{
	$_SESSION['err'] ="Invalid characters for display name";
    header ('location:'.$from_url.'');
	exit();
}
/* Validate email */
$email = get_post_var('email');
if (empty($email)) 
    {
	$_SESSION['err'] ="Please fill in an email";
    header ('location:'.$from_url.'');
	exit();
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
    {
	$_SESSION['err'] ="The email you provided is not valid";
    header ('location:'.$from_url.'');
	exit();
}

$pass = get_post_var('pass');
if (empty($pass)) {
    {
	$_SESSION['err'] ="Please fill in a password";
    header ('location:'.$from_url.'');
	exit();
   }
  }
if (strlen($pass) < 6)
	{
	$_SESSION['err'] ="Password is shorter than 6 characters";
    header ('location:'.$from_url.'');
	exit();
}	
if (strlen($pass) > 72)
	{
	$_SESSION['err'] ="Password too long";
    header ('location:'.$from_url.'');
	exit();
}

/* Validate Password Repeat */
$pass2 = get_post_var('pass2');
if (empty($pass2)) 
    {
	$_SESSION['err'] ="Please fill in the repeat password field";
    header ('location:'.$from_url.'');
	exit();
}
/* Check if passwords match */
if ($pass!= $pass2)
    {
	$_SESSION['err'] ="Passwords do not match";
    header ('location:'.$from_url.'');
	exit();
}
	$hash = $hasher->HashPassword($pass);
if (strlen($hash) < 20)
	{
	$_SESSION['err'] ="System error. Please try again";
    header ('location:'.$from_url.'');
	exit();
}
	unset($hasher);
	
// Validate Gender just in case someone goes around the select elements
$user_gender = get_post_var('user_gender');
if (!preg_match('/^[a-zA-Z0-9_]{1,60}$/', $user_gender))
	{
	$_SESSION['err'] ="Invalid input for gender";
    header ('location:'.$from_url.'');
	exit();
}
	
// Validate Date
$user_dob = get_post_var('user_dob');
	if (!checkDateTime($user_dob))
	{
	$_SESSION['err'] ="Wrong date format. Correct format is mm/dd/yyyy (month/day/year)";
		header ('location:'.$from_url.'');
		exit();	
	}
	if (!preg_match('/^[A-Za-z0-9:_.\/\\\\ ]+$/', $user_dob))
	{
	$_SESSION['err'] ="Invalid input for date of birth";
    header ('location:'.$from_url.'');
	exit();
}

// Validate City
$user_city = get_post_var('user_city');
if (empty($user_city)) 
    {
	$_SESSION['err'] ="Please fill in the city";
    header ('location:'.$from_url.'');
	exit();
}
if (!preg_match('/^[a-zA-Z0-9_ ]{1,60}$/', $user_city))
	{
	$_SESSION['err'] ="Invalid characters for city";
    header ('location:'.$from_url.'');
	exit();
}
	
// Validate Country
$user_country = get_post_var('user_country');
if (empty($user_country)) 
    {
	$_SESSION['err'] ="Please fill in your country";
    header ('location:'.$from_url.'');
	exit();
}
if (!preg_match('/^[a-zA-Z0-9_ ]{1,60}$/', $user_country))
	{
	$_SESSION['err'] ="Invalid characters for country";
    header ('location:'.$from_url.'');
	exit();
}

$user_status = get_post_var('user_status');
if (!preg_match('/^[a-zA-Z0-9_]{1,60}$/', $user_gender))
	{
	$_SESSION['err'] ="Invalid input for gender";
    header ('location:'.$from_url.'');
	exit();
}
if (isset($_POST['actEmailcheck'])){
$sendActEmail = get_post_var('actEmailcheck');
}
// Check if the username is already in the database
if(checkName($user))
	{
	$_SESSION['err'] ="Username is already taken";
    header ('location:'.$from_url.'');
	exit();
}else
	{
// Check if the email is already in the database
if(checkEmail($email))
		{
		$_SESSION['err'] ="The email you provided is already in use";
		header ('location:'.$from_url.'');
		exit();
	}
	//Generate a random string for email validation
	 $randomstring = generateRandomString();
	 $time = date("Y-m-d H-i-s");
	 $stmt = $db->prepare('insert into members (username, password, email, a_code, active, reg_date, level, online, last_activity) values (?, ?, ?, ?, ?, NOW(), "1", "0", ?)');
	$stmt->bind_param('ssssis', $user, $hash, $email, $randomstring, $user_status,$time);
	$stmt->execute();
	//Extract the ID of the user that has just signed up
	$xtrctid = $db->prepare("SELECT id FROM members WHERE username=?");
	$xtrctid->bind_param("s",$user);
	$xtrctid->execute();
	$xtrctid->store_result();
	$xtrctid->bind_result($user_id);
	$xtrctid->fetch();
	$xtrctid->close();
	
	//Create user in member_sett table
	$stmt = $db->prepare('insert into member_sett (user_id,d_name,gender,dob,city,country) values (?,?,?,?,?,?)');
	$stmt->bind_param('isssss', $user_id, $d_name,$user_gender,$user_dob,$user_city,$user_country);
	$stmt->execute();
	$stmt->close();
	 
	 //Update timeline/activity feeds
	 $activity = 'has joined our site';
	 xtractUID($user);
	 updateTimeline($uid,$user,$activity);
	 if (isset($sendActEmail)){
	 include_once ISVIPI_USER_INC_BASE. 'emailFunc.php';
	 actEmail();
	 sendActEmail($site_url,$site_email,$user,$site_title,$randomstring,$email,$act_subject,$activation_email);
	 }
	 $_SESSION['succ'] ="New user added";
    	header ('location:'.ISVIPI_URL.'admin/members');
	exit();
	}
}

/////////////////////////////////////////////////////////////
//////////////// VALIDATE USER /////////////////////////////
////////////////////////////////////////////////////////////
if ($adm == '1') {
	$userid = $ACTION[3];
	
	$act = "1";
	$activate = $db->prepare('UPDATE members set active=? WHERE id=?');
	$activate->bind_param('ii', $act,$userid);
	$activate->execute();
	$activate->close();	
		$_SESSION['succ'] ="User Validated";
		header('location: '.$from_url.'');
		exit();
}

/////////////////////////////////////////////////////////////
//////////////// SUSPEND USER ////////////////////////////
////////////////////////////////////////////////////////////
if ($adm == '2') {
	$userid = $ACTION[3];
	
	$sus = "3";
	$suspend = $db->prepare('UPDATE members set active=? WHERE id=?');
	$suspend->bind_param('ii', $sus,$userid);
	$suspend->execute();
	$suspend->close();	
		$_SESSION['succ'] ="User Suspended";
		header('location: '.$from_url.'');
		exit();
}


/////////////////////////////////////////////////////////////
//////////////// UNSUSPEND USER ////////////////////////////
////////////////////////////////////////////////////////////
if ($adm == '3') {
	$userid = $ACTION[3];
	
	$unsus = "1";
	$unsuspend = $db->prepare('UPDATE members set active=? WHERE id=?');
	$unsuspend->bind_param('ii', $unsus,$userid);
	$unsuspend->execute();
	$unsuspend->close();	
		$_SESSION['succ'] ="User unsuspended";
		header('location: '.$from_url.'');
		exit();
}

/////////////////////////////////////////////////////////////
//////////////// DELETE USER ///////////////////////////////
////////////////////////////////////////////////////////////
if ($adm == '4') {
	$userid = $ACTION[3];
	
	$delete = $db->prepare('DELETE from members WHERE id=?');
	$delete->bind_param('i', $userid);
	$delete->execute();
	$delete = $db->prepare('DELETE from member_sett WHERE user_id=?');
	$delete->bind_param('i', $userid);
	$delete->execute();
	$delete = $db->prepare('DELETE from my_friends WHERE (user1=? or user2=?)');
	$delete->bind_param('ii', $userid,$userid);
	$delete->execute();
	$delete->close();	
		$_SESSION['succ'] ="User Deleted";
		header('location: '.$from_url.'');
		exit();
}

/////////////////////////////////////////////////////////////
//////////////// SUSPEND ALL ///////////////////////////////
////////////////////////////////////////////////////////////
if ($adm == 's_All') {
	$sus = "3";
	$suspendAll = $db->prepare('UPDATE members set active=?');
	$suspendAll->bind_param('i', $sus);
	$suspendAll->execute();
	$suspendAll->close();	
		$_SESSION['succ'] ="All users suspended";
		header('location: '.$from_url.'');
		exit();
}

/////////////////////////////////////////////////////////////
//////////////// UNSUSPEND ALL /////////////////////////////
////////////////////////////////////////////////////////////
if ($adm == 'uns_All') {
	$sus = "1";
	$active = "3";
	$unsuspendAll = $db->prepare('UPDATE members set active=? WHERE active=?');
	$unsuspendAll->bind_param('ii', $sus,$active);
	$unsuspendAll->execute();
	$unsuspendAll->close();	
		$_SESSION['succ'] ="All users unsuspended";
		header('location: '.$from_url.'');
		exit();
}

/////////////////////////////////////////////////////////////
//////////////// DELETE ALL UNVALIDATED /////////////////////
////////////////////////////////////////////////////////////
if ($adm == 'del_unv_All') {
	$active = "0";
	$selectAll = $db->prepare('SELECT id FROM members WHERE active=?');
	$selectAll->bind_param('i', $active);
	$selectAll->execute();
	$selectAll->store_result();
	$selectAll->bind_result($id);
	while ($selectAll->fetch()){ 
	
	$deleteAll = $db->prepare('DELETE FROM members WHERE id=?');
	$deleteAll->bind_param('i', $id);
	$deleteAll->execute();
	$deleteAll->close();	
	
	$deleteAll = $db->prepare('DELETE FROM member_sett WHERE user_id=?');
	$deleteAll->bind_param('i', $id);
	$deleteAll->execute();
	$deleteAll->close();
	}
		$_SESSION['succ'] ="All unvalidated users deleted";
		header('location: '.$from_url.'');
		exit();
}

/////////////////////////////////////////////////////////////
//////////////// DELETE ALL SUSPENDED //////////////////////
////////////////////////////////////////////////////////////
if ($adm == 'del_sus_All') {
	$active = "3";
	$selectAll = $db->prepare('SELECT id FROM members WHERE active=?');
	$selectAll->bind_param('i', $active);
	$selectAll->execute();
	$selectAll->store_result();
	$selectAll->bind_result($id);
	while ($selectAll->fetch()){ 
	
	$deleteAll = $db->prepare('DELETE FROM members WHERE id=?');
	$deleteAll->bind_param('i', $id);
	$deleteAll->execute();
	$deleteAll->close();	
	
	$deleteAll = $db->prepare('DELETE FROM member_sett WHERE user_id=?');
	$deleteAll->bind_param('i', $id);
	$deleteAll->execute();
	$deleteAll->close();
	}
		$_SESSION['succ'] ="All suspended users deleted";
		header('location: '.$from_url.'');
		exit();
}

/////////////////////////////////////////////////////////////
//////////////// EDIT USER /////////////////////////////////
////////////////////////////////////////////////////////////
if ($adm == 'edit_user') {
/* User ID */
$user_id_n = get_post_var('userid');
if (!is_numeric($user_id_n)){
	$_SESSION['err'] ="Invalid user id";
    header ('location:'.$from_url.'');
	exit();
}
/* Display Name */
$display_nn = get_post_var('d_name');
$display_n = preg_replace('/[^a-zA-Z0-9 ]/','',$display_nn);
/* Validate email */
$email = get_post_var('email');
if (empty($email)) 
    {
	$_SESSION['err'] ="Please fill in the email";
    header ('location:'.$from_url.'');
	exit();
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
    {
	$_SESSION['err'] ="The email you provided is not valid";
    header ('location:'.$from_url.'');
	exit();
}
/* Gender */
$gender_n = get_post_var('user_gender');
if (!preg_match('/^[a-zA-Z0-9_]{1,60}$/', $gender_n)){
	$_SESSION['err'] ="Invalid characters for the gender";
    header ('location:'.$from_url.'');
	exit();
}
/* Date of Birth */
$dob_n = get_post_var('dob');
if (!preg_match('/^[A-Za-z0-9:_.\/\\\\ ]+$/', $dob_n))
	{
	$_SESSION['err'] ="Invalid input for date of birth";
    header ('location:'.$from_url.'');
	exit();
}
if (!checkDateTime($dob_n))
{
$_SESSION['err'] ="Wrong date format. Correct format is mm/dd/yyyy (month/day/year)";
    header ('location:'.$from_url.'');
	exit();	
}
/* Phone number */
$phone_nn = get_post_var('phone');
$phone_n = preg_replace('/[^0-9]/','',$phone_nn);

/* City */
$city_nn = get_post_var('user_city');
$city_n = preg_replace('/[^a-zA-Z0-9 ]/','',$city_nn);


/* Country */
$coutry_nn = get_post_var('user_country');
$coutry_n = preg_replace('/[^a-zA-Z0-9 ]/','',$coutry_nn);
	 /* Update profile*/
	 updateProfile($display_n,$user_id_n,$gender_n,$dob_n,$phone_n,$city_n,$coutry_n);
	 $_SESSION['succ'] ="Profile update successful";
	 header("location: ".$from_url."");
	 exit ();
}

$db->close();
?>