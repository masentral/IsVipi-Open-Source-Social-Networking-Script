<?php
define('INCLUDE_CHECK',1);
include('../functions/timeline_functions.php');
require_once('../db/db.php');

if(ini_get('magic_quotes_gpc'))
$_POST['inputField']=stripslashes($_POST['inputField']);
//$_POST['inputField'] = mysql_real_escape_string(strip_tags($_POST['inputField']),$link);

if(mb_strlen($_POST['inputField']) < 1 || mb_strlen($_POST['inputField'])>140)
die("0");

mysql_query("INSERT INTO timeline SET tweet='".$_POST['inputField']."',dt=NOW(),username='".$_POST['user_username']."'");

//if(mysql_affected_rows($link)!=1)
//die("0");

echo formatTweet($_POST['inputField'],time());

?>
