<?php
/*******************************************************
 *   Copyright (C) 2014  http://isvipi.com

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation version 3 of the License.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License along
    with this program; if not, write to the Free Software Foundation, Inc.,
    51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
 ******************************************************/ 
 isLoggedIn();
 if (isset($_SESSION['user_id'])){
 $user = $_SESSION['user_id'];
 getUserDetails($user);
 pollUser($user);
 }
 base_header($site_title,$ACTION[0]);
 include_once ISVIPI_THEMES_BASE.'friends.php';
 globalAlerts();?>
</body>
</html>