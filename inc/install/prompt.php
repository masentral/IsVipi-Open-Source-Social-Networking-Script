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
 include_once 'init.php';
 include_once 'lang/en.php';
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php echo INSTALL_PROMPT ?></title>
<link href="<?php echo URL_ROOT.'inc/install/install-prompt.css'?>" rel="stylesheet" type="text/css" />
</head>
<body>
<div class="install_prompt_cont">
<h3><?php echo INSTALL_PROMPT_TXT ?></h3>
<center><a href="<?php echo URL_ROOT.'_install/'?>"><input type="button" class="myButton" value="<?php echo INSTALL ?>"></button></a></a>
</div>
</body>
</html>