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
	$from_url = $_SERVER['HTTP_REFERER'];
	$searchType = get_post_var('type');
	$searchTerm = get_post_var('searchTerm');
	if (empty($searchTerm)) {
		$_SESSION['err'] =PROVIDE_SEARCH_TERM;
		header ('location:'.$from_url.'');
		exit();
		}
	$searchTerm = trim($searchTerm);
	$searchTerm = strip_tags($searchTerm);
	$searchTerm = str_replace('%', '', $searchTerm);
	header ('location:'.ISVIPI_URL.$adminPath.'/search/'.$searchType.'/'.$searchTerm)
?>