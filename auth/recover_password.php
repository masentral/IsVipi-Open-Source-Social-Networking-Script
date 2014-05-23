<?php
if (isset($ACTION['2'])) {
$recovery_code = $ACTION['2'];
//Sanitize our recovery code
if (!preg_match('/^[a-zA-Z0-9_]{1,60}$/', $recovery_code))
	{
	$_SESSION['err'] =E_INVALID_CHARS_IN.RECOVERY_CODE;
    header ('location:'.ISVIPI_URL.'');
	exit();	
	}
// Check if the activation code exists in the database
$validateusr = $db->prepare("SELECT username FROM members WHERE a_code=?");
$validateusr->bind_param("s",$recovery_code);
$validateusr->execute();
$validateusr->store_result();
$validateusr->bind_result($usern_n);
$validateusr->fetch();
if ($validateusr->num_rows < 1){
	$_SESSION['err'] =E_INVALID_PASS_REC_CODE;
    header ('location:'.ISVIPI_URL.'');
	exit();	
	}
}?>
<?php
base_header($site_title,$ACTION[1]);
include_once ISVIPI_USER_BASE.'recover_password.php';
globalAlerts();
?>
 </body>
 </html>