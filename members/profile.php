<?php
session_start();
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
 require_once '../init.php';
 include_once ISVIPI_USER_INC_BASE. 'users.func.php';
 checkLogin();
 $user = $_SESSION['user_id'];
 getUserDetails($user);
 
//It will return fail if no correct action is defined from a POST command
$id = $_GET['id'];
if (!is_numeric($id)){
	$_SESSION['err'] ="Invalid ID";
}
	getMemberDet($id);
	
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Member's Profile</title>

<!--========HEADER=====---->
<?php include ISVIPI_THEMES_BASE.'/global/header.php';?>
<!--========/HEADER=====---->

<!--========BODY=====---->
<?php include_once ISVIPI_THEMES_BASE.'profile.php';?>
<!--========/BODY=====---->

<!--========FOOTER=====---->
<?php include_once ISVIPI_THEMES_BASE.'/global/footer.php';?>
<!--========/FOOTER=====---->
<?php globalAlerts();?>
</body>
</html>