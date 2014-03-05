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
function base_header($site_title,$ACTION){
$ACTION = str_replace("_", " ", $ACTION);
$ACTION = str_replace("index", "Homepage", $ACTION);
$ACTION = ucwords($ACTION);
include_once ISVIPI_USER_BASE.'base_header.php';	
}
function admin_base_header($site_title,$ACTION){
$ACTION = str_replace("_", " ", $ACTION);
$ACTION = ucwords($ACTION);
include_once ISVIPI_USER_BASE.'admin_base_header.php';	
}
//Function Get Header
function get_header(){
include_once ISVIPI_THEMES_BASE.'global/header.php';	
}
//Function Get Footer
function get_footer(){
include_once ISVIPI_THEMES_BASE.'global/footer.php';	
}
//Function Get Homepage Header
function get_home_header(){
include_once ISVIPI_THEMES_BASE.'global/index_header.php';	
}
//Function Get Homepage Footer
function get_home_footer(){
include_once ISVIPI_THEMES_BASE.'global/index_footer.php';	
}
//Function Get Sidebar Menu
function get_sidebar(){
include_once ISVIPI_THEMES_BASE.'global/sidebar_menu.php';	
}

//Function Get Sidebar Menu
function get_r_sidebar(){
include_once ISVIPI_THEMES_BASE.'global/announcements.php';	
}
//Function Get Announcements
function getAnnouncements(){
	global $db;
	global $ann_id;
	global $ann_date;
	global $ann_subject;
	global $ann_content;
	global $getAnn;
	$getAnn = $db->prepare("SELECT id,date,subject,content FROM announcements ORDER BY id DESC LIMIT 5");
	$getAnn->execute();
	$getAnn->store_result();
	$getAnn->bind_result($ann_id,$ann_date,$ann_subject,$ann_content);
}

//Function 404 
function die404() {header('location: '.ISVIPI_URL.'404/');}

function cSelect(){
	global $db;
	global $user_country;
	$countryS = $db->prepare("SELECT nicename FROM country");
	$countryS->execute();
	$countryS->store_result();
	$countryS->bind_result($user_country);
	if (isset($_SESSION['user_id'])){
	$user = $_SESSION['user_id'];
	$countryuser = $db->prepare("SELECT country FROM member_sett WHERE user_id=?");
	$countryuser->bind_param("i",$user);
	$countryuser->execute();
	$countryuser->store_result();
	$countryuser->bind_result($count);
	$countryuser->fetch();
	}
	echo '<select name="user_country" class="form-control">';
	while($countryS->fetch()){?>
	<option value="<?php echo $user_country ?>" <?php  if (isset($count))if ($count==$user_country) { ?>selected="selected"<?php } ?>><?php echo $user_country ?></option>
    <?php }
	echo '</select>';
	
}

//function to display errors and success messages in the entire site
function globalAlerts(){
if (isset($_GET['action'])) {
$action = $_GET['action'];
//Sanitize GET code
if (!preg_match('/^[a-zA-Z0-9_]{1,60}$/', $action));
 }
 if (isset($_SESSION['err']))$err = $_SESSION['err'];
 if (isset($_SESSION['succ']))$succ = $_SESSION['succ'];
if (isset($err)) {?>
 <script>
$(document).ready( function () {
alertify.error("<?php echo $err?>");
})
</script>
<?php 
unset ($_SESSION['err']);
 } else if (isset($succ)) {?>
 <script>
$(document).ready( function () {
alertify.success("<?php echo $succ ?>");
})
</script>
<?php 
unset ($_SESSION['succ']);
 }
}

//fail function - returns a fail notice in the event that a query fails
function fail($pub, $pvt = '')
{
	global $debug;
	$msg = $pub;
	if ($debug && $pvt !== '')
		$msg .= ": $pvt";
	exit("An error occurred => $msg.\n");
}
function success($pub, $pvt = '')
{
	global $debug;
	$msg = $pub;
	if ($debug && $pvt == '')
		$msg .= ": $pvt";
// The $pvt debugging messages may contain characters that would need to be
	exit("Success => $msg.\n");
}

//Get post variables and sanitize them
function get_post_var($var)
{
	$val = $_POST[$var];
	if (get_magic_quotes_gpc())
		$val = stripslashes($val);
	return $val;
}

// Validate Date
function validateDate($date, $format = 'Y-m-d H:i:s')
{
    $d = DateTime::createFromFormat($format, $date);
    return $d && $d->format($format) == $date;
}
//Generate Random string for email validation
//You can change the length of the random string below. It is automatically set at 25
function generateRandomString($length = 25) {
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
}
$randomstring = generateRandomString();

//Check if username already exists
function checkName($user){
	global $db;
	$chkusr = $db->prepare("SELECT username FROM members WHERE username=?");
	$chkusr->bind_param("s",$user);
	$chkusr->execute();
	$chkusr->store_result();
		if ($chkusr->num_rows > 0){
	return true;
	}
	return false;
$chkusr->free_result();
$chkusr->close();
}

//Check if email already exists
function checkEmail($value){
	global $db;
	$chkeml = $db->prepare("SELECT email FROM members WHERE email=?");
	$chkeml->bind_param("s",$value);
	$chkeml->execute();
	$chkeml->store_result();
		if ($chkeml->num_rows > 0){
	return true;
	}
	return false;
$chkeml->free_result();
$chkeml->close();
}

//Update members table to pass recovery
function updtRecov($value,$randomstring){
	global $db;
	$uporec = $db->prepare('UPDATE members set a_code=? where email=?');
	$uporec->bind_param('ss', $randomstring,$value);
	$uporec->execute();
	$uporec->close();
}

//function get username from email
//Get User Details function
function emailUsername($value){
	global $db;
	global $username;
	$getusr = $db->prepare("SELECT username FROM members WHERE email=?");
	$getusr->bind_param("s",$value);
	$getusr->execute();
	$getusr->store_result();
	$getusr->bind_result($username);
	$getusr->fetch();
	$getusr->close();
}
//Add User after completing all validation requirements
function addUser($user,$d_name,$hash,$email,$randomstring,$user_gender,$user_dob,$user_city,$user_country){
	global $db;
	getAdminGenSett();
	global $usrValid;
	if ($usrValid=="1"){$active = "0";} else {$active = "1";}
	$time = date("Y-m-d H-i-s");
	$stmt = $db->prepare('insert into members (username, password, email, a_code, active, reg_date, level, online, last_activity) values (?, ?, ?, ?, ?, NOW(), "1", "0", ?)');
	$stmt->bind_param('ssssis', $user, $hash, $email, $randomstring, $active, $time);
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
}

//function extract user id
function xtractUID($value){
	//Extract the ID of the user that has just signed up
	global $uid;
	global $db;
	$xtrctid = $db->prepare("SELECT id FROM members WHERE username=?");
	$xtrctid->bind_param("s",$value);
	$xtrctid->execute();
	$xtrctid->store_result();
	$xtrctid->bind_result($uid);
	$xtrctid->fetch();
	$xtrctid->close();
}
//Update user profile
function updateProfile($display_n,$user_id_n,$gender_n,$dob_n,$phone_n,$city_n,$coutry_n){
	global $db;
	//Update user status to online
	$upoprf = $db->prepare('UPDATE member_sett set d_name=?,gender=?,dob=?,phone=?,city=?,country=? where user_id=?');
	$upoprf->bind_param('ssssssi', $display_n,$gender_n,$dob_n,$phone_n,$city_n,$coutry_n,$user_id_n);
	$upoprf->execute();
	$upoprf->close();
}
//Update timeline/activity feeds
function updateTimeline($value,$user,$activity){
	global $db;
	//Update user status to online
	$updtml = $db->prepare('insert into timeline (uid, username, activity, time) values (?, ?, ?, NOW())');
	$updtml->bind_param('iss', $value, $user, $activity);
	$updtml->execute();
	$updtml->close();
}

//Check if the session has been timed out
function timedOut(){
$inactive = 1800;
if(isset($_SESSION['timeout']) ) {
	$session_life = time() - $_SESSION['timeout'];
	if($session_life > $inactive)
        return TRUE;
}
$_SESSION['timeout'] = time();
}

//Check login function to authenticate users before accessing the member area
function isLoggedIn(){
	if(!isset($_SESSION['logged_in'])&&(!isAdmin())&&(!isset($_SESSION['user_id']))) {
		$_SESSION['err'] ="You MUST be logged in to view that page";
		header('location: '.ISVIPI_URL.'login/');
		exit();
	}
	else if(timedOut()){
		header('location: '.ISVIPI_URL.'session_expire/');
	}
	/**else if (!isAdmin()){
		$_SESSION['err'] ="You MUST be logged in to view that page";
		header('location: '.ISVIPI_URL.'login/');
		exit();
	}**/
  }
 function signedIn(){
	if(isset($_SESSION['logged_in'])) {
		return true;
	}
	else {
		return false;
	}
  }
  function isAdmin(){
	if(isset($_SESSION['admin_logged_in'])) {
		return true;
	}
	else {
		return false;
	}
  }

//Check if user is logged in
function isOnline($value){
	global $db;
	$getusr = $db->prepare("SELECT last_activity FROM members WHERE id=?");
	$getusr->bind_param("i",$value);
	$getusr->execute();
	$getusr->store_result();
	$getusr->bind_result($last_activity);
	$getusr->fetch();
	$getusr->close();
		$timeNow = date('m/d/Y h:i:s a', time());
		$start_date = new DateTime($timeNow);
		$since_start = $start_date->diff(new DateTime($last_activity));
		//echo $since_start->i.' minutes';
		if ($since_start->i>=10){
		$session_expire ="session_expire";
		logout($session_expire);	
		}
}
//Poll users and update on every page load
function pollUser($value){
	global $db;
	$pollusr = $db->prepare('update members set last_activity=NOW() where id=?');
	$pollusr->bind_param('i', $value);
	$pollusr->execute();
	$pollusr->close();	
	}
//Update user status to online
function userOnline($user){
	global $db;
	$online = "1";
	//Update user status to online
	$uponl = $db->prepare('update members set online=?, last_activity=NOW() where username=?');
	$uponl->bind_param('is', $online, $user);
	$uponl->execute();
	$uponl->close();
}

//Get User Details function
function getUserDetails($value){
	global $db;
	global $email;
	global $reg_date;
	global $username;
	$getusr = $db->prepare("SELECT username,email,reg_date FROM members WHERE id=?");
	$getusr->bind_param("i",$value);
	$getusr->execute();
	$getusr->store_result();
	$getusr->bind_result($username,$email,$reg_date);
	$getusr->fetch();
	$getusr->close();
		//Get user settings
		global $d_name;
		global $gender;
		global $dob;
		global $city;
		global $country;
		global $thumbnail;
		global $phone;
		$getusrst = $db->prepare("SELECT d_name,gender,dob,city,country,phone,thumbnail FROM member_sett WHERE user_id=?");
		$getusrst->bind_param("i",$user);
		$getusrst->execute();
		$getusrst->store_result();
		$getusrst->bind_result($d_name,$gender,$dob,$city,$country,$phone,$thumbnail);
		$getusrst->fetch();
		$getusrst->close();
}
//logout function
function logout($value){
	if(isset($_SESSION['user_id'])){
    global $db;
    //update user status to offline
    $online = "0";
	$user = $_SESSION['user_id'];
    $upoff = $db->prepare('update members set online=? where id=?');
	$upoff->bind_param('is', $online, $user);
	$upoff->execute();
	$upoff->close();
		session_destroy();
		session_start();
		if ($value == 'logout'){
		$_SESSION['succ'] ="You have logged out successfully";
		} else if ($value == 'session_expire'){
			$_SESSION['err'] ="Your session expired. Please log in again";
		}
		header('location: '.ISVIPI_URL.'');	
		exit();
	}
	else {
		$_SESSION['err'] ="You are not logged in";
		header('location: '.ISVIPI_URL.'');
		exit();
	}
}

//Get activity feeds
function getFeeds(){
	global $activity;
	global $db;
	global $getusr;
	global $time;
	global $act_user;
	$getusr = $db->prepare("SELECT username,activity,time FROM timeline ORDER BY id DESC LIMIT 55");
	$getusr->execute();
	$getusr->store_result();
	$getusr->bind_result($act_user,$activity,$time);
}

//Get relative time
function relativeTime($time,$precision=3)
                   {$times=array(	365*24*60*60	=> "year",
					30*24*60*60		=> "month",
					7*24*60*60		=> "week",
					24*60*60		=> "day",
					60*60			=> "hour",
					60				=> "minute",
					1				=> "second");
	                if(is_string($time)) $time=strtotime($time);
					$passed=time()-$time;
	            if($passed<5)
	             {
		           $output='less than 5 seconds ago';
	             }
	             else
	             {
		          $output=array();
		          $exit=0;
		         foreach($times as $period=>$name)
		         {
			     if($exit>=$precision || ($exit>0 && $period<60)) break;
			     $result = floor($passed/$period);
			     if($result>0)
			     {
				$output[]=$result.' '.$name.($result==1?'':'s');
				$passed-=$result*$period;
				$exit++;
			}
			else if($exit>0) $exit++;
		}
				
		$output=implode(', ',$output).' ago';
	}
	return $output;
}


//Retrieve Thumbnail
function t_thumb($value){
	global $t_thumb;
	$GLOBALS['foobar'] = $t_thumb;
	global $db;
	$getusr = $db->prepare("SELECT thumbnail FROM member_sett WHERE id=?");
	$getusr->bind_param('i', $value);
	$getusr->execute();
	$getusr->store_result();
	$getusr->bind_result($t_thumb);
	$getusr->fetch();
	$getusr->close();
}
//Get Members function
function getMembers(){
	global $db;
	global $getmembers;
	global $id;
	global $profile_name;
	global $m_count;
	$active = '1';
	$getmembers = $db->prepare("SELECT id,username FROM members where active=?");
	$getmembers->bind_param('i', $active);
	$getmembers->execute();
	$getmembers->store_result();
	$getmembers->bind_result($id,$profile_name);
	$m_count = $getmembers->num_rows();
}
//Get Online Members function
function getOnlineMembers(){
	global $db;
	global $getmembers;
	global $id;
	global $o_count;
	$online = "1";
	$active = '1';
	$getmembers = $db->prepare("SELECT id FROM members where (online=? AND active=?)");
	$getmembers->bind_param("ii",$online,$active);
	$getmembers->execute();
	$getmembers->store_result();
	$getmembers->bind_result($id);
	$o_count = $getmembers->num_rows();
}
//Get New Members function
function getNewMembers(){
	global $db;
	global $getmembers;
	global $id;
	global $n_count;
	global $username;
	global $email;
	$active = '1';
	$getmembers = $db->prepare("SELECT id,username,email FROM members where (active=? AND reg_date > NOW() - INTERVAL 1 DAY) ORDER BY ID Desc LIMIT 0, 20");
	$getmembers->bind_param('i', $active);
	$getmembers->execute();
	$getmembers->store_result();
	$getmembers->bind_result($id,$username,$email);
	$n_count = $getmembers->num_rows();
}

//Get unvalidated members
function getUnValMembers(){
	global $db;
	global $getunmembers;
	global $id;
	global $un_count;
	$active = '0';
	$getunmembers = $db->prepare("SELECT id FROM members where active=? ORDER BY ID Desc");
	$getunmembers->bind_param('i', $active);
	$getunmembers->execute();
	$getunmembers->store_result();
	$getunmembers->bind_result($id);
	$un_count = $getunmembers->num_rows();
}

//Get suspended members
function getSusMembers(){
	global $db;
	global $getunmembers;
	global $id;
	global $sus_count;
	$active = '3';
	$getsusmembers = $db->prepare("SELECT id FROM members where active=? ORDER BY ID Desc");
	$getsusmembers->bind_param('i', $active);
	$getsusmembers->execute();
	$getsusmembers->store_result();
	$getsusmembers->bind_result($id);
	$sus_count = $getsusmembers->num_rows();
}

//Get Female members
function getFemMembers(){
	global $db;
	global $getfemales;
	global $id;
	global $fem_count;
	$gender = 'Female';
	$getfemales = $db->prepare("SELECT id FROM member_sett where gender=? ORDER BY ID Desc");
	$getfemales->bind_param('s', $gender);
	$getfemales->execute();
	$getfemales->store_result();
	$getfemales->bind_result($id);
	$fem_count = $getfemales->num_rows();
}

//Get Male members
function getMaleMembers(){
	global $db;
	global $getmales;
	global $id;
	global $male_count;
	$gender = 'Male';
	$getmales = $db->prepare("SELECT id FROM member_sett where gender=? ORDER BY ID Desc");
	$getmales->bind_param('s', $gender);
	$getmales->execute();
	$getmales->store_result();
	$getmales->bind_result($id);
	$male_count = $getmales->num_rows();
}

//Get member details
function getMemberDet($value){
	global $db;
	global $m_name;
	global $m_gender;
	global $m_dob;
	global $m_age;
	global $m_city;
	global $m_country;
	global $m_phone;
	global $m_thumbnail;
	$getusrst = $db->prepare("SELECT d_name,gender,dob,city,country,phone,thumbnail FROM member_sett WHERE user_id=?");
	$getusrst->bind_param("i",$value);
	$getusrst->execute();
	$getusrst->store_result();
	$getusrst->bind_result($m_name,$m_gender,$m_dob,$m_city,$m_country,$m_phone,$m_thumbnail);
	$getusrst->fetch();
	$getusrst->close();
		$now      = new DateTime();
		$birthday = new DateTime($m_dob);
		$interval = $now->diff($birthday);
		$m_age = $interval->format('%y years old'); 
}

//Check for existing friend request
function checkExistingReq($id,$user){
	global $db;
	$status = "0";
	$chkusr = $db->prepare("SELECT status FROM friend_requests WHERE (from_id=? AND to_id=? AND status=?) OR (to_id=? AND from_id=? AND status=?)");
	$chkusr->bind_param("iiiiii",$user,$id,$status,$user,$id,$status);
	$chkusr->execute();
	$chkusr->store_result();
	if ($chkusr->num_rows > 0){
return true;
}
return false;
$chkusr->close();
}

//Check if the request has been rejected
function checkIfRejected($id,$user){
	global $db;
	$status = "5";
	$chkusr = $db->prepare("SELECT status FROM friend_requests WHERE (from_id=? AND to_id=? AND status=?) OR (to_id=? AND from_id=? AND status=?)");
	$chkusr->bind_param("iiiiii",$user,$id,$status,$user,$id,$status);
	$chkusr->execute();
	$chkusr->store_result();
	if ($chkusr->num_rows > 0){
return true;
}
return false;
$chkusr->close();
}

//Check for pending friend request
function pendingFReq($user){
	global $db;
	global $pendreq;
	$status = "0";
	$chkusr = $db->prepare("SELECT * FROM friend_requests WHERE to_id=? AND status=?");
	$chkusr->bind_param("ii",$user,$status);
	$chkusr->execute();
	$chkusr->store_result();
	$pendreq = $chkusr->num_rows;
	if ($chkusr->num_rows > 0){
return true;
	}
return false;
$pendreq ->close();
	}
	
//Check if already friends
function checkFriendship($id,$user){
	global $db;
	$chkusr = $db->prepare("SELECT * FROM my_friends WHERE (user1=? AND user2=?) OR (user2=? AND user1=?)");
	$chkusr->bind_param("iiii",$id,$user,$id,$user);
	$chkusr->execute();
	$chkusr->store_result();
	if ($chkusr->num_rows > 0){
		return true;
		}
		return false;
		$chkusr->close();
	}
	
//Display Pending Friend Requests
function DisplayFReq($user){
	global $db;
	global $from_id;
	global $timestamp;
	global $getusrst;
	$status ="0";
	$getusrst = $db->prepare("SELECT from_id,timestamp FROM friend_requests WHERE (to_id=? AND status=?)");
	$getusrst->bind_param("ii",$user, $status);
	$getusrst->execute();
	$getusrst->store_result();
	$getusrst->bind_result($from_id,$timestamp);
//Get Username
function getUsername()
  {
	global $db;
	global $user_name;
	global $from_id;
	$getusrst = $db->prepare("SELECT d_name FROM member_sett WHERE user_id=?");
	$getusrst->bind_param("i",$from_id);
	$getusrst->execute();
	$getusrst->store_result();
	$getusrst->bind_result($user_name);
	$getusrst->fetch();
	$getusrst->close();
  }
}

//Get Username
function getUserN($value){
	global $db;
	global $name;
	$getusrst = $db->prepare("SELECT d_name FROM member_sett WHERE user_id=?");
	$getusrst->bind_param("i",$value);
	$getusrst->execute();
	$getusrst->store_result();
	$getusrst->bind_result($name);
	$getusrst->fetch();
	$getusrst->close();
}
//Add my friend function after successful confirmation of a friend request
function addMyFriend($id,$user){
	global $db;
	($stmt = $db->prepare('insert into my_friends (user1, user2, timestamp) values (?, ?, NOW()),(?, ?, NOW())'));
	$stmt->bind_param('iiii', $id, $user, $user, $id);
	$stmt->execute();
	return true;
	$stmt->close();
}

//Delete friend request from friend_requests table
function deleteFReq($user,$id){
    global $db;
	($stmt = $db->prepare('DELETE from friend_requests WHERE (from_id=? AND to_id=?) OR (to_id=? AND from_id=?)'));
	$stmt->bind_param('iiii', $user,$id,$user,$id);
	$stmt->execute();
	return true;	
	$stmt->close();
}

//Get My Friends
function getMyFriends($user){
	global $db;
	global $getfriends;
	global $id;
	$getfriends = $db->prepare("SELECT user2 FROM my_friends WHERE (user1=?)");
	$getfriends->bind_param('i', $user);
	$getfriends->execute();
	$getfriends->store_result();
	$getfriends->bind_result($id);
}

//Get Site Notificatios
function getNotices($user){
	global $db;
	global $notice_id;
	global $notice;
	global $time;
	global $getnotice;
	global $noticesno;
	$getnotice = $db->prepare("SELECT id, notice, time FROM notifications WHERE user=? ORDER BY ID DESC Limit 20 ");
	$getnotice->bind_param('i', $user);
	$getnotice->execute();
	$getnotice->store_result();
	$getnotice->bind_result($notice_id,$notice,$time);
	$noticesno = $getnotice->num_rows();
}
//Get unseen notice count
function getUnseenNotices($user){
	global $db;
	global $noticesno;
	$seen = "no";
	$getnotice = $db->prepare("SELECT id, notice, time FROM notifications WHERE user=? AND seen=?");
	$getnotice->bind_param('is', $user,$seen);
	$getnotice->execute();
	$getnotice->store_result();
	$getnotice->bind_result($notice_id,$notice,$time);
	$noticesno = $getnotice->num_rows();
}

//Update the database when the notice has been seem
function noticeSeen($user){
	global $db;
	$seenupd ="yes";
	$seen = "no";
	//Update user status to online
	$noticeS = $db->prepare('UPDATE notifications set seen=? where (user=? AND seen=?)');
	$noticeS->bind_param('sis', $seenupd,$user,$seen);
	$noticeS->execute();
	$noticeS->close();
	
}
//Update notification's table
function updNotices($user,$notice){
	global $db;
	$seen = "no";
	$updtml = $db->prepare('insert into notifications (user, notice, time, seen) values (?, ?, NOW(),?)');
	$updtml->bind_param('iss', $user, $notice,$seen);
	$updtml->execute();
	$updtml->close();
}
//Add Message
function addPM($user,$recip,$message,$unique_id){
	global $db;
	$read1 = "yes";
	$read2 = "no";
	$addPM = $db->prepare('insert into pm (unique_id, user1, user2, message, timestamp, user1read, user2read)values(?,?,?,?,NOW(),?,?)');
	$addPM->bind_param('iiisss', $unique_id,$user,$recip,$message,$read1,$read2);
	$addPM->execute();
	return true;
	$addPM->close();
}
//Retrieve All messages
function getAllmsgs($user){
	global $db;
	global $msg_from;
	global $msg_to;
	global $message;
	global $timestamp;
	global $geAllmsgs;
	global $date;
	global $unique_id;
	global $msg_id;
	$geAllmsgs = $db->prepare("SELECT id,unique_id,user1,user2,message,timestamp FROM pm WHERE (user2=? OR user1=?) GROUP BY unique_id ORDER by timestamp DESC");
	$geAllmsgs->bind_param('ii', $user,$user);
	$geAllmsgs->execute();
	$geAllmsgs->store_result();
	$geAllmsgs->bind_result($msg_id,$unique_id,$msg_from,$msg_to,$message,$timestamp);
	if ($geAllmsgs->num_rows >0){
return true;
	}
return false;
}
//Get Unread Messages
function newMsgs($user){
	global $db;
	global $newmsg;
	$read = "no";
	$chkusr = $db->prepare("SELECT * FROM pm WHERE (user2=? AND user2read=?)  GROUP BY unique_id");
	$chkusr->bind_param("is",$user,$read);
	$chkusr->execute();
	$chkusr->store_result();
	$newmsg = $chkusr->num_rows;
	}
	
//Retrieve Single user message
function newSingMsg($user1,$unique_id){
	global $db;
	global $newmsgs;
	$read = "no";
	$msgfr = $db->prepare("SELECT * FROM pm WHERE user2read=? AND user2=? AND unique_id=? GROUP BY unique_id");
	$msgfr->bind_param("sii",$read,$user1, $unique_id);
	$msgfr->execute();
	$msgfr->store_result();
	$newmsgs = $msgfr->num_rows;
	}

//Get All Messages between the two users
function getConvMsgs($user1,$msg_to,$unique_id){
	global $db;
	global $msg_from;
	global $message;
	global $timestamp;
	global $from;
	global $user2;
	global $geUtmsgs;
	global $date;
	$read = "no";
	$geUtmsgs = $db->prepare("SELECT user1,user2,message,timestamp FROM pm WHERE unique_id=? ORDER by timestamp DESC");
	$geUtmsgs->bind_param('i', $unique_id);
	$geUtmsgs->execute();
	$geUtmsgs->store_result();
	$geUtmsgs->bind_result($from,$user2,$message,$timestamp);
	if ($geUtmsgs->num_rows >0){
return true;
	}
return false;
}
//Check if an existing conversation between the two parties is available
function checkConv($user,$recip){
	global $db;
	global $unique_id;
	$checkConv = $db->prepare("SELECT unique_id FROM pm WHERE (user1=? OR user2=?) AND (user2=? OR user1=?)");
	$checkConv->bind_param("iiii",$user,$user,$recip,$recip);
	$checkConv->execute();
	$checkConv->store_result();
	$checkConv->bind_result($unique_id);
	$checkConv->fetch();
	if ($checkConv->num_rows > 0){
return true;
	}
return false;
	$checkConv->free_result();
	$checkConv->close();
}

//Update message as unread
function updMsgUnRead($user,$recip){
	global $db;
	$read = "no";
	($updMsgUnRead = $db->prepare('UPDATE pm SET user2read=? WHERE (user1=? AND user2=?)'));
	 $updMsgUnRead->bind_param('sii', $read,$user,$recip);
	 $updMsgUnRead->execute();
	 $updMsgUnRead->close();
}

//Update message as read
function updMsgRead($msg_from,$user,$unique_id){
	global $db;
	$read = "yes";
	($updMsgRead = $db->prepare('UPDATE pm SET user2read=? WHERE (user2=?) AND (unique_id=?)'));
	 $updMsgRead->bind_param('sii', $read,$user,$unique_id);
	 $updMsgRead->execute();
	 $updMsgRead->close();
}

//Function to encrypt and decrypt
function encrypt_str($value){
		$r='';
		$str=base64_encode($value);
		$abc='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		$a=str_split('+/='.$abc);
		$b=strrev('-_='.$abc);
			$r=rand(10,65);
			$b=mb_substr($b,$r).mb_substr($b,0,$r);
		$s='';
		$b=str_split($b);
		$str=str_split($str);
		$lens=count($str);
		$lena=count($a);
		for($i=0;$i<$lens;$i++){
			for($j=0;$j<$lena;$j++){
				if($str[$i]==$a[$j]){
					$s.=$b[$j];
				}
			};
		};
		return $s.$r;
	};

	function decrypt_str($value){
		$abc='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
		$a=str_split('+/='.$abc);
		$b=strrev('-_='.$abc);
		
			$r=mb_substr($value,-2);
			$str=mb_substr($value,0,-2);
			$b=mb_substr($b,$r).mb_substr($b,0,$r);
		$s='';
		$b=str_split($b);
		$str=str_split($value);
		$lens=count($str);
		$lenb=count($b);
		for($i=0;$i<$lens;$i++){
			for($j=0;$j<$lenb;$j++){
				if($str[$i]==$b[$j]){
					$s.=$a[$j];
				}
			};
		};
		$s=base64_decode($s);
			return $s;
	};
//Cron every ten minutes
function tenMinsCron(){
include_once ISVIPI_ROOT. 'inc/cron/cron.php';
}

function trunc_text($text, $limit) {
      if (str_word_count($text, 0) > $limit) {
          $words = str_word_count($text, 2);
          $pos = array_keys($words);
          $text = substr($text, 0, $pos[$limit]) . '...';
      }
      return $text;
    }
	
function makeLinks($value) {
    return preg_replace(
        '@(https?://([-\w\.]+[-\w])+(:\d+)?(/([\w/_\.#-~]*(\?\S+)?)?)?)@',
        '<a href="$1">$1</a>', $value);
}

function chooseTimeZone(){
	global $time_zone;
	$regions = array(
    'Africa' => DateTimeZone::AFRICA,
    'America' => DateTimeZone::AMERICA,
    'Antarctica' => DateTimeZone::ANTARCTICA,
    'Aisa' => DateTimeZone::ASIA,
    'Atlantic' => DateTimeZone::ATLANTIC,
    'Europe' => DateTimeZone::EUROPE,
    'Indian' => DateTimeZone::INDIAN,
    'Pacific' => DateTimeZone::PACIFIC
);
 
$timezones = array();
foreach ($regions as $name => $mask)
{
    $zones = DateTimeZone::listIdentifiers($mask);
    foreach($zones as $timezone)
    {
		// Lets sample the time there right now
		$time = new DateTime(NULL, new DateTimeZone($timezone));
 
		// Us dumb Americans can't handle millitary time
		$ampm = $time->format('H') > 12 ? ' ('. $time->format('g:i a'). ')' : '';
 
		// Remove region name and add a sample time
		$timezones[$name][$timezone] = substr($timezone, strlen($name) + 1) . ' - ' . $time->format('H:i') . $ampm;
	}
}
// View
print '<select id="timezone" class="form-control" name="time_zone">';
foreach($timezones as $region => $list)
{
	print '<optgroup label="' . $region . '">' . "\n";
	foreach($list as $timezone => $name)
	{?>
		<option <?php if ($time_zone == $timezone){echo 'selected';}?>><?php echo $timezone ?></option>
	<?php }
	print '<optgroup>' . "\n";
}
print '</select>';
}

function getAdminGenSett(){
	global $db;
	global $usrReg;
	global $usrValid;
	global $sysCron;
	global $timeZ;
	$getAdminGen = $db->prepare("SELECT user_registration,user_validate,sys_cron,timezone FROM general_settings LIMIT 1");
	$getAdminGen->execute();
	$getAdminGen->store_result();
	$getAdminGen->bind_result($usrReg,$usrValid,$sysCron,$timeZ);
	$getAdminGen->fetch();
	$getAdminGen->close();	
}

/////////////////////////////////
////// MESSAGES ////////////////
////////////////////////////////
function actEmail(){
	global $db;
	global $activation_email;
	global $act_subject;
	$purpose ="activation";
	$actEml = $db->prepare("SELECT subject,message FROM site_messages WHERE purpose=?");
	$actEml->bind_param("s",$purpose);
	$actEml->execute();
	$actEml->store_result();
	$actEml->bind_result($act_subject,$activation_email);
	$actEml->fetch();
	$actEml->close();	
}
function passRecovEmail(){
	global $db;
	global $recov_email;
	global $rec_subject;
	$purpose ="recovery";
	$actEml = $db->prepare("SELECT subject,message FROM site_messages WHERE purpose=?");
	$actEml->bind_param("s",$purpose);
	$actEml->execute();
	$actEml->store_result();
	$actEml->bind_result($rec_subject,$recov_email);
	$actEml->fetch();
	$actEml->close();	
}
function checkDateTime($value) {
	list($m, $d, $y) = explode('/', $value);
		if(checkdate($m, $d, $y)){
  	return TRUE;
	} else {
	return FALSE;
	}
}
?>