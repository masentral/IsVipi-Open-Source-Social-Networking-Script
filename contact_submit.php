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
require_once('lib/connections/db.php');
include('lib/functions/functions.php');

$sitesettings = getSiteSettings();
$site_email = $sitesettings[0]['site_email'];

	// we check if everything is filled in and perform checks
	$find = "/(content-type|bcc:|cc:)/i";
	
	if(!$_POST['name'])
	{
		die(msg(0,"Names field empty!"));
	}
	
	elseif(preg_match($find, $_POST['name'])){
		die(msg(0,"Invalid name characters!"));
	}

	elseif(!$_POST['email'] || validateEmail($_POST['email']) || preg_match($find, $_POST['email']))
	{
		die(msg(0,"Invalid email!"));
	}

	elseif(!$_POST['message'])
	{
		die(msg(0,"Query/ Comment field empty!"));
	}
	
	elseif(preg_match($find, $_POST['message']) || strpos($_POST['message'], "&") !== false || strlen(strip_tags($_POST['message'])) < strlen($_POST['message']))
	{
		die(msg(0,"Invalid message characters!"));
	}

	else
		{
			$res = contactUs($_POST['name'],$_POST['email'],$_POST['message'],$site_email);
				if ($res == 1){
					die(msg(0,"A problem occured sending your question/comment. Please try again."));
				}
				if ($res == 99){
					die(msg(1,"<H3>Thank you for your inquiry/comment.</H3> We will reply to you as soon as possible."));
				}
		}

	function msg($status,$txt)
	{
		return '{"status":'.$status.',"txt":"'.$txt.'"}';
	}

?>
