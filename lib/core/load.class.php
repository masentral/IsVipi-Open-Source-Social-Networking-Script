<?php
//check if the site is installed else redirect to install page
function check_install(){
$filename = 'lib/db/db.php';
if (!file_exists($filename)) {
    header('location:install/');} 	
}

//include core files
function require_home_files(){
require_once('lib/db/db.php');
require_once('init.php');
}
function include_core_files(){
require_once('../lib/db/db.php');
require_once('../init.php');
require_once('../lib/functions/functions.php');
}
?>
