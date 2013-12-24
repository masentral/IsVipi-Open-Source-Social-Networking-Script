<?php

if(!defined('INCLUDE_CHECK')) die('You are not allowed to execute this file directly');

function relativeTime($dt,$precision=2)
{
	$times=array(	365*24*60*60	=> "year",
					30*24*60*60		=> "month",
					7*24*60*60		=> "week",
					24*60*60		=> "day",
					60*60			=> "hour",
					60				=> "minute",
					1				=> "second");
	
	$passed=time()-$dt;
	
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

function formatTweet($tweet,$dt)
{
	if(is_string($dt)) $dt=strtotime($dt);

	$tweet=htmlspecialchars(stripslashes($tweet));
// fetch the id
//$user = $_SESSION['user_id'];
// fetch the username
$username = '';
list($username) = mysql_fetch_array(mysql_query("SELECT username FROM timeline WHERE tweet = '$tweet'"));

if(!$username) $username = "error";


// fetch the id
list($user_id) = mysql_fetch_array(mysql_query("SELECT id FROM users WHERE username = '$username'"));
$user = $user_id;


$site = '';
list($site) = mysql_fetch_array(mysql_query("SELECT site_url FROM site_settings"));
if(!$site) $site = "http://localhost/isvipi/";

$theme = '';
list($theme) = mysql_fetch_array(mysql_query("SELECT theme FROM site_settings"));
if(!$theme) $theme = "default";

$thumb_path = '';
list($thumb_path) = mysql_fetch_array(mysql_query("SELECT thumb_path FROM users WHERE username = '$username'"));

if(!$thumb_path) $thumb_path = "http://$site/themes/$theme/images/avatar.jpg";

	return'
	<li>
	<div class="timeline_display">
	<div class="user_timeline_image">
	<a href="member_profile.php?id='.$user.'"><img class="avatar" src="'.$thumb_path.'" width="48" height="48" alt="profile pic" /></a>
	</div>
	<div class="tweetTxt">
	<strong><a href="member_profile.php?id='.$user.'">'.$username.'</a></strong> '. preg_replace('/((?:http|https|ftp):\/\/(?:[A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?[^\s\"\']+)/i','<a href="$1" rel="nofollow" target="blank">$1</a>',$tweet).'
	<div class="date">'.relativeTime($dt).'</div>
	</div>
	</div>
	<div class="clear"></div>
	</li>';

}

?>