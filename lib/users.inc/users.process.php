<?php
session_start();
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
include_once '../../init.php'; 
include_once ISVIPI_DB_BASE.'db.php';
include_once ISVIPI_USER_INC_BASE. 'PasswordHash.php';
include_once ISVIPI_USER_INC_BASE. 'users.func.php';
$from_url = $_SERVER['HTTP_REFERER'];

// Base-2 logarithm of the iteration count used for password stretching
$hash_cost_log2 = 8;
// Do we require the hashes to be portable to older systems (less secure)?
$hash_portable = FALSE;

$op = $_POST['op'];
if ($op !== 'new' && $op !== 'login' && $op !== 'change' && $op !== 'feed' && $op !== 'p_details'){
	$_SESSION['err'] ="Unknown request";
    header ('location:'.$from_url.'');
	exit();
}
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

//And now here comes the hasher
$hasher = new PasswordHash($hash_cost_log2, $hash_portable);

/////////////////////////////////////////////////////////////
//////////////// REGISTRATION //////////////////////////////
////////////////////////////////////////////////////////////
if ($op === 'new') {
	
/* Validate Display Name */
$d_name = get_post_var('d_name');
if (empty($d_name)) {
	$_SESSION['err'] ="Please fill in your display name";
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
	 $user=$d_name;
	 updateTimeline($user,$activity);
     
	 //send activation email
	 $domain = $site_title;
	 $site_url = $site_url;
	 $site_mail = $site_email;
	 $to = $email;
     $subject = "Account Activation";
     $message = '<html>
	              <table width="600">
                   <tr>
                     <td width="468">Dear '.$user.',</td>
                   </tr>
                   <tr>
                     <td><p>Your account at '.$site_title.' has been created. You will however need to validate your email before you can log in. To validate your email, please click the link below.</p>
                      <p> Link: '.$site_url.'/auth/activate.php?code='.$randomstring.'. </p>
                      <p> If for some reason you cannot click on the link above, copy and paste it in your browser.</p></td>
                  </tr>
                  <tr>
                     <td>Best Regards,<br />
                         '.$site_title.' Team.</td>
                  </tr>
               </table></html>';
		 $headers = "From:" . $site_email;
		 // To send HTML mail, the Content-type header must be set
		 $headers  = 'MIME-Version: 1.0' . "\r\n";
		 $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";
		 mail($to,$subject,$message,$headers);
		
} 
}
session_start();
$_SESSION['succ_reg'] ="Registration successful. We have sent you an email with an activation code. Please follow instructions provided";
$_SESSION['succ'] ="Registration successful. We have sent you an email with an activation code. Please follow instructions provided";
		header ('location:'.$from_url.'');
		exit();
$db->close();
}
/////////////////////////////////////////////////////////////
//////////////// LOGIN /////////////////////////////////////
////////////////////////////////////////////////////////////

if ($op === 'login') {
	ob_start();
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
if (empty($user)) {
    {
	$_SESSION['err'] ="Please fill in your username";
    header ('location:'.$from_url.'');
	exit();
}
  }

	// Check if the username is already in the database
	$chkusrnme = $db->prepare("SELECT id,active FROM members WHERE username=?");
	$chkusrnme->bind_param("s",$user);
	$chkusrnme->execute();
	$chkusrnme->store_result();
		if ($chkusrnme->num_rows === 0){
			$_SESSION['err'] ="Username not found";
			header ('location:'.$from_url.'');
			exit();
		}
	else
		{
			$chkusrnme->bind_result($id,$active);
			$chkusrnme->fetch();
			   if ($active === 0){
				$_SESSION['err'] ="Your account has not been validated";
				header ('location:'.$from_url.'');
				exit();
		}
 	else
		{  
		// Retrieve password and try to authenticate
		$chkusrlog = $db->prepare("SELECT password FROM members WHERE username=?");
		$chkusrlog->bind_param("s",$user);
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
	
			//Redirect to members area
			header ('location:../../members/');
			exit();
		} else {
			$_SESSION['err'] ="The username and/or password is incorrect";
			header ('location:../../index.php');
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
			unset($hasher);
			$hasher = new PasswordHash($hash_cost_log2, $hash_portable);
        //update password
		$stmt = $db->prepare('update members set password=? where username=?');
		$stmt->bind_param('ss', $hash, $user);
		$stmt->execute();
		{
			$_SESSION['succ'] ="Password changed successfully";
			header ('location:'.$from_url.'');
			exit();
		}
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
		$updtml = $db->prepare('insert into timeline (username, activity, time) values (?, ?, NOW())');
		$updtml->bind_param('ss', $user, $sanMyFeed);
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
$coutry_nn = get_post_var('country');
$coutry_n = preg_replace('/[^a-zA-Z0-9 ]/','',$coutry_nn);
	 /* Update profile*/
	 updateProfile($user,$display_n,$user_id_n,$gender_n,$dob_n,$phone_n,$city_n,$coutry_n);
	 $_SESSION['succ'] ="Profile update successful";
	 header("location: ".$from_url."");
	 exit ();
}
$db->close();
?>