<?php
/*******************************************************
 *   Copyright (C) 2013  http://isvipi.com

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
 ?>
<?php
DEFINE('INCLUDE_CHECK',1);
require_once('../lib/connections/db.php');
include('../lib/functions/admin_functions.php');

checkLogin('1');

$id=0;
if(isset($_GET['id'])){
	if(is_numeric($_GET['id'])){
		$id = strip_tags($_GET['id']);
		$id = secureInput($_GET['id']);
		}
	}

$action="";
if(isset($_GET['action'])){
	$action = strip_tags($_GET['action']);
	$action = secureInput($_GET['action']);
	}
	
	if($action == "suspend"){
		$res = suspendUser($id);
				
			if($res == 1){
				header("Location: manage_users.php?error=An error occured while attempting to suspend user. Please try again.");
			}
			if($res == 2){
				header("Location: manage_users.php?error=An error occured selecting user to suspend.");
			}
			if($res == 99){
				header("Location: manage_users.php?message=User suspended.");
			}
	}
	
	if($action == "unsuspend"){
		$res = unsuspendUser($id);
				
			if($res == 1){
				header("Location: manage_users.php?error=An error occured while attempting to unsuspend user. Please try again.");
			}
			if($res == 2){
				header("Location: manage_users.php?error=An error occured selecting user to unsuspend.");
			}
			if($res == 99){
				header("Location: manage_users.php?message=User unsuspended.");
			}
	}
	
	if($action == "delete"){
		$res = deleteUser($id);
				
			if($res == 1){
				header("Location: manage_users.php?error=An error occured while attempting to delete user. Please try again.");
			}
			if($res == 2){
				header("Location: manage_users.php?error=An error occured selecting user to delete.");
			}
			if($res == 99){
				header("Location: manage_users.php?message=User deleted.");
			}
	}

?>
