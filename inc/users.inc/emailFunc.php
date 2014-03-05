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
function sendActEmail($site_url,$site_email,$user,$site_title,$randomstring,$email){
$to = $email;
$subject = "Account Activation";
$message = "<html>
<head>
<title>Activate your account at ".$site_title."</title>
</head>
<body>
<table style='width:700px;' align='center' bgcolor='#CCCCCC' cellpadding='2'>
<th bgcolor='#FFFFFF' height='50px'><h1> ".$site_title." - Account Activation</h1></th>
<tr>
<td><p>Dear ".$user.",</p></td>
</tr>
<tr>
<td><p>Your account at ".$site_title." has been created. You will however need to validate your email before you can log in. To validate your email, please click the link below.</p>
                      <p> Link: ".$site_url."/auth/activate/".$randomstring."</p>
                      <p> If for some reason you cannot click on the link above, copy and paste it in your browser.</p></td>
</tr>
<tr bgcolor='#FFFFFF'>
      <td>Best Regards,<br />
      ".$site_title." Team.<br />
	  ".$site_url."
	  </td>
    </tr>
</table>
</body>
</html>";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

$headers .= 'From: '.$site_email.'' . "\r\n";
mail($to,$subject,$message,$headers);	
	
}

function sendRecEmail($recov_email,$randomstring,$site_title,$site_email,$username,$site_url){
	
$to = $recov_email;
$subject = "Recover Password";
$message = "
<html>
<head>
<title>Change Password Request at ".$site_title."</title>
</head>
<body>
<table style='width:700px;' align='center' bgcolor='#CCCCCC' cellpadding='2'>
<th bgcolor='#FFFFFF' height='20px'><h1> ".$site_title." - Reset Password</h1></th>
<tr>
<td><p>Dear ".$username.",</p></td>
</tr>
<tr>
<td><p>You recently requested to change your password at ".$site_title." </p>
    <p> Your password reset link is ".$site_url."/auth/recover_password/".$randomstring."</p>
    <p> -------------------------------</p>
    <p> If you however did not make this request please ignore this email</p>
    </td>
</tr>
<tr bgcolor='#FFFFFF'>
      <td>Best Regards,<br />
      ".$site_title." Team.<br />
	  ".$site_url."
	  </td>
    </tr>
</table>
</html>
";
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

$headers .= 'From: '.$site_email.'' . "\r\n";
mail($to,$subject,$message,$headers);	
}
?>