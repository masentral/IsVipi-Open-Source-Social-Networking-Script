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
 $from_url = $_SERVER['HTTP_REFERER'];
 require_once ISVIPI_USER_INC_BASE."ImageManipulator.php";
 if (isset($ACTION['2'])){
	 $feedAction = decryptHardened($ACTION['2']);
 } else if (isset($_POST['action'])){
 $feedAction = get_post_var('action');
 } else {
 $_SESSION['err'] =UNKNOWN_REQ;
    header ('location:'.$from_url.'#'.$ACTION['3']);
	exit(); 
 }
 $feedAction = preg_replace('/[^0-9]/','',$feedAction);
 if ($feedAction !== '1' && $feedAction !== '2' && $feedAction !== '3' && $feedAction !== '4' && $feedAction 
 !== '5' && $feedAction !== '6' && $feedAction !== '7' && $feedAction !== '8' && $feedAction !== '9'){
	$_SESSION['err'] =UNKNOWN_REQ;
    header ('location:'.$from_url.'#'.$ACTION['3']);
	exit();
} 

/////////////////////////////////////////////////////////////
//////////////// LIKE (1)//////////////////////////////////
////////////////////////////////////////////////////////////
if ($feedAction === '1') {
	global $db;
	$feedID = decryptHardened($ACTION['3']);
	$feedID = preg_replace('/[^0-9]/','',$feedID);
	$user = decryptHardened($ACTION['4']);
	$user = preg_replace('/[^0-9]/','',$user);
	
		if (hasLiked($feedID,$user)){
			$_SESSION['err'] =ALREADY_LIKED;
			header ('location:'.$from_url.'#'.$ACTION['3']);
			exit();
		}
		$stmt = $db->prepare('insert into likes (feed_id, user_like, timestamp) values (?, ?, NOW())');
		$stmt->bind_param('ii', $feedID,$user);
		$stmt->execute();
		$stmt->close();
		selectFeed($feedID);
		getUserDetails($user);
		$notice = "<a href=".ISVIPI_URL."profile/".$username.">".$username."</a> ".LIKED_YOUR." <a href=".ISVIPI_URL."status/".encryptHardened($feedID).">".STATUS."</a>";
		updNotices($uid,$notice);

			$_SESSION['succ'] =S_SUCCESS;
			header ('location:'.$from_url.'#'.$ACTION['3']);
			exit();
}

/////////////////////////////////////////////////////////////
//////////////// UNLIKE (2)//////////////////////////////////
////////////////////////////////////////////////////////////
if ($feedAction === '2') {
	global $db;
	$feedID = decryptHardened($ACTION['3']);
	$feedID = preg_replace('/[^0-9]/','',$feedID);
	$user = decryptHardened($ACTION['4']);
	$user = preg_replace('/[^0-9]/','',$user);
		$stmt = $db->prepare('DELETE from likes WHERE (feed_id=? AND user_like=?) ');
		$stmt->bind_param('ii', $feedID,$user);
		$stmt->execute();
			$_SESSION['succ'] =S_SUCCESS;
			header ('location:'.$from_url.'#'.$ACTION['3']);
			exit();
}

/////////////////////////////////////////////////////////////
//////////////// SHARE (3) ////////////////////////////////
////////////////////////////////////////////////////////////
if ($feedAction === '3') {
	global $db;
	$feedID = decryptHardened($ACTION['3']);
	$feedID = preg_replace('/[^0-9]/','',$feedID);
	$userID = decryptHardened($ACTION['4']);
	$userID = preg_replace('/[^0-9]/','',$userID);
		selectFeed($feedID);
		getUserDetails($uid);
		getUserDetails($userID);
		shareTimeline($userID,$username,$activity,$feedIMG,$uid);
		$notice = "<a href=".ISVIPI_URL."profile/".$username.">".$username."</a> ".SHARED_YOUR." <a href=".ISVIPI_URL."status/".encryptHardened($feedID).">".STATUS."</a>";
		updNotices($uid,$notice);
			$stmt = $db->prepare('insert into shares (feed_id, user_share, timestamp) values (?, ?, NOW())');
			$stmt->bind_param('ii', $feedID,$userID);
			$stmt->execute();
			$stmt->close();
				$_SESSION['succ'] =S_SUCCESS;
				header ('location:'.$from_url.'');
				exit();
}

/////////////////////////////////////////////////////////////
//////////////// DELETE TIMELINE POST (5) //////////////////
////////////////////////////////////////////////////////////
if ($feedAction === '5') {
	global $db;
	$feedID = decryptHardened($ACTION['3']);
	$feedID = preg_replace('/[^0-9]/','',$feedID);
	$userID = decryptHardened($ACTION['4']);
	$userID = preg_replace('/[^0-9]/','',$userID);
	selectFeed($feedID);
		$stmt = $db->prepare('DELETE from timeline WHERE id=?');
		$stmt->bind_param('i', $feedID);
		$stmt->execute();
		$stmt->close();
			$stmt = $db->prepare('DELETE from likes WHERE feed_id=?');
			$stmt->bind_param('i', $feedID);
			$stmt->execute();
			$stmt->close();
				$stmt = $db->prepare('DELETE from shares WHERE feed_id=?');
				$stmt->bind_param('i', $feedID);
				$stmt->execute();
				$stmt->close();
			//Delete any images associated with it
			if($feedIMG !=""){
			$Delpath = ISVIPI_INC_BASE."images/timeline/".$feedIMG;
			unlink ($Delpath);	
			}
			$_SESSION['succ'] =S_SUCCESS;
			header ('location:'.$from_url.'#'.$ACTION['3']);
			exit();
}

/////////////////////////////////////////////////////////////
//////////////// COMMENT (4)//////////////////////////////////
////////////////////////////////////////////////////////////
if ($feedAction === '4') {
	$feedID = get_post_var('feed_identity');
	$commentBy = get_post_var('userid');
	$commentBy = preg_replace('/[^0-9]/','',$commentBy);
	$feedID = preg_replace('/[^0-9]/','',$feedID);
	$comment = get_post_var('comment_reply');
	$comment = str_replace("  ","",$comment); 
	if (trim($comment)===''){
		$_SESSION['err'] =COMMENT.E_IS_EMPTY;
			header ('location:'.$from_url.'#'.encryptHardened($feedID));
			exit();
	}
	$comment = htmlspecialchars($comment, ENT_QUOTES);
	
		if (empty($comment)) {
			$_SESSION['err'] =COMMENT.E_IS_EMPTY;
			header ('location:'.$from_url.'#'.encryptHardened($feedID));
			exit();
			}
	$comment = ParText($comment);
		$stmt = $db->prepare('insert into comments (feed_id, comment, comment_by, timestamp) values (?, ?, ?, NOW())');
		$stmt->bind_param('isi', $feedID,$comment,$commentBy);
		$stmt->execute();
		$stmt->close();
		selectFeed($feedID);
		getUserDetails($commentBy);
		$notice = "<a href=".ISVIPI_URL."profile/".$username.">".$username."</a> ".COMMENTED_ON_YOUR." <a href=".ISVIPI_URL."status/".encryptHardened($feedID).">".STATUS."</a>";
		updNotices($uid,$notice);
	$_SESSION['succ'] =S_SUCCESS;
	header ('location:'.$from_url.'#'.encryptHardened($feedID));
	exit();
}

/////////////////////////////////////////////////////////////
//////////////// LIKE COMMENT (6) //////////////////////////
////////////////////////////////////////////////////////////
if ($feedAction === '6') {
	$feedID = decryptHardened($ACTION['3']);
	$feedID = preg_replace('/[^0-9]/','',$feedID);
	$commentID = decryptHardened($ACTION['4']);
	$commentID = preg_replace('/[^0-9]/','',$commentID);
	$userLiking = decryptHardened($ACTION['5']);
	$userLiking = preg_replace('/[^0-9]/','',$userLiking);
	if (hasLikedComment($commentID,$userLiking)){
	$_SESSION['err'] =ALREADY_LIKED;
			header ('location:'.$from_url.'#'.$ACTION['3']);
			exit();	
		
	}
		$stmt = $db->prepare('insert into comment_likes (feed_id, comment_id, user_like, timestamp) values (?, ?, ?, NOW())');
		$stmt->bind_param('isi', $feedID,$commentID,$userLiking);
		$stmt->execute();
		$stmt->close();
		selectthisComment($feedID);
		getUserDetails($userLiking);
		$notice = "<a href=".ISVIPI_URL."profile/".$username.">".$username."</a> ".LIKED_YOUR." <a href=".ISVIPI_URL."status/".encryptHardened($feedID).">".COMMENT."</a>";
		updNotices($commBy,$notice);
	$_SESSION['succ'] =S_SUCCESS;
	header ('location:'.$from_url.'#'.$ACTION['3']);
	exit();
}

/////////////////////////////////////////////////////////////
//////////////// UNLIKE COMMENT (7) ////////////////////////
////////////////////////////////////////////////////////////
if ($feedAction === '7') {
	$commentID = decryptHardened($ACTION['3']);
	$commentID = preg_replace('/[^0-9]/','',$commentID);
	$userLiking = decryptHardened($ACTION['4']);
	$userLiking = preg_replace('/[^0-9]/','',$userLiking);
		$stmt = $db->prepare('DELETE from comment_likes WHERE (comment_id=? AND user_like=?) ');
		$stmt->bind_param('ii', $commentID,$userLiking);
		$stmt->execute();
		$stmt->close();
			$_SESSION['succ'] =S_SUCCESS;
			header ('location:'.$from_url.'#'.$ACTION['3']);
			exit();
}

/////////////////////////////////////////////////////////////
//////////////// DELETE COMMENT (8) ////////////////////////
////////////////////////////////////////////////////////////
if ($feedAction === '8') {
	$commentID = decryptHardened($ACTION['3']);
	$commentID = preg_replace('/[^0-9]/','',$commentID);
	//Delete comment
		$stmt = $db->prepare('DELETE from comments WHERE id=?');
		$stmt->bind_param('i', $commentID);
		$stmt->execute();
		$stmt->close();
			//Delete any like associated with the comment
			//This keeps our database tidy
			$stmt = $db->prepare('DELETE from comment_likes WHERE comment_id=?');
			$stmt->bind_param('i', $commentID);
			$stmt->execute();
			$stmt->close();
				$_SESSION['succ'] =S_SUCCESS;
				header ('location:'.$from_url.'#'.$ACTION['3']);
				exit();	
}

/////////////////////////////////////////////////////////////
//////////////// PHOTO STATUS UPDATE (9) ///////////////////
////////////////////////////////////////////////////////////
if ($feedAction === '9') {
	$postByID = get_post_var('userid');
	$postByID = preg_replace('/[^0-9]/','',$postByID);
	$activity = get_post_var('myfeed');
	$activity = str_replace("  ","",$activity);
		$activity = htmlspecialchars($activity, ENT_QUOTES);
		if (!empty($activity)) {
			trim($activity)==='';
			$activity = ParText($activity);
			}
	$postByUsername = get_post_var('username');
		if (!preg_match('/^[a-zA-Z0-9_]{1,60}$/', $postByUsername)){
		$_SESSION['err'] =E_INVALID_CHAR_USERNAME;
		header ('location:'.$from_url.'');
		exit();
		}
	
	
	$path = ISVIPI_INC_BASE."images/timeline/";
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))
&& in_array($extension, $allowedExts)) {
  if ($_FILES["file"]["size"] > 200000) {
    $_SESSION['err'] =E_FILE_TOO_LARGE. " 200kb";
	  header ('location:'.$from_url.'');
	  exit();   
  } else {
	  $imagename = $_FILES["file"]["name"];
$manipulator = new ImageManipulator($_FILES['file']['tmp_name']);
        // resizing to 300x200
        $newImage = $manipulator->resample(300, 200);
		$newname = $postByUsername."-".microtime();
		$newnameFinal =$newname.$imagename.".".$extension;
		$manipulator->save($path .$newnameFinal );
      //move_uploaded_file($_FILES["file"]["tmp_name"],
      //$path . $newname);
	 
	  		$updtml = $db->prepare('insert into timeline (uid, username, activity, time, feed_img) values (?, ?, ?, NOW(),?)');
			$updtml->bind_param('isss', $postByID, $postByUsername, $activity, $newnameFinal);
			$updtml->execute();
			$updtml->close();
	  $_SESSION['succ'] =S_SUCCESS;
	  header ('location:'.$from_url.'');
	  exit();    
	  }
} else {
  $_SESSION['err'] =E_INV_IMAGE;
	  header ('location:'.$from_url.'');
	  exit(); 
}
}
?>