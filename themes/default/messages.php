                  <?php
//We check if the user is logged
if(isset($_SESSION['user_id']))
{
//We list his messages in a table
//Two queries are executes, one for the unread messages and another for read messages
$req1 = mysql_query('select m1.id, m1.title, m1.timestamp, count(m2.id) as reps, users.id as user_id, users.username from pm as m1, pm as m2,users where ((m1.user1="'.$_SESSION['user_id'].'" and m1.user1read="no" and users.id=m1.user2) or (m1.user2="'.$_SESSION['user_id'].'" and m1.user2read="no" and users.id=m1.user1)) and m1.id2="1" and m2.id=m1.id group by m1.id order by m1.id desc');
$req2 = mysql_query('select m1.id, m1.title, m1.timestamp, count(m2.id) as reps, users.id as user_id, users.username from pm as m1, pm as m2,users where ((m1.user1="'.$_SESSION['user_id'].'" and m1.user1read="yes" and users.id=m1.user2) or (m1.user2="'.$_SESSION['user_id'].'" and m1.user2read="yes" and users.id=m1.user1)) and m1.id2="1" and m2.id=m1.id group by m1.id order by m1.id desc');
?>
                 <!--========HEADER=====---->
                    <?php include ISVIPI_THEMES_BASE.$theme.'/global/header.php';?>
                  <!--========/HEADER=====---->
        
                  <!--========SIDEBAR MENU=====---->
                    <?php include ISVIPI_THEMES_BASE.$theme.'/global/sidebar_menu.php';?>
                  <!--========/SIDEBAR MENU=====---->
                  
                  <!--========MESSAGES=====---->
                  <div class="col-md-6">
                  <div class="row">
                   <div class="panel panel-default tabless-panel timeline-layout">
                     <div class="panel-heading">
                      <div class="text-muted isvipi-title">Messages
                       <a href="#" title="Compose Mail" data-toggle="modal" data-target="#composeMessage"><div class="profile_options"><i class="fa fa-envelope-o"></i></div></a>
                      </div><!--/text-muted-->
                    </div><!--/panel-heading-->
                  <div class="isvipi-panel-content isvipi-panel-content-width">
                       <table class="table">
                                    <thead>
                                        <tr>
                                            <th width="150">Date</th>
                                            <th>From</th>
                                            <th>Subject</th>
                                            <th width="120">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
<?php
//We display the list of unread messages
while($dn1 = mysql_fetch_array($req1))
{
?>
                                    
                                        <tr class="success">
                                            <td><?php echo date('Y/m/d H:i:s' ,$dn1['timestamp']); ?></td>
                                            <td><?php echo htmlentities($dn1['username'], ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td><a href="read_pm.php?id=<?php echo $dn1['id']; ?>"><?php echo htmlentities($dn1['title'], ENT_QUOTES, 'UTF-8'); ?></a></td>
                                            <td><div class="message_options_bar">
                                <a href="#" title="Reply" data-toggle="modal" data-target="#replyMessage"><i class="fa fa-reply"></i></a><a href="profile.php?id=<?php echo $dn1['userid']; ?>" title="View Profile"><i class="fa fa-user"></i></a><a href="" title="Delete"><i class="fa fa-times"></i></a>
                                </div></td>
                                        </tr>
                                        <?php
}
//If there is no unread message we notice it
if(intval(mysql_num_rows($req1))==0)
{
?><tr>
    	<td colspan="4" class="center">You have no unread message.</td>
    </tr>
<?php
}
?>
<?php
}
else
{
	echo 'You must be logged to access this page.';
}
?>   
<?php
//We display the list of read messages
while($dn2 = mysql_fetch_array($req2))
{
?>
                                        <tr class="active">
                                            <td><?php echo date('Y/m/d H:i:s' ,$dn2['timestamp']); ?></td>
                                            <td><?php echo htmlentities($dn2['username'], ENT_QUOTES, 'UTF-8'); ?></td>
                                            <td><a href="read_pm.php?id=<?php echo $dn2['id']; ?>"><?php echo htmlentities($dn2['title'], ENT_QUOTES, 'UTF-8'); ?></a></td>
                                            <td><div class="message_options_bar">
                                <a href="" title="Reply"><i class="fa fa-reply"></i></a><a href="profile.php?id=<?php echo $dn2['userid']; ?>" title="View Profile"><i class="fa fa-user"></i></a><a href="" title="Delete"><i class="fa fa-times"></i></a>
                                </div></td>
                                        </tr>
                                    </tbody>
                                    <?php
}
//If there is no read message we notice it
if(intval(mysql_num_rows($req2))==0)
{
?>
	<tr>
    	<td colspan="4" class="center">You have no read message.</td>
    </tr>
<?php
}
?>
                                </table> 
                              </div><!--end of isvipi-panel-content-->
                                <!-- Button trigger modal -->
              </div><!--End of isvipi-panel-content-->
          </div><!--End of panel-->

          <!----------------------------------------------------------------
          --------------------COMPOSE MESSAGE MODAL----------------------------
          ------------------------------------------------------------------>
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
            <input type="text" class="form-control" value="<?php echo htmlentities($orecip, ENT_QUOTES, 'UTF-8'); ?>" name="recip">
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
              <!-- Modal -->
          <div class="modal fade" id="replyMessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
           <div class="modal-dialog">
            <div class="modal-content">
             <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title" id="myModalLabel">Reply to Message by <?php echo htmlentities($otitle, ENT_QUOTES, 'UTF-8'); ?></h4>
            </div>
            <div class="modal-body">
            <div class="form-group">
            <form name="addphoto" method="post" action="new_pm.php">
            <label for="title">To</label>
            <input type="text" class="form-control" value="<?php echo htmlentities($dn2['username'], ENT_QUOTES, 'UTF-8'); ?>" name="recip">
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

                  <!--========/MESSAGES=====---->

         
                  <!--========ANNOUNCEMENTS=====---->
                    <?php include ISVIPI_THEMES_BASE.$theme.'/global/announcements.php';?> 
                  <!--========/ANNOUNCEMENTS=====---->
                  <!--========FOOTER=====---->
                    <?php include ISVIPI_THEMES_BASE.$theme.'/global/footer.php';?> 
                  <!--========/FOOTER=====---->
