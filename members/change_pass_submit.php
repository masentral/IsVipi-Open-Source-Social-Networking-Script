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

		if (empty($_POST['oldpassword']) || empty($_POST['newpassword'])) 
		{
			die(msg(0,"Old / New password fields empty!"));
		}
		
		if(strlen($_POST['newpassword'])<5)
		{
			die(msg(0,"Password must contain more than 5 characters."));
		}
				
		$res = updatePass($_SESSION['user_id'], $_POST['oldpassword'], $_POST['newpassword']);
				
			if($res == 2){
				die(msg(0,"Incorrect old password!"));
			}
			if($res == 3){
				die(msg(0,"An error occured saving your password. Please contact the site admin."));
			}
			if($res == 99){
				die(msg(1,"Your new password has been saved."));
			}

	function msg($status,$txt)
	{
		return '{"status":'.$status.',"txt":"'.$txt.'"}';
	}

?>
