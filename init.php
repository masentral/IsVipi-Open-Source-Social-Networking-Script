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
////////////////////////////////////////////////////////
/////////////BASIC SITE CONFIGURATIONS//////////////////
////////////////////////////////////////////////////////
require 'lib/db/db.php';
//get important config settings from the database
$getconf = $db->prepare("SELECT site_url,site_title,site_email,theme,time_zone FROM site_settings");
$getconf->execute();
$getconf->store_result();
$getconf->bind_result($site_url,$site_title,$site_email,$theme,$time_zone);
$getconf->fetch();
$getconf->close( );

// directory paths
define('ISVIPI_ROOT', dirname(__FILE__));
define('ISVIPI_THEMES_BASE', ISVIPI_ROOT . '/themes/'.$theme.'' . DIRECTORY_SEPARATOR);
define('ISVIPI_MEMBER_BASE', ISVIPI_ROOT . '/members' . DIRECTORY_SEPARATOR);
define('ISVIPI_DB_BASE', ISVIPI_ROOT . '/lib/db' . DIRECTORY_SEPARATOR);
define('ISVIPI_USER_INC_BASE', ISVIPI_ROOT . '/lib/users.inc' . DIRECTORY_SEPARATOR);
define ('ISVIPI_URL', $site_url);
define ('ISVIPI_MEMBER_URL', ISVIPI_URL . '/members' .DIRECTORY_SEPARATOR);
define ('ISVIPI_THEME_URL', ISVIPI_URL. '/themes/'.$theme.''.DIRECTORY_SEPARATOR);
define ('ISVIPI_DB_URL', ISVIPI_URL . '/lib/db' .DIRECTORY_SEPARATOR);
define('ISVIPI_USER_INC_URL', ISVIPI_URL . '/lib/users.inc' . DIRECTORY_SEPARATOR);

date_default_timezone_set ($time_zone);

//Check if site is installed correctly
//check if the site is installed else redirect to install page
?>

