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
include_once ISVIPI_USER_INC_BASE. 'PasswordHash.php';
include_once ISVIPI_USER_INC_BASE. 'emailFunc.php';
$from_url = $_SERVER['HTTP_REFERER'];

// Base-2 logarithm of the iteration count used for password stretching
$hash_cost_log2 = 8;
// Do we require the hashes to be portable to older systems (less secure)?
$hash_portable = FALSE;

$op = $_POST['op'];
if ($op !== 'new' && $op !== 'login' && $op !== 'change' && $op !== 'feed' && $op !== 'p_details' && $op !== 'forgot_pass'){
	$_SESSION['err'] ="Unknown request";
    header ('location:'.$from_url.'');
	exit();
} 
if (isset($_POST['user'])){
$user = get_post_var('user');
if (empty($user)) {
    $_SESSION['err'] ="Please fill in your username";
    header ('location:'.$from_url.'');
	exit();
}
// Sanity-check the username, don't rely on our use of prepared statements
// alone to prevent attacks on the SQL server via malicious usernames
if (!preg_match('/^[a-zA-Z0-9_]{1,60}$/', $user)){
	$_SESSION['err'] ="Invalid characters in the username";
    header ('location:'.$from_url.'');
	exit();
}
}
//And now here comes the hasher
$hasher = new PasswordHash($hash_cost_log2, $hash_portable);

/////////////////////////////////////////////////////////////
//////////////// REGISTRATION //////////////////////////////
////////////////////////////////////////////////////////////
if ($op === 'new') {
	getAdminGenSett();
	if ($usrReg == "1"){
	$_SESSION['err'] ="The adminisrator has disabled registrations on this site";
    header ('location:'.$from_url.'');
	exit();	
	}
if (strlen($user) < 6)
	{
	$_SESSION['err'] ="Username must be 6 characters or more";
    header ('location:'.$from_url.'');
	exit();
}	
	
/* Validate Display Name */
$d_name = get_post_var('d_name');
if (empty($d_name)) {
	$_SESSION['err'] ="Please fill in your display name";
    header ('location:'.$from_url.'');
	exit();
}
$d_name = preg_replace('/\s\s+/',' ', $d_name);
if (strlen($d_name) < 6)
	{
	$_SESSION['err'] ="Display name must be 6 characters or more";
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
	$_SESSION['err'] ="Please fill in your email";
    header ('location:'.$from_url.'');
	exit();
}
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
    {
	$_SESSION['err'] ="The email you provided is not valid";
    header ('location:'.$from_url.'');
	exit();
}

/* Validate Password */
$pass = get_post_var('pass');
if (empty($pass)) {
    {
	$_SESSION['err'] ="Please fill in your password";
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
	$_SESSION['err'] ="Please fill in your repeat password field";
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
	if (!preg_match('/^[A-Za-z0-9:_.\/\\\\ ]+$/', $user_dob))
	{
	$_SESSION['err'] ="Invalid input for date of birth";
    header ('location:'.$from_url.'');
	exit();
}
if (!checkDateTime($user_dob)){
$_SESSION['err'] ="Wrong date format. Correct format is mm/dd/yyyy (month/day/year)";
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
		{
		$_SESSION['err'] ="The email you provided is already in use";
		header ('location:'.$from_url.'');
		exit();
		}
	}else
	{ 
     //Generate a random string for email validation
	 $randomstring = generateRandomString();
	 addUser($user,$d_name,$hash,$email,$randomstring,$user_gender,$user_dob,$user_city,$user_country);
	 
	 //Update timeline/activity feeds
	 $activity = 'has joined our site';
	 xtractUID($user);
	 updateTimeline($uid,$user,$activity);
	 //send activation email
	 getAdminGenSett();
	 if ($usrValid=="1"){ 
	 sendActEmail($site_url,$site_email,$user,$site_title,$randomstring,$email);
	 }
   } 
}
if ($usrValid=="1"){
$_SESSION['succ_reg'] ="Registration successful. We have sent you an email with an activation code. Please follow instructions provided";
$_SESSION['succ'] ="Registration successful. We have sent you an email with an activation code. Please follow instructions provided";
		header ('location:'.$from_url.'');
		exit();
} else {
$_SESSION['succ_reg'] ="Registration successful. Please log in to your new account";
$_SESSION['succ'] ="Registration successful. Please log in to your new account";
		header ('location:'.$from_url.'');
		exit();	
}
$db->close();
}
/////////////////////////////////////////////////////////////
//////////////// LOGIN /////////////////////////////////////
////////////////////////////////////////////////////////////

if ($op === 'login') {
	ob_start();
$email = get_post_var('email');
if (empty($email)) {
	$_SESSION['err'] ="Please fill in the email address that you signed up with";
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
	$_SESSION['err'] ="Please fill in your password";
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

	// Check if the email is already in the database
	$chkusrnme = $db->prepare("SELECT id,active,username FROM members WHERE email=?");
	$chkusrnme->bind_param("s",$email);
	$chkusrnme->execute();
	$chkusrnme->store_result();
		if ($chkusrnme->num_rows === 0){
			$_SESSION['err'] ="Email not found";
			header ('location:'.$from_url.'');
			exit();
		}
	else
		{
			$chkusrnme->bind_result($id,$active,$user);
			$chkusrnme->fetch();
			   if ($active === 0){
				$_SESSION['err'] ="Your account has not been validated";
				header ('location:'.$from_url.'');
				exit();
		}
 	else
		{  
		// Retrieve password and try to authenticate
		$chkusrlog = $db->prepare("SELECT password FROM members WHERE email=?");
		$chkusrlog->bind_param("s",$email);
		$chkusrlog->execute();
		$chkusrlog->store_result();
		$chkusrlog->bind_result($hash);
		$chkusrlog->fetch();
			if ($hasher->CheckPassword($pass, $hash)) {
			//Regenerate a session user based on the user's username
			session_regenerate_id(true);
			$_SESSION['user_id'] = $id;
			$_SESSION['logged_in'] = TRUE;
			$_SESSION['succ'] ="Login successful";
			
			session_write_close();
	
			//Update user status to online
	  		userOnline($user);
			//Update timeline/activity feeds
			 $activity = 'has just logged in';
			 xtractUID($user);
			 updateTimeline($uid,$user,$activity);
	
			//Redirect to members area
			header ('location:'.ISVIPI_URL.'home/');
			exit();
		} else {
			$_SESSION['err'] ="The email and/or password is incorrect";
			header ('location:'.$from_url.'');
			exit();
		$op = 'fail'; 
	}
  }
}
$db->close();
}
/////////////////////////////////////////////////////////////
//////////////// USER CHANGE PASSWORD //////////////////////
////////////////////////////////////////////////////////////

if ($op === 'change') {
	$newpass = get_post_var('newpass');
	if (empty($newpass)) 
	{
		$_SESSION['err'] ="Please fill in the new password field";
		header ('location:'.$from_url.'');
		exit();
	}
	if (strlen($newpass) < 6)
	{
	$_SESSION['err'] ="Password is shorter than 6 characters";
    header ('location:'.$from_url.'');
	exit();
}	
		$newpass2 = get_post_var('newpass2');
		if (empty($newpass2)) {
		$_SESSION['err'] ="Please fill in the repeat new password field";
		header ('location:'.$from_url.'');
		exit();
	}
		//Check if the new passwords match 
       if ($newpass!= $newpass2)
         {
			$_SESSION['err'] ="Passwords do not match";
			header ('location:'.$from_url.'');
			exit();
		  }
		if (strlen($newpass) > 72)
		  {
			$_SESSION['err'] ="The password is too long";
			header ('location:'.$from_url.'');
			exit();
		  }
			$hash = $hasher->HashPassword($newpass);
		if (strlen($hash) < 20)
			{
				$_SESSION['err'] ="System error! Please try again";
				header ('location:'.$from_url.'');
				exit();
			}
		$stmt = $db->prepare('update members set password=? where username=?');
		$stmt->bind_param('ss', $hash, $user);
		$stmt->execute();
			$_SESSION['succ'] ="Password changed successfully";
			header ('location:'.$from_url.'');
			exit();
	  $db->close();
	 }
	unset($hasher);
	
	
/////////////////////////////////////////////////////////////
//////////////// TIMELINE FEED //////////////////////
////////////////////////////////////////////////////////////
if ($op === 'feed') {
		$myfeed = get_post_var('myfeed');
			if (empty($myfeed)) {
			$_SESSION['err'] ="You cannot post an empty feed";
			header ('location:'.$from_url.'');
			exit();
			}
        //sanitize for any unwanted HTML characters
		$sanMyFeed = htmlspecialchars("".$myfeed."", ENT_QUOTES);
		//Update the timeline
		$updtml = $db->prepare('insert into timeline (uid, username, activity, time) values (?, ?, ?, NOW())');
		$updtml->bind_param('iss', $_SESSION['user_id'],$user, $sanMyFeed);
		$updtml->execute();
		
		//success('Update successful');
			$_SESSION['succ'] ="Post successful";
			header ('location:'.$from_url.'');
			exit();
			$db->close();
		}
/////////////////////////////////////////////////////////////
//////////////// UPDATE PROFILE //////////////////////
////////////////////////////////////////////////////////////
if ($op === 'p_details') {
/* User ID */
$user_id_n = get_post_var('userid');
if (!is_numeric($user_id_n)){
	$_SESSION['err'] ="Invalid user id";
    header ('location:'.$from_url.'');
	exit();
}
/* Display Name */
$display_nn = get_post_var('display_name');
$display_n = preg_replace('/[^a-zA-Z0-9 ]/','',$display_nn);
/* Gender */
$gender_n = get_post_var('user_gender');
if (!preg_match('/^[a-zA-Z0-9_]{1,60}$/', $gender_n)){
	$_SESSION['err'] ="Invalid characters for the gender";
    header ('location:'.$from_url.'');
	exit();
}
/* Date of Birth */
$dob_n = get_post_var('dob');
if (!checkDateTime($dob_n))
{
$_SESSION['err'] ="Wrong date format. Correct format is mm/dd/yyyy (month/day/year)";
    header ('location:'.$from_url.'');
	exit();	
}
if (!preg_match('/^[A-Za-z0-9:_.\/\\\\ ]+$/', $dob_n))
	{
	$_SESSION['err'] ="Invalid input for date of birth";
    header ('location:'.$from_url.'');
	exit();
}
/* Phone number */
$phone_nn = get_post_var('phone');
$phone_n = preg_replace('/[^0-9]/','',$phone_nn);

/* City */
$city_nn = get_post_var('city');
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

/////////////////////////////////////////////////////////////
//////////////// RESET PASSWORD //////////////////////
////////////////////////////////////////////////////////////

if ($op === 'forgot_pass') {
	$recov_email = get_post_var('recov_email');
	
	if (empty($recov_email)) 
	{
		$_SESSION['err'] ="Please provide the recovery email";
		header ('location:'.$from_url.'');
		exit();
	}
  if (!filter_var($recov_email, FILTER_VALIDATE_EMAIL)) 
    {
	$_SESSION['err'] ="The email you provided is not valid";
    header ('location:'.$from_url.'');
	exit();
	}
	//check if email exists
	if(!checkEmail($recov_email))
	{
		$_SESSION['err'] ="The email you provided is not registered with us.";
    header ('location:'.$from_url.'');
	exit();
	}
	else {
		//Generate a random string for email validation
	 	$randomstring = generateRandomString();
		//Update members table
		updtRecov($recov_email,$randomstring);
		//Get username so that we can send password recovery email
		emailUsername($recov_email);
		//passRecovEmail();
		sendRecEmail($recov_email,$randomstring,$site_title,$site_email,$username,$site_url);
		$_SESSION['succ'] ="Your password reset link has been sent to ".$recov_email."";
        header ('location:'.$from_url.'');
	    exit();
	}
}
$db->close();
?>