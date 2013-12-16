                  <?php
//We check if the user is logged
if(isset($_SESSION['user_id']))
{
$me = $_SESSION['user_id'];
//We list notifications in a table
$query1 = mysql_query('SELECT * FROM friend_requests WHERE to_id = "'.$me.'" AND status="pending"');
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
                   <div class="panel panel-default tabless-panel timeline-layout overflow">
                     <div class="panel-heading">
                      <div class="text-muted isvipi-title">Messages
                       <a href="#" title="PM a Friend" data-toggle="modal" data-target="#composeMessage"><div class="profile_options"><i class="fa fa-envelope-o"></i></div></a>
                      </div><!--/text-muted-->
                    </div><!--/panel-heading-->
                  <div class="isvipi-panel-content isvipi-panel-content-width">
                  
                       <table class="table">
                                    <thead>
                                        <tr>
                                            <th width="150">Date</th>
                                            <th>From</th>
                                            <th>Type</th>
                                            <th width="120">Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
<?php
//We display the list of notifications
while($not = mysql_fetch_array($query1))
{
?>
<?php 
$from_id = $not['from_id'];
$query2 = mysql_query('SELECT * FROM users WHERE id = "'.$from_id.'"');
while($nott = mysql_fetch_array($query2))
{
?>                                    
                                        <tr class="success">
                                            <td><?php echo $not['timestamp']; ?></td>
                                            <td><a href="member_profile.php?id=<?php echo $not['from_id']; ?>" title="View Profile"><?php echo htmlentities($nott['username'], ENT_QUOTES, 'UTF-8'); ?></a></td>
                                            <td>Friend Request</td>
                                            <td><div class="message_options_bar">
                                <a href="delete_msg.php?id=<?php echo $dn1['id']; ?>" title="Accept Friend Request"><i class="fa fa-check"></i></a>
                                <a href="delete_msg.php?id=<?php echo $dn1['id']; ?>" title="Delete"><i class="fa fa-times"></i></a>
                                </div></td>
                                        </tr>
<?php
}
}
?>
<?php
}
else
{
	echo 'You must be logged to access this page.';
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
