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
if (!file_exists('inc/db/db.php')){
	include_once ('inc/install/prompt.php');
	exit;
	} 
	else 
	{
require_once 'inc/db/db.php';
require_once 'init.php';
include_once ISVIPI_USER_INC_BASE. 'users.func.php';
require_once 'inc/users.inc/mobile.php';
getAdminGenSett();
if ($mobileEnabled == "1"){
isMobile();
}
define('ISVIPI_THEMES_BASE', ISVIPI_ROOT . 'themes/'.$theme.'' . DIRECTORY_SEPARATOR);
define ('ISVIPI_THEME_URL', ISVIPI_URL. 'themes/'.$theme.''.DIRECTORY_SEPARATOR);
define('VERSION', '1.0.2');
include_once "lang/".$lang.".php";
if ($timeZ=="1"){
$zone = ini_get('date.timezone');	
} else { $zone = $time_zone;}
date_default_timezone_set ($zone);
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
else if ($ACTION[0] == $adminPath){
			if (!isset($ACTION[1])){$ACTION[1] = '/login';}
			require_once 'admincp/'.preg_replace('/[^\w]/','',$ACTION[1]).'.php';
		}
else if ($ACTION[0] == 'conf'){
			require_once ''.ISVIPI_ADMIN_INC_BASE.''.preg_replace('/[^\w]/','',$ACTION[1]).'.php';
		}	
else if ($ACTION[0] == 'feed'){
			require_once 'inc/feeds/'.preg_replace('/[^\w]/','',$ACTION[0]).'.php';
		}	
else if (is_file($includeFile)) {
		include($includeFile);
} 
else die404();
}

?>