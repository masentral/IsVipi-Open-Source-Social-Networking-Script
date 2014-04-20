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
$annC = $ACTION[2];
} else {
$annC = $_POST['ann'];
}
if ($annC !== 'edit' && $annC !== 'del'){
	$_SESSION['err'] ="Unknown request";
    header ('location:'.$from_url.'');
	exit();
} 
/////////////////////////////////////////////////////////////
//////////////// EDIT ANNOUNCEMENT /////////////////////////
////////////////////////////////////////////////////////////
	if ($annC == 'edit') {
		$annID = get_post_var('annID');
		$annID = preg_replace('/[^0-9]/','',$annID);
		$title = get_post_var('a_subject');
		$content = get_post_var('a_content');	
		if (empty($title)) {
			echo
			$_SESSION['err'] ="The subject field cannot be empty";
			header ('location:'.$from_url.'');
			exit();
		  }
		if (empty($content)) {
			echo
			$_SESSION['err'] ="The content field cannot be empty";
			header ('location:'.$from_url.'');
			exit();
		  }
		  
		  $stmt = $db->prepare('UPDATE announcements SET date=NOW(),subject=?,content=? WHERE id=?');
			$stmt->bind_param('ssi', $title,$content,$annID);
			$stmt->execute();
			$stmt->close();
			$_SESSION['succ'] ="Announcements Updated!";
			header ('location:'.$from_url.'');
			exit();	


}

/////////////////////////////////////////////////////////////
//////////////// DELETE ANNOUNCEMENT ///////////////////////
////////////////////////////////////////////////////////////
if ($annC == 'del') {
	$delAnn = $ACTION[3];
	$delAnn = decrypt_str($delAnn);
	$delAnn = preg_replace('/[^0-9]/','',$delAnn);
		$stmt = $db->prepare('DELETE from announcements WHERE id=?');
		$stmt->bind_param('i', $delAnn);
		$stmt->execute();
		$stmt->close();
			$_SESSION['succ'] ="Announcement deleted!";
			header ('location:'.$from_url.'');
			exit();


}

$db->close();
?>