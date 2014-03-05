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
//include_once ISVIPI_USER_INC_BASE. 'emailFunc.php';
function AgentIPCheck(){
	global $db;
	$admin_id =$_SESSION['admin_id'];
	$agentcheck = $db->prepare("SELECT ip,user_agent FROM admin WHERE id=?");
	$agentcheck->bind_param("i",$admin_id);
	$agentcheck->execute();
	$agentcheck->store_result();
	$agentcheck->bind_result($ip,$userAgent);
	$agentcheck->fetch();
	$agentcheck->close();	
		$curr_ip = $_SERVER['REMOTE_ADDR'];
		$curr_usrAgnt = $_SERVER['HTTP_USER_AGENT'];
			if ($curr_ip == $ip && $curr_usrAgnt == $userAgent)
			{
				return true;	
			}
			else
			{
				return false;
			}
}
function isAdminLoggedIn (){
	if(!isset($_SESSION['admin_logged_in'])) {
		$_SESSION['err'] ="You MUST be logged in to view that page";
		header('location: '.ISVIPI_URL.'admin/login/');
		exit();
		}
		else if (!AgentIPCheck()){
		$_SESSION['err'] ="Seems like either your IP or Browser has changed";
		header('location: '.ISVIPI_URL.'admin/login/');
		exit();	
		}
	}
function getAdminDetails($value){
	global $db;
	global $username;
	global $email;
	$getAdminDet = $db->prepare("SELECT username,email FROM admin WHERE id=?");
	$getAdminDet->bind_param("i",$value);
	$getAdminDet->execute();
	$getAdminDet->store_result();
	$getAdminDet->bind_result($username,$email);
	$getAdminDet->fetch();
	$getAdminDet->close();	
}
function getIsVipiFeeds(){
		$rss = new DOMDocument();
	$rss->load('http://isvipi.com/feed/');
	$feed = array();
	foreach ($rss->getElementsByTagName('item') as $node) {
		$item = array ( 
			'title' => $node->getElementsByTagName('title')->item(0)->nodeValue,
			'desc' => $node->getElementsByTagName('description')->item(0)->nodeValue,
			'link' => $node->getElementsByTagName('link')->item(0)->nodeValue,
			'date' => $node->getElementsByTagName('pubDate')->item(0)->nodeValue,
			);
		array_push($feed, $item);
	}
	$limit = 1;
	for($x=0;$x<$limit;$x++) {
		$title = str_replace(' & ', ' &amp; ', $feed[$x]['title']);
		$link = $feed[$x]['link'];
		$description = $feed[$x]['desc'];
		$descr = trunc_text($description, 20);
		$date = date('l F d, Y', strtotime($feed[$x]['date']));
		echo '<small><em>Posted on '.$date.'</em></small></p>';
		echo '<p><strong><a href="'.$link.'" title="'.$title.'">'.$title.'</a></strong><br />';
		echo '<p>'.$descr.'</p>';
	}
}

function checkVersion(){
siteGenSett();
global $site_url;
$referrer = $site_url;
define('REMOTE_VERSION', 'http://isvipi.com/version/version.php?referrer='.urlencode($referrer).'');
define('VERSION', '1.0.0');
$script = file_get_contents(REMOTE_VERSION);
$version = VERSION;
if($version == $script) {
	/**global $db;
	$uplastVcheck = $db->prepare('UPDATE site_settings set last_version_check=NOW() LIMIT 1');
	$uplastVcheck->execute();
	$uplastVcheck->close();	**/
} else {
	echo "<div class='alert alert-info'>";
    echo "<i class='fa fa-warning'></i> <a href='http://isvipi.com/download/' target='_blank' title='Download Latest Version' data-toggle='tooltip' data-placement='bottom'>New Version Available</a>";
	echo "</div>";
}
}

//Get Members function
function getMembersAll(){
	global $db;
	global $getmembersAll;
	global $id;
	global $profile_name;
	global $email;
	global $Allcount;
	global $status;
	$getmembersAll = $db->prepare("SELECT id,username,email,active FROM members");
	$getmembersAll->execute();
	$getmembersAll->store_result();
	$getmembersAll->bind_result($id,$profile_name,$email,$status);
	$Allcount = $getmembersAll->num_rows();
}

//Check if isOnline
function isOnlineNOW($value){
	global $db;
	$online = '1';
	$isOnline = $db->prepare("SELECT username FROM members WHERE (online=? AND id=?)");
	$isOnline->bind_param('ii', $online,$value);
	$isOnline->execute();
	$isOnline->store_result();
	if ($isOnline->num_rows() > 0){
		return TRUE;
	}
	else
	{
		return FALSE;
	}
}
//Get Members function
function getMembersAll2($pager,$filter,$p_limit){
	global $db;
	global $getmembersAll2;
	global $id;
	global $profile_name;
	global $email;
	global $m_count;
	global $status;
	if ($filter=="5"){
	$getmembersAll2 = $db->prepare("SELECT id,username,email,active FROM members ORDER BY ID DESC LIMIT ?, ?");
	$getmembersAll2->bind_param("ii",$pager,$p_limit);
	$getmembersAll2->execute();
	$getmembersAll2->store_result();
	$getmembersAll2->bind_result($id,$profile_name,$email,$status);
	$m_count = $getmembersAll2->num_rows;	
	} else {
	$getmembersAll2 = $db->prepare("SELECT id,username,email,active FROM members WHERE active=?");
	$getmembersAll2->bind_param("i",$filter);
	$getmembersAll2->execute();
	$getmembersAll2->store_result();
	$getmembersAll2->bind_result($id,$profile_name,$email,$status);
	$m_count = $getmembersAll2->num_rows;
	
	}
}

//Get New Members function
function getNewMembersAll(){
	global $db;
	global $getmembers;
	global $id;
	global $n_count;
	global $username;
	global $email;
	$getmembers = $db->prepare("SELECT id,username,email FROM members where (reg_date > NOW() - INTERVAL 1 DAY) ORDER BY ID Desc");
	$getmembers->execute();
	$getmembers->store_result();
	$getmembers->bind_result($id,$username,$email);
	$n_count = $getmembers->num_rows();
}

//Get New Members function
function getNewMembersAll2(){
	global $db;
	global $getmembers;
	global $id;
	global $n_count;
	global $username;
	global $email;
	$getmembers = $db->prepare("SELECT id,username,email FROM members where (reg_date > NOW() - INTERVAL 1 DAY) ORDER BY ID Desc LIMIT 0, 5");
	$getmembers->execute();
	$getmembers->store_result();
	$getmembers->bind_result($id,$username,$email);
	$n_count = $getmembers->num_rows();
}

//Get site settings
function siteGenSett(){
	global $db;
	global $site_url;
	global $site_title;
	global $site_email;
	global $theme;
	global $time_zone;
	global $site_status;
	$status ="1";
	$siteGen = $db->prepare("SELECT site_url,site_title,site_email,theme,time_zone,status FROM site_settings LIMIT 1");
	$siteGen->execute();
	$siteGen->store_result();
	$siteGen->bind_result($site_url,$site_title,$site_email,$theme,$time_zone,$site_status);
	$siteGen->fetch();
	$siteGen->close();	
}

function upSiteStatus($value){
	global $db;
	$status ="1";
	$siteStatus = $db->prepare("UPDATE site_settings SET status=? LIMIT 1");
	$siteStatus->bind_param("i", $value);
	$siteStatus->execute();
	$siteStatus->close();	
}
function selectTheme(){
	global $db;
	global $user_country;
	$selTheme = $db->prepare("SELECT theme_name FROM themes");
	$selTheme->execute();
	$selTheme->store_result();
	$selTheme->bind_result($theme_name);
	echo '<select name="theme_name" class="form-control">';
	while($selTheme->fetch()){?>
	<option value="<?php echo $theme_name ?>"><?php echo $theme_name ?></option>
    <?php }
	echo '</select>';
}

function isTwoWeeks(){
	global $db;
	$isTwoW = $db->prepare("SELECT id FROM site_settings WHERE (last_version_check > NOW() - INTERVAL 2 WEEK)");
	$isTwoW->execute();
	$isTwoW->store_result();
	if ($isTwoW->num_rows > 0){
	return false;
	}
	else {
		return true;
	}
	$isTwoW->close();
}

?>