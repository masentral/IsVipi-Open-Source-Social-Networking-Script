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
$adm = get_post_var('action');
if ($adm !== 'new_ann' && $adm !== 'GenS' && $adm !== 'upTheme' && $adm !== 'c_theme' && $adm !=='otherSett' && $adm !=='adminURL' && $adm !=='newLang' && $adm !=='updSEO'){
	$_SESSION['err'] =UNKNOWN_REQ;
    header ('location:'.$from_url.'');
	exit();
} 
/////////////////////////////////////////////////////////////
//////////////// ADMIN ANNOUNCEMENTS ///////////////////////
////////////////////////////////////////////////////////////
if ($adm == 'new_ann') {
	$ann_date = $_POST["date"];	
	$ann_subject = $_POST["ann_subject"];	
		if (empty($ann_subject)) {
			echo
			$_SESSION['err'] =SUBJECT.E_IS_EMPTY;
			header ('location:'.$from_url.'');
			exit();
		  }	
		 if (!preg_match('/^[a-zA-Z0-9_. ]{1,60}$/', $ann_subject))
		{
			$_SESSION['err'] =E_INVALID_CHARS_IN.SUBJECT;
			header ('location:'.$from_url.'');
			exit();
		}
		$announcement = $_POST["ann_cont"];	
		if (empty($announcement)) {
			echo
			$_SESSION['err'] =CONTENT.E_IS_EMPTY;
			header ('location:'.$from_url.'');
			exit();
		  }
		$sanAnnoun = htmlspecialchars("".$announcement."", ENT_QUOTES);
		$Add = $db->prepare('insert into announcements (date, subject, content) values (?, ?, ?)');
		$Add->bind_param('sss', $ann_date,$ann_subject,$sanAnnoun);
		$Add->execute();
			$_SESSION['succ'] =S_SUCCESS;
			header ('location:'.$from_url.'');
			exit();
}

/////////////////////////////////////////////////////////////
//////////////// SITE SETTINGS /////////////////////////////
////////////////////////////////////////////////////////////
if ($adm == 'GenS') {
		$site_url = $_POST["site_url"];
		if (!preg_match('/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i', $site_url)){
			$_SESSION['err'] =E_INVALID_CHARS_IN.S_URL;
			header ('location:'.$from_url.'');
			exit();
		}

		$site_title = $_POST["site_title"];
		if (!preg_match('/[^,;:a-zA-Z0-9_-]/s', $site_title)){
			$_SESSION['err'] =E_INVALID_CHARS_IN.S_TITLE;
			header ('location:'.$from_url.'');
			exit();
		}	

		$site_email = $_POST["site_email"];
		if (!preg_match('/([\w\-]+\@[\w\-]+\.[\w\-]+)/', $site_email)){
			$_SESSION['err'] =E_INVALID_CHARS_IN.S_EMAIL;
			header ('location:'.$from_url.'');
			exit();
		}
		
		$lang = $_POST["language"];
		if (!preg_match('/([\w\-]+\@[\w\-]+\.[\w\-]+)/', $site_email)){
			$_SESSION['err'] =E_INVALID_CHARS_IN.LANGUAGE;
			header ('location:'.$from_url.'');
			exit();
		}		

		$site_timezone = $_POST["time_zone"];
	$stmt = $db->prepare('UPDATE site_settings SET site_url=?,site_title=?,site_email=?,time_zone=?');
		$stmt->bind_param('ssss', $site_url, $site_title,$site_email,$site_timezone);
		$stmt->execute();
		$stmt->close();
	$stmt = $db->prepare('UPDATE general_settings SET lang=?');
		$stmt->bind_param('s', $lang);
		$stmt->execute();
		$stmt->close();
		$_SESSION['succ'] =S_SUCCESS;
			header ('location:'.$from_url.'');
			exit();
		} 
		
/////////////////////////////////////////////////////////////
//////////////// UPLOAD NEW THEME //////////////////////////
////////////////////////////////////////////////////////////
if ($adm == 'upTheme') {
if($_FILES["new_theme"]["name"]) {
	$filename = $_FILES["new_theme"]["name"];
	$source = $_FILES["new_theme"]["tmp_name"];
	$type = $_FILES["new_theme"]["type"];
	
	$name = explode(".", $filename);
	$accepted_types = array('application/zip', 'application/x-zip-compressed', 'multipart/x-zip', 'application/x-compressed');
	foreach($accepted_types as $mime_type) {
		if($mime_type == $type) {
			$okay = true;
			break;
		} 
	}
	
	$continue = strtolower($name[1]) == 'zip' ? true : false;
	if(!$continue) {
		$_SESSION['err'] =E_UPLOAD_ZIP;
			header ('location:'.$from_url.'');
			exit();
	}

	$target_path = "".ISVIPI_THEMES."".$filename; 
	if(move_uploaded_file($source, $target_path)) {
		$zip = new ZipArchive();
		$x = $zip->open($target_path);
		if ($x === true) {
			$zip->extractTo("".ISVIPI_THEMES.""); 
			$zip->close();
			unlink($target_path);
		}
			$themeName = strstr($filename,'.',true);
			$tokens = token_get_all(file_get_contents(''.ISVIPI_THEMES.''.$themeName.'/index.php'));
			$theme_details = array($tokens);
				foreach($tokens as $token) {
					if($token[0] == T_COMMENT || $token[0] == T_DOC_COMMENT) {
						$theme_details = explode("\n", $token[1]);
					}
				}
				if (isset($theme_details)){
				$themename = preg_split("/:/", $theme_details[1]);
				$themeurl = preg_split("/:/", $theme_details[2],2);
				$description = preg_split("/:/", $theme_details[3]);
				$version = preg_split("/:/", $theme_details[4]);
				$author = preg_split("/:/", $theme_details[5]);
				$author_url = preg_split("/:/", $theme_details[6],2);
				
				
				$insTheme = $db->prepare('insert into themes (theme_name, theme_url, description, version, author, author_url) values (?,?,?,?,?,?)');
				$insTheme->bind_param('ssssss', $themename[1],$themeurl[1],$description[1],$version[1],$author[1],$author_url[1]);
				$insTheme->execute();
				$_SESSION['succ'] =S_SUCCESS;
				header ('location:'.$from_url.'');
				exit();
				}else{
					$_SESSION['err'] =E_THEME_ERR. $themeName;
					header ('location:'.$from_url.'');
					exit();
				}
			
	} else {
			$_SESSION['err'] =E_SYS_ERR;
			header ('location:'.$from_url.'');
			exit();	
	}
}	
}

/////////////////////////////////////////////////////////////
//////////////// CHANGE THEME //////////////////////////////
////////////////////////////////////////////////////////////
if ($adm == 'c_theme') {
		$theme = $_POST["theme_name"];
		$theme = preg_replace('/\s+/', '', $theme);
		$upTheme = $db->prepare('UPDATE site_settings set theme=? LIMIT 1');
		$upTheme->bind_param('s', $theme);
		$upTheme->execute();
				$_SESSION['succ'] =S_SUCCESS;
				header ('location:'.$from_url.'');
}

/////////////////////////////////////////////////////////////
//////////////// ADMIN OTHER SETTINGS ///////////////////////
////////////////////////////////////////////////////////////
if ($adm == 'otherSett') {
if (isset($_POST["AllowReg"])){
	$AllowReg = $_POST["AllowReg"];	
	} else {
		$AllowReg = "0";
	}
if (isset($_POST["usrValidate"])){
	$usrValidate = $_POST["usrValidate"];	
	} else {
		$usrValidate = "0";
	}
if (isset($_POST["sysZone"])){
	$sysZone = $_POST["sysZone"];	
	} else {
		$sysZone = "0";
	}
if (isset($_POST["sysCron"])){
	$sysCron = $_POST["sysCron"];	
	} else {
		$sysCron = "0";
	}
if (isset($_POST["mobileTheme"])){
	$mobileEnab = $_POST["mobileTheme"];	
	} else {
		$mobileEnab = "0";
	}
if (isset($_POST["sysMaint"])){
	upSiteStatus('3');
	} else {
	upSiteStatus('1');
	}
	$stmt = $db->prepare('UPDATE general_settings SET user_registration=?,user_validate=?,sys_cron=?,timezone=?,mobile_enabled=? LIMIT 1');
	$stmt->bind_param('iiiii', $AllowReg,$usrValidate,$sysCron,$sysZone,$mobileEnab);
	$stmt->execute();
		$_SESSION['succ'] =S_SUCCESS;
    	header ('location:'.$from_url.'');
		exit();

}

/////////////////////////////////////////////////////////////
//////////////// CHANGR ADMIN PATH /////////////////////////
////////////////////////////////////////////////////////////
if ($adm == 'adminURL') {
	$adminURL = get_post_var('admPath');	
	if (empty($adminURL)) {
	$_SESSION['err'] =E_EMPTY_ADMIN_PATH;
	header ('location:'.$from_url.'');
	exit();
	}
	$stmt = $db->prepare('UPDATE general_settings SET admin_end=? LIMIT 1');
	$stmt->bind_param('s', $adminURL);
	$stmt->execute();
		$_SESSION['succ'] =S_SUCCESS;
    	header ('location:'.ISVIPI_URL.$adminURL.'/sys_management');
		exit();
		$db->close();
}		
/////////////////////////////////////////////////////////////
//////////////// ADD NEW LANGUAGE //////////////////////////
////////////////////////////////////////////////////////////
if ($adm == 'newLang') {
	$official= get_post_var('officialName');
	if (empty($official)) {
	$_SESSION['err'] =LANGUAGE.E_IS_EMPTY;
	header ('location:'.$from_url.'');
	exit();
	}
	if (!preg_match('/^[a-zA-Z0-9_ ]{1,60}$/', $official))
		{
			$_SESSION['err'] =E_INVALID_CHARS_IN.LANGUAGE;
			header ('location:'.$from_url.'');
			exit();
		}
	$abbrev = get_post_var('abbrev');
	if (empty($abbrev)) {
	$_SESSION['err'] =ABBREV.E_IS_EMPTY;
	header ('location:'.$from_url.'');
	exit();
	}
		if (!preg_match('/^[a-zA-Z0-9_ ]{1,60}$/', $abbrev))
		{
			$_SESSION['err'] =E_INVALID_CHARS_IN.ABBREV;
			header ('location:'.$from_url.'');
			exit();
		}
		if (strlen($abbrev) > 5)
	{
	$_SESSION['err'] =E_LONG_ABBREV;
    header ('location:'.$from_url.'');
	exit();
	}
				//let's first find out if the language already exists
				$stmt = $db->prepare('select id from languages where (name=? OR abbr=?)');
				$stmt->bind_param('ss', $official,$abbrev);
				$stmt->execute();
				$stmt->store_result();
				if ($stmt->num_rows > 0){
					$_SESSION['err'] ="language file already in the db";
					header ('location:'.$from_url.'');
					exit();
				}
				
				
				$official = strtoupper($official);
				$stmt = $db->prepare('insert into languages (name, abbr) values (?,?)');
				$stmt->bind_param('ss', $official,$abbrev);
				$stmt->execute();
				$_SESSION['succ'] =S_SUCCESS;
				header ('location:'.$from_url.'');
				exit();
}

/////////////////////////////////////////////////////////////
//////////////// UPDATE SEO //////// ///////////////////////
////////////////////////////////////////////////////////////
if ($adm == 'updSEO') {
	$meta_keywords = get_post_var('meta_tags');
	$meta_description= get_post_var('meta_description');
	if (empty($meta_keywords)) {
	$_SESSION['err'] =META_TAGS_TXT.E_IS_EMPTY;
	header ('location:'.$from_url.'');
	exit();
	}
	if (empty($meta_description)) {
	$_SESSION['err'] =META_DESC.E_IS_EMPTY;
	header ('location:'.$from_url.'');
	exit();
	}
	if (!preg_match('/^[a-zA-Z0-9, ]+$/', $meta_keywords)){
	$_SESSION['err'] =E_INVALID_CHARS_IN.META_TAGS_TXT;
	header ('location:'.$from_url.'');
	exit();	
	}
	if (!preg_match('/^[a-zA-Z0-9, ]+$/', $meta_description)){
	$_SESSION['err'] =E_INVALID_CHARS_IN.META_DESC;
	header ('location:'.$from_url.'');
	exit();	
	}
	$stmt = $db->prepare('UPDATE seo SET meta_tags=?,meta_description=?');
		$stmt->bind_param('ss', $meta_keywords, $meta_description);
		$stmt->execute();
		$stmt->close();
			$_SESSION['succ'] =S_SUCCESS;
			header ('location:'.$from_url.'');
			exit();
	
}
?>