<?php
session_start();
if (!file_exists('inc/db/db.php')){
echo '<div style="width:500px;margin-left:50px; margin-top:10px;background:#F0F0F0;padding:10px">';
echo 'Seems like your site is not yet set up. Click install to proceed... <br/>';
echo '<a href="_install/"><input type="button" style="padding:5px 15px" value="Install"></button></a>';
echo '</div>';	
exit;
}
else 
{
require_once 'inc/db/db.php';
date_default_timezone_set ($time_zone);
require_once 'init.php';
include_once ISVIPI_USER_INC_BASE. 'users.func.php';
getAdminGenSett();
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
$URL = str_replace(
	array( '\\', '../' ),
	array( '/',  '' ),
	$_SERVER['REQUEST_URI']
);

if ($offset = strpos($URL,'?')) {
	// strip getData
	$URL = substr($URL,0,$offset);
} else if ($offset = strpos($URL,'#')) {
		$URL = substr($URL,0,$offset);
}

if (URL_ROOT != '/') $URL=substr($URL,strlen(URL_ROOT));

$URL = trim($URL,'/');

// 404 if trying to call a real file
if (
	file_exists(DOC_ROOT.'/'.$URL) &&
	($_SERVER['SCRIPT_FILENAME'] != DOC_ROOT.$URL) &&
 	($URL != '') &&
 	($URL != 'index.php')
) die404();

$ACTION = (
	($URL == '') ||
	($URL == 'index.php') ||
	($URL == 'index.html')
) ? array('index') : explode('/',html_entity_decode($URL));
$includeFile = ''.ISVIPI_USER_BASE.''.preg_replace('/[^\w]/','',$ACTION[0]).'.php';

if ($ACTION[0] == 'cron'){
			include_once ''.ISVIPI_CRON_BASE.'/'.preg_replace('/[^\w]/','',$ACTION[0]).'.php';
		}
else if ($ACTION[0] == 'auth'){
			include_once 'auth/'.preg_replace('/[^\w]/','',$ACTION[1]).'.php';
		}
else if ($ACTION[0] == 'users'){
			require_once ''.ISVIPI_USER_INC_BASE.''.preg_replace('/[^\w]/','',$ACTION[1]).'.php';
		}
else if ($ACTION[0] == 'admin'){
			if (!isset($ACTION[1])){$ACTION[1] = 'login';}
			require_once 'admincp/'.preg_replace('/[^\w]/','',$ACTION[1]).'.php';
		}
else if ($ACTION[0] == 'conf'){
			require_once ''.ISVIPI_ADMIN_INC_BASE.''.preg_replace('/[^\w]/','',$ACTION[1]).'.php';
		}		
else if (is_file($includeFile)) {
		include($includeFile);
} 
else die404();
}

?>
</body>
</html>