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
$search = $_POST['search'];
$search = trim($search);
$search = strip_tags($search);
$searchTerm = $_POST['searchTerm'];
$searchTerm = trim($searchTerm);
$searchTerm = strip_tags($searchTerm);
if ($search !== 'search'){
	$_SESSION['err'] ="Unknown request";
    header ('location:'.$from_url.'');
	exit();
} 
if (empty($searchTerm)) {
    $_SESSION['err'] ="Please provide a search term";
    header ('location:'.$from_url.'');
	exit();
}
$x=0;
$searchTerm = explode (" ", $searchTerm);
foreach($searchTerm as $search)
		{
			$x++;
			if($x == 1)
			{
				@$sql .= "(username LIKE '%$search%')";
				@$sql2 .= "(d_name LIKE '%$search%')";
			}
			else
			{
				@$sql .= " OR (username LIKE '%$search%')";
				@$sql2 .= " OR (d_name LIKE '%$search%')";
			}
		}
$sql = "SELECT id FROM members WHERE $sql";
$sql2 = "SELECT user_id FROM member_sett WHERE $sql2";
$search = $db->prepare($sql);
$search->execute();
$search->store_result();
$results = $search->num_rows;
if ($results=="0"){
$search2 = $db->prepare($sql2);
$search2->execute();
$search2->store_result();
$results2 = $search2->num_rows;
if ($results2=="0"){
$_SESSION['err'] ="No such user found";
header ('location:'.$from_url.'');
exit();	
} else{
$_SESSION['succ'] ="User found in members";
header ('location:'.$from_url.'');	
}
}else{
$_SESSION['succ'] ="User found in members";
header ('location:'.$from_url.'');
exit();	
}