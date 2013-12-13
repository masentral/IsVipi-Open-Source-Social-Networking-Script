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
include('../lib/functions/functions.php');

checkLogin('2');	

	// we check if everything is filled in and perform checks
	if($_POST['phone'] && !validateNumeric($_POST['phone']))
		{
			die(msg(0,"Phone numbers must be of numeric type only."));
		}
	if($_POST['email'] && validateEmail($_POST['email']))
		{
			die(msg(0,"Invalid Email!"));
		}
	if($_POST['email'] && uniqueEmail($_POST['email']))
		{
			die(msg(0,"Email already in database. Please select another email address."));
		}
		
		$res = editUser($_SESSION['user_id'],$_POST['email'],$_POST['first_name'],$_POST['last_name'],$_POST['dialing_code'],$_POST['phone'],$_POST['city'],$_POST['country']);
			
			if($res == 4){
				die(msg(0,"An internal error has occured. Please contact the site admin!"));
			}
			if($res == 99){
				die(msg(1,"Profile updated successfully!"));
			}

	function msg($status,$txt)
	{
		return '{"status":'.$status.',"txt":"'.$txt.'"}';
	}

?>
