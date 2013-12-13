                  
                  <!--========HEADER=====---->
                    <?php include ISVIPI_THEMES_BASE.$theme.'/global/header.php';?>
                  <!--========/HEADER=====---->
        
                  <!--========SIDEBAR MENU=====---->
                    <?php include ISVIPI_THEMES_BASE.$theme.'/global/sidebar_menu.php';?>
                  <!--========/SIDEBAR MENU=====---->
                  
                  <!--========MY PROFILE=====---->
                  <div class="col-md-6">
                  <div class="row">
                   <div class="panel panel-default tabless-panel timeline-layout">
                     <div class="panel-heading">
                      <div class="text-muted isvipi-title">My Profile
                       <a href="" title="Edit Profile"><div class="profile_options"><i class="fa fa-cogs"></i> </div></a>
                       <div class="user_minor_details">Date of Reg: <b><?=$getuser[0]['reg_date'];?></b></div>
                      </div>
                    </div>
                    <div class="isvipi-panel-content tabless-panel-content collapse in">
                  <div class="profile_image"><img src="<?=$getuser[0]['thumb_path'];?>" height="100%" width="100%" alt="" /></div>
                  <div class="profile_info">
                  <div class="isvipi-panel-content">
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <td><b>Username</b></td>
                                                <td><b>:</b></td>
                                                <td><?=$getuser[0]['username'];?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Email</b></td>
                                                <td><b>:</b></td>
                                                <td><?=$getuser[0]['email'];?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Phone No.</b></td>
                                                <td><b>:</b></td>
                                                <td>+<?=$getuser[0]['dialing_code'];?>-<?=$getuser[0]['phone'];?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Location</b></td>
                                                <td><b>:</b></td>
                                                <td><?=$getuser[0]['city'];?>, <?=$getuser[0]['country'];?></td>
                                            </tr>
                                            <tr>
                                                <td><b>User Type</b></td>
                                                <td><b>:</b></td>
                                                <td>Member</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div><!--end of isvipi-panel-content-->
                                <div class="profile_options_bar">
                                 <div class="upload_pic"><button class="btn btn-primary" data-toggle="modal" data-target="#picUpload">Upload Profile Pic</button></div>
                                <a href="#" title="Send a Message" data-toggle="modal" data-target="#composeMessage"><i class="fa fa-envelope-o"></i></a><a href="" title="Send Friend Request"><i class="fa fa-user"></i></a><a href="" title="Report this person"><i class="fa fa-exclamation-triangle"></i></a>
                                </div>
                                <!-- Button trigger modal -->
          
                             </div><!--end of profile_info-->
              </div><!--End of isvipi-panel-content-->
          </div><!--End of panel-->

          <!----------------------------------------------------------------
          --------------------UPLOAD PROFILE PIC MODAL----------------------------
          ------------------------------------------------------------------>

          <?php
//We check if the user is logged
if(isset($_SESSION['user_id']))
{
$form = true;
$otitle = '';
$orecip = '';
$omessage = '';
//We check if the form has been sent
if(isset($_POST['title'], $_POST['recip'], $_POST['message']))
{
	$otitle = $_POST['title'];
	$orecip = $_POST['recip'];
	$omessage = $_POST['message'];
	//We remove slashes depending on the configuration
	if(get_magic_quotes_gpc())
	{
		$otitle = stripslashes($otitle);
		$orecip = stripslashes($orecip);
		$omessage = stripslashes($omessage);
	}
	//We check if all the fields are filled
	if($_POST['title']!='' and $_POST['recip']!='' and $_POST['message']!='')
	{
		//We protect the variables
		$title = mysql_real_escape_string($otitle);
		$recip = mysql_real_escape_string($orecip);
		$message = mysql_real_escape_string(nl2br(htmlentities($omessage, ENT_QUOTES, 'UTF-8')));
		//We check if the recipient exists
		$dn1 = mysql_fetch_array(mysql_query('select count(id) as recip, id as recipid, (select count(*) from pm) as npm from users where username="'.$recip.'"'));
		if($dn1['recip']==1)
		{
			//We check if the recipient is not the actual user
			if($dn1['recipid']!=$_SESSION['user_id'])
			{
				$id = $dn1['npm']+1;
				//We send the message
				if(mysql_query('insert into pm (id, id2, title, user1, user2, message, timestamp, user1read, user2read)values("'.$id.'", "1", "'.$title.'", "'.$_SESSION['user_id'].'", "'.$dn1['recipid'].'", "'.$message.'", "'.time().'", "yes", "no")'))
				{
?>
<div class="message">The message has successfully been sent.<br />
<a href="list_pm.php">List of my personnal messages</a></div>
<?php
					$form = false;
				}
				else
				{
					//Otherwise, we say that an error occured
					$error = 'An error occurred while sending the message';
				}
			}
			else
			{
				//Otherwise, we say the user cannot send a message to himself
				$error = 'You cannot send a message to yourself.';
			}
		}
		else
		{
			//Otherwise, we say the recipient does not exists
			$error = 'The recipient does not exists.';
		}
	}
	else
	{
		//Otherwise, we say a field is empty
		$error = 'A field is empty. Please fill of the fields.';
	}
}
elseif(isset($_GET['recip']))
{
	//We get the username for the recipient if available
	$orecip = $_GET['recip'];
}
if($form)
{
//We display a message if necessary
if(isset($error))
{
	echo '<div class="message">'.$error.'</div>';
}
//We display the form
?>
          <!-- Modal -->
          <div class="modal fade" id="picUpload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
           <div class="modal-dialog">
            <div class="modal-content">
             <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title" id="myModalLabel">Upload Profile Picture</h4>
            </div>
            <div class="modal-body">
            <div class="form-group">
            <form name="addphoto" method="post" enctype="multipart/form-data" action="process_photo.php">
             <input type="hidden" name="addphoto" value="1" />
             <input type="hidden" name="id" value="<?= $getuser[0]['id'];?>" />
              <label class="col-lg-4 control-label" for="fileInput">File input</label>
                <div class="col-lg-10">
               <input class="form-control uniform_on" id="fileInput" type="file" name="picture" size="30">
               <input type="hidden" name="max" value="300000" />
                </div>
             </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="submit"/>Upload</button>
            </form>
            </div>
          </div><!-- /.modal-content -->
       </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
    
              <!-- Modal -->
          <div class="modal fade" id="composeMessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
           <div class="modal-dialog">
            <div class="modal-content">
             <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title" id="myModalLabel">Compose Message</h4>
            </div>
            <div class="modal-body">
            <div class="form-group">
            <form name="addphoto" method="post" action="new_pm.php">
            <label for="title">To</label>
            <input type="text" class="form-control" value="<?= $getuser[0]['username'];?>" name="recip">
            <label for="title">Subject</label>
            <input type="text" class="form-control" value="<?php echo htmlentities($otitle, ENT_QUOTES, 'UTF-8'); ?>" name="title">
            <label for="title">Message</label>
            <textarea name="message" class="form-control" id="inputField" tabindex="1"rows="2" cols="40"><?php echo htmlentities($omessage, ENT_QUOTES, 'UTF-8'); ?></textarea>
             </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="submit"/>Send Message</button>
            </form>
            </div>
          </div><!-- /.modal-content -->
       </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

        <?php
}
}
else
{
	echo '<div class="message">You must be logged ito access this page.</div>';
}
?> 
              <!--========/MY PROFILE=====---->
                        
                  <!--========ANNOUNCEMENTS=====---->
                    <?php include ISVIPI_THEMES_BASE.$theme.'/global/announcements.php';?> 
                  <!--========/ANNOUNCEMENTS=====---->
                  <!--========FOOTER=====---->
                    <?php include ISVIPI_THEMES_BASE.$theme.'/global/footer.php';?> 
                  <!--========/FOOTER=====---->
