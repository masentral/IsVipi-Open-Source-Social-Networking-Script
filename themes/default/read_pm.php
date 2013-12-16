                 <!--========HEADER=====---->
                    <?php include ISVIPI_THEMES_BASE.$theme.'/global/header.php';?>
                  <!--========/HEADER=====---->
        <?php
//We check if the user is logged
if(isset($_SESSION['user_id']))
{
//We check if the ID of the discussion is defined
if(isset($_GET['id']))
{
$id = intval($_GET['id']);
//We get the title and the narators of the discussion
$req1 = mysql_query('select title, user1, user2 from pm where id="'.$id.'" and id2="1"');
$dn1 = mysql_fetch_array($req1);

//We check if the discussion exists
if(mysql_num_rows($req1)==1)
{
//We check if the user have the right to read this discussion
if($dn1['user1']==$_SESSION['user_id'] or $dn1['user2']==$_SESSION['user_id'])
{
//The discussion will be placed in read messages
if($dn1['user1']==$_SESSION['user_id'])
{
	mysql_query('update pm set user1read="yes" where id="'.$id.'" and id2="1"');
	$user_partic = 2;
}
else
{
	mysql_query('update pm set user2read="yes" where id="'.$id.'" and id2="1"');
	$user_partic = 1;
}
//We get the list of the messages
$req2 = mysql_query('select * from pm, users where pm.id="'.$id.'" and users.id=pm.user1 order by pm.id2 DESC');
//We check if the form has been sent
if(isset($_POST['message']) and $_POST['message']!='')
{
	$message = $_POST['message'];
	//We remove slashes depending on the configuration
	if(get_magic_quotes_gpc())
	{
		$message = stripslashes($message);
	}
	//We protect the variables
	$message = mysql_real_escape_string(nl2br(htmlentities($message, ENT_QUOTES, 'UTF-8')));
	//We send the message and we change the status of the discussion to unread for the recipient
	if(mysql_query('insert into pm (id, id2, title, user1, user2, message, timestamp, user1read, user2read)values("'.$id.'", "'.(intval(mysql_num_rows($req2))+1).'", "", "'.$_SESSION['user_id'].'", "", "'.$message.'", "'.time().'", "", "")') and mysql_query('update pm set user'.$user_partic.'read="no" where id="'.$id.'" and id2="1"'))
	{
?>
<div class="message">Your message has successfully been sent. <br />
<a href="read_pm.php?id=<?php echo $id; ?>">Go to the discussion</a></div>
<?php
	}
	else
	{
		echo 'Error';
?>
<?php
	}
}
else
{
//We display the messages
?>
                  <!--========SIDEBAR MENU=====---->
                    <?php include ISVIPI_THEMES_BASE.$theme.'/global/sidebar_menu.php';?>
                  <!--========/SIDEBAR MENU=====---->
                  <!--========MESSAGES=====---->
                  <div class="col-md-6">
                  <div class="row">
                   <div class="panel panel-default tabless-panel timeline-layout overflow">
                     <div class="panel-heading">
                      <div class="text-muted isvipi-title">Conversation's Page</b>
                      </div><!--/text-muted-->
                    </div><!--/panel-heading-->
                  <div class="isvipi-panel-content isvipi-panel-content-width2">
                  
                 <table class="table">
                      <thead>
                          <tr>
                          <th width="100">From</th>
                          <th>Message</th>
                          </tr>
                      </thead>
<?php
while($dn2 = mysql_fetch_array($req2))
{
?>
	<tr>
    	<td class="author center"><?php echo $dn2['username']; ?>
<br /></td>
    	<td class="left"><div class="date"><span class="label label-info">Sent: <?php echo date('m/d/Y H:i:s' ,$dn2['timestamp']); ?></span></div>
    	<?php echo $dn2['message']; ?></td>
    </tr>

<?php
}
//We display the reply form
?>
</table>
<?php
}
}
else
{
	echo '<div class="message">You dont have the rights to access this page.</div>';
}
}
else
{
	echo '<div class="message">This discussion does not exists.</div>';
}
}
else
{
	echo '<div class="message">The discussion ID is not defined.</div>';
}
}
else
{
	echo '<div class="message">You must be logged to access this page.</div>';
}
?>


                              </div><!--end of isvipi-panel-content-->
                                <!-- Button trigger modal -->
              </div><!--End of isvipi-panel-content-->
              <form name="addphoto" method="post" action="read_message.php?id=<?php echo $id; ?>">
            <textarea name="message" class="form-control" id="inputField" tabindex="1"rows="2" cols="40" placeholder="Type your reply here..."></textarea>
            <br />
            <button type="submit" class="btn btn-primary" name="submit"/>Send Message</button>
            </form>
          </div><!--End of panel-->
                  <!--========/MESSAGES=====---->

         
                  <!--========ANNOUNCEMENTS=====---->
                    <?php include ISVIPI_THEMES_BASE.$theme.'/global/announcements.php';?> 
                  <!--========/ANNOUNCEMENTS=====---->
                  <!--========FOOTER=====---->
                    <?php include ISVIPI_THEMES_BASE.$theme.'/global/footer.php';?> 
                  <!--========/FOOTER=====---->
