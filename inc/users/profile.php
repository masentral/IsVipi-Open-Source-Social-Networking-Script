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
 isLoggedIn();
 if (isset($_SESSION['user_id'])){
 $user = $_SESSION['user_id'];
 getUserDetails($user);
 pollUser($user);
 }
//It will return fail if no correct action is defined from a POST command
if (isset($ACTION[1])){
$xid = $ACTION[1];
xtractUID($xid);
$id = $uid;
if (!is_numeric($id)){
	$_SESSION['err'] =INVALID_ID;
}
	getMemberDet($id);
}
	base_header($site_title,$ACTION[0]);
 include_once ISVIPI_THEMES_BASE.'profile.php';
 globalAlerts();?>
</body>
</html>