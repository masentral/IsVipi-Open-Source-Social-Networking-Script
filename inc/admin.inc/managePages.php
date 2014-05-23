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
$page = $ACTION[2];	
} else{
$page = $_POST['page'];
}
if ($page !== 'terms' && $page !=='pPolicy' && $page !=='new_page' && $page !=='del' && $page !=='Edit_Page'){
	$_SESSION['err'] =UNKNOWN_REQ;
    header ('location:'.$from_url.'');
	exit();
} 
/////////////////////////////////////////////////////////////
//////////////// TERMS & CONDITIONS ////////////////////////
////////////////////////////////////////////////////////////
if ($page == 'terms') {
		$slug = get_post_var('p_slug');
		$title = get_post_var('title');
		$content = get_post_var('termsCont');	
		if (empty($title)) {
			echo
			$_SESSION['err'] =TITLE.E_IS_EMPTY;
			header ('location:'.$from_url.'');
			exit();
		  }
		if (empty($content)) {
			echo
			$_SESSION['err'] =CONTENT.E_IS_EMPTY;
			header ('location:'.$from_url.'');
			exit();
		  }
	global $db;
	$termsUpd = $db->prepare('UPDATE pages set title=?, content=? where p_slug=?');
	$termsUpd->bind_param("sss",$title,$content,$slug);
	$termsUpd->execute();
	$termsUpd->close();
	$_SESSION['succ'] =S_SUCCESS;
			header ('location:'.$from_url.'');
			exit();
}

/////////////////////////////////////////////////////////////
//////////////// PRIVACY POLICY ////////////////////////////
////////////////////////////////////////////////////////////
if ($page == 'pPolicy') {
		$slug = get_post_var('p_slug');
		$title = get_post_var('pTitle');
		$content = get_post_var('pContent');	
		if (empty($title)) {
			echo
			$_SESSION['err'] =TITLE.E_IS_EMPTY;
			header ('location:'.$from_url.'');
			exit();
		  }
		if (empty($content)) {
			echo
			$_SESSION['err'] =CONTENT.E_IS_EMPTY;
			header ('location:'.$from_url.'');
			exit();
		  }
	global $db;
	$termsUpd = $db->prepare('UPDATE pages set title=?, content=? where p_slug=?');
	$termsUpd->bind_param("sss",$title,$content,$slug);
	$termsUpd->execute();
	$termsUpd->close();
	$_SESSION['succ'] =S_SUCCESS;
			header ('location:'.$from_url.'');
			exit();
}

/////////////////////////////////////////////////////////////
//////////////// ADD NEW PAGE //////////////////////////////
////////////////////////////////////////////////////////////
if ($page == 'new_page') {
		$title = get_post_var('p_title');
		$slug = strtolower(trim($title));
		$slug = str_replace(" ", "_", $slug);
		$slug = substr($slug,0,10);
		$content = get_post_var('p_content');	
		if (empty($title)) {
			$_SESSION['err'] =TITLE.E_IS_EMPTY;
			header ('location:'.$from_url.'');
			exit();
		  }
		if (empty($content)) {
			$_SESSION['err'] =CONTENT.E_IS_EMPTY;
			header ('location:'.$from_url.'');
			exit();
		  }
		 	$newpage = $db->prepare('INSERT INTO pages (p_slug,date,title,content) VALUES (?,NOW(),?,?)');
			$newpage->bind_param("sss",$slug,$title,$content);
			$newpage->execute();
			$newpage->close();
				$_SESSION['succ'] =S_SUCCESS;
				header ('location:'.$from_url.'');
				exit();
 
}
/////////////////////////////////////////////////////////////
//////////////// DELETE PAGE ///////////////////////////////
////////////////////////////////////////////////////////////
if ($page == 'del') {
	$del_page = $ACTION[3];
	$del_page = decrypt_str($del_page);
	$del_page = preg_replace('/[^0-9]/','',$del_page);
		$stmt = $db->prepare('DELETE from pages WHERE id=?');
		$stmt->bind_param('i', $del_page);
		$stmt->execute();
		$stmt->close();
			$_SESSION['succ'] =S_SUCCESS;
			header ('location:'.$from_url.'');
			exit();

}
/////////////////////////////////////////////////////////////
//////////////// EDIT PAGES ////////////////////////////////
////////////////////////////////////////////////////////////
if ($page == 'Edit_Page') {
		$pid = get_post_var('p_id');
		$pid = preg_replace('/[^0-9]/','',$pid);
		$title = get_post_var('p_title');
		$slug = strtolower(trim($title));
		$slug = str_replace(" ", "_", $slug);
		$slug = substr($slug,0,10);
		$content = get_post_var('p_content');	
		if (empty($title)) {
			echo
			$_SESSION['err'] =TITLE.E_IS_EMPTY;
			header ('location:'.$from_url.'');
			exit();
		  }
		if (empty($content)) {
			echo
			$_SESSION['err'] =CONTENT.E_IS_EMPTY;
			header ('location:'.$from_url.'');
			exit();
		  }
		  
		  $stmt = $db->prepare('UPDATE pages SET p_slug=?,date=NOW(),title=?,content=? WHERE id=?');
			$stmt->bind_param('sssi', $slug,$title,$content,$pid);
			$stmt->execute();
			$stmt->close();
			$_SESSION['succ'] =S_SUCCESS;
			header ('location:'.$from_url.'');
			exit();	
}
?>