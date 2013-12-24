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

////////////////////////////////////////////////////////
/////////////BASIC SITE CONFIGURATIONS//////////////////
////////////////////////////////////////////////////////

//get important config settings from the database
$select = "SELECT site_url FROM site_settings";
$query = mysql_query($select) or die(mysql_error());
$result = mysql_result($query, 0);
$site_url = $result;
$site_url = 'http://'.$site_url;

// theme config
$select = "SELECT theme FROM site_settings";
$query = mysql_query($select) or die(mysql_error());
$result = mysql_result($query, 0);
$theme = $result;

// directory paths
define('ISVIPI_ROOT', dirname(__FILE__));
define('ISVIPI_THEMES_BASE', ISVIPI_ROOT . '/themes/'.$theme.'' . DIRECTORY_SEPARATOR);
define ('ISVIPI_URL', $site_url);
define ('ISVIPI_MEMBER_URL', ISVIPI_URL . '/members' .DIRECTORY_SEPARATOR);
define ('ISVIPI_THEME_URL', ISVIPI_URL. '/themes/'.$theme.''.DIRECTORY_SEPARATOR);
define ('ISVIPI_CORE_URL', ISVIPI_URL . '/lib/core' .DIRECTORY_SEPARATOR);

?>

