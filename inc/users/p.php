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
 $pageTitle = $ACTION[1];
 $titleFull = str_replace("_", " ", $pageTitle);
 $parts = explode("-", $titleFull);
 $titleSplit = $parts[0];
 $PID = $parts[1];
 $PID = preg_replace('/[^0-9]/','',$PID);
 readPage($titleSplit,$PID);
 if ($sCount =="0"){
	$_SESSION['err'] =E404_NOT_FOUND;
    header ('location:'.$from_url.'');
	exit();	 
 }
 include_once ISVIPI_THEMES_BASE.'page.php'; 
 globalAlerts();?>
</body>
</html>