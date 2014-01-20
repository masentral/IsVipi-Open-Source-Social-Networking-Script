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
function checkEmail($email){
	global $db;
	$chkeml = $db->prepare("SELECT email FROM members WHERE email=?");
	$chkeml->bind_param("s",$email);
	$chkeml->execute();
	$chkeml->store_result();
		if ($chkeml->num_rows > 0){
	return true;
	}
	return false;
$chkeml->free_result();
$chkeml->close();
}

//Add User after completing all validation requirements
function addUser($user,$d_name,$hash,$email,$randomstring,$user_gender,$user_dob,$user_city,$user_country){
	global $db;
	$active = "0";
	$stmt = $db->prepare('insert into members (username, password, email, a_code, active, reg_date, level, online) values (?, ?, ?, ?, ?, NOW(), "1", "5")');
	$stmt->bind_param('ssssi', $user, $hash, $email, $randomstring, $active);
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
function xtractUID($xid){
	//Extract the ID of the user that has just signed up
	global $uid;
	global $db;
	$xtrctid = $db->prepare("SELECT id FROM members WHERE username=?");
	$xtrctid->bind_param("s",$xid);
	$xtrctid->execute();
	$xtrctid->store_result();
	$xtrctid->bind_result($uid);
	$xtrctid->fetch();
	$xtrctid->close();
}
//Update user profile
function updateProfile($user,$display_n,$user_id_n,$gender_n,$dob_n,$phone_n,$city_n,$coutry_n){
	global $db;
	//Update user status to online
	$upoprf = $db->prepare('UPDATE member_sett set d_name=?,gender=?,dob=?,phone=?,city=?,country=? where user_id=?');
	$upoprf->bind_param('ssssssi', $display_n,$gender_n,$dob_n,$phone_n,$city_n,$coutry_n,$user_id_n);
	$upoprf->execute();
	$upoprf->close();
}
//Update timeline/activity feeds
function updateTimeline($user,$activity){
	global $db;
	//Update user status to online
	$updtml = $db->prepare('insert into timeline (username, activity, time) values (?, ?, NOW())');
	$updtml->bind_param('ss', $user, $activity);
	$updtml->execute();
	$updtml->close();
}

//Check login function to authenticate users before accessing the member area
function checkLogin(){
	if ( ! $_SESSION['logged_in'] ) {
		session_start();
		$_SESSION['err'] ="You MUST be logged in to view that page";
		header('location:../auth/login.php');
		exit();
	}
  }

//Update user status to online
function userOnline($user){
	global $db;
	$online = "1";
	//Update user status to online
	$uponl = $db->prepare('update members set online=? where username=?');
	$uponl->bind_param('is', $online, $user);
	$uponl->execute();
	$uponl->close();
}

//Get User Details function
function getUserDetails($user){
	global $db;
	global $email;
	global $reg_date;
	global $username;
	$getusr = $db->prepare("SELECT username,email,reg_date FROM members WHERE id=?");
	$getusr->bind_param("i",$user);
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
function logout($user){
    global $db;
    //update user status to offline
    $online = "0";
    $upoff = $db->prepare('update members set online=? where id=?');
	$upoff->bind_param('is', $online, $user);
	$upoff->execute();
	$upoff->close();
		session_start();
		session_destroy();
		session_start();
		$_SESSION['succ'] ="You have logged out successfully";
		header("location: ../index.php");	
		
		exit();
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
                   { $times=array(	365*24*60*60	=> "year",
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
				
		$output=implode(' and ',$output).' ago';
	}
	return $output;
}


//Retrieve Thumbnail
function t_thumb($uid){
	global $t_thumb;
	global $db;
	$getusr = $db->prepare("SELECT thumbnail FROM member_sett WHERE id=?");
	$getusr->bind_param('i', $uid);
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
	$getmembers = $db->prepare("SELECT id FROM members");
	$getmembers->execute();
	$getmembers->store_result();
	$getmembers->bind_result($id);
}
//Get Online Members function
function getOnlineMembers(){
	global $db;
	global $getmembers;
	global $id;
	$online = "1";
	$getmembers = $db->prepare("SELECT id FROM members where online=?");
	$getmembers->bind_param("i",$online);
	$getmembers->execute();
	$getmembers->store_result();
	$getmembers->bind_result($id);
}
//Get New Members function
function getNewMembers(){
	global $db;
	global $getmembers;
	global $id;
	$getmembers = $db->prepare("SELECT id FROM members ORDER BY ID Desc LIMIT 10");
	$getmembers->execute();
	$getmembers->store_result();
	$getmembers->bind_result($id);
}

//Get member details
function getMemberDet($id){
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
	$getusrst->bind_param("i",$id);
	$getusrst->execute();
	$getusrst->store_result();
	$getusrst->bind_result($m_name,$m_gender,$m_dob,$m_city,$m_country,$m_phone,$m_thumbnail);
	$getusrst->fetch();
	$getusrst->close();
		$now      = new DateTime();
		$birthday = new DateTime($m_dob);
		$interval = $now->diff($birthday);
		$m_age = $interval->format('%y years'); 
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
function getUserN($user_id){
	global $db;
	global $name;
	$getusrst = $db->prepare("SELECT d_name FROM member_sett WHERE user_id=?");
	$getusrst->bind_param("i",$user_id);
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
	$getnotice = $db->prepare("SELECT id, notice, time FROM notifications WHERE user=? Limit 20 ");
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
	$chkusr = $db->prepare("SELECT * FROM pm WHERE (user2=? AND user2read=?) GROUP BY unique_id");
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
