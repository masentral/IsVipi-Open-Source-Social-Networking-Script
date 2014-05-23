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
 base_header($site_title,$ACTION[1]);
 if (isset($_SERVER['HTTP_REFERER'])){
$from_url = $_SERVER['HTTP_REFERER'];	 
 } else {
$from_url = ISVIPI_URL.'404';	 
 }
 if (!$ACTION[1]){
	 die404();
	 exit();
 }
$statusID = decryptHardened($ACTION['1']);
$statusID = preg_replace('/[^0-9]/','',$statusID);
$user = $_SESSION['user_id'];
getUserDetails($user);
 include_once ISVIPI_THEMES_BASE.'status.php'; 
 globalAlerts();?>
</body>
</html>