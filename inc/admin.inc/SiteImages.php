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
$op = get_post_var('op');
if ($op !== 'logo' && $op !== 'favicon')
	{
    $_SESSION['err'] =UNKNOWN_REQ;
    header ('location:'.$from_url.'');
	exit();
	}

/////////////////////////////////////////////////////////////
//////////////// UPLOAD LOGO ///////////////////////////////
////////////////////////////////////////////////////////////
if ($op === 'logo') {
$path = ISVIPI_STYLE_BASE."images/site/";
$allowedExts = array("gif", "jpeg", "jpg", "png");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
$newname = "logo-".microtime();

if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 1000000)
&& in_array($extension, $allowedExts)) {
  if ($_FILES["file"]["error"] > 0) {
    $_SESSION['err'] =E_INV_IMAGE. OR_HOME . E_SYS_ERR;
	  header ('location:'.$from_url.'');
	  exit();   
  } else {
	  $imagename = $_FILES["file"]["name"];
      move_uploaded_file($_FILES["file"]["tmp_name"],
      $path . $imagename);
	  	$id = "1";
	  	$stmt = $db->prepare('UPDATE general_settings set logo_name=? where id=?');
		$stmt->bind_param('si', $imagename,$id);
		$stmt->execute();
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


/////////////////////////////////////////////////////////////
//////////////// UPLOAD FAVICON ////////////////////////////
////////////////////////////////////////////////////////////
if ($op === 'favicon') {
$path = ISVIPI_STYLE_BASE."images/site/";
$allowedExts = array("gif", "jpeg", "jpg", "png", "ico");
$temp = explode(".", $_FILES["file"]["name"]);
$extension = end($temp);
$newname = "logo-".microtime();

if ((($_FILES["file"]["type"] == "image/gif")
|| ($_FILES["file"]["type"] == "image/jpeg")
|| ($_FILES["file"]["type"] == "image/jpg")
|| ($_FILES["file"]["type"] == "image/pjpeg")
|| ($_FILES["file"]["type"] == "image/x-png")
|| ($_FILES["file"]["type"] == "image/x-icon")
|| ($_FILES["file"]["type"] == "image/png"))
&& ($_FILES["file"]["size"] < 1000000)
&& in_array($extension, $allowedExts)) {
  if ($_FILES["file"]["error"] > 0) {
    $_SESSION['err'] =E_INV_IMAGE. OR_HOME . E_SYS_ERR;
	  header ('location:'.$from_url.'');
	  exit();   
  } else {
	  $imagename = $_FILES["file"]["name"];
      move_uploaded_file($_FILES["file"]["tmp_name"],
      $path . $imagename);
	  	$id = "1";
	  	$stmt = $db->prepare('UPDATE general_settings set favicon_name=? where id=?');
		$stmt->bind_param('si', $imagename,$id);
		$stmt->execute();
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