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
	require_once 'init.php';
	require_once ISVIPI_ROOT.'inc/db/db.php';
	include_once ISVIPI_USER_INC_BASE. 'users.func.php';
	//update user status to offline
	global $db;
	$status = '1';
	$onlusr = $db->prepare('SELECT id,last_activity FROM members WHERE (online=? AND last_activity < NOW() - INTERVAL 10 MINUTE)');
	$onlusr->bind_param('i', $status);
	$onlusr->execute();
	$onlusr->store_result();
	$onlusr->bind_result($id,$last_activity);
		while ($onlusr->fetch()){
			$new_status = '0';
				$onlusr = $db->prepare('UPDATE members SET online=? WHERE id=?');
				$onlusr->bind_param('ii', $new_status,$id);
				$onlusr->execute();
			}
	$onlusr->close();
	//Delete old feeds
	$delfeeds = $db->prepare("DELETE FROM timeline where time < NOW() - INTERVAL 1 DAY");
	$delfeeds->execute();	
	$delfeeds->close();	
?>