<?php get_header()?>
<?php get_sidebar()?>
                       <div class="dash_content">
                        <div class="panel panel-primary">
                          <div class="panel-heading">My Conversations
                           </div>
                               <div class="panel-body members_full">
                                     <div class="m_list">
                                        <div class="scrollable2">
                                     <table class="table msglist" style="width:500px">
                                        <thead>
                                            <tr>
                                            <th width="150">Date</th>
                                            <th>Chat with</th>
                                            <th width="120">Action</th>
                                            </tr>
                                        </thead>
                                        <?php 
											//Retrieve all messages whether read or not
											getAllmsgs($user);
											while ($geAllmsgs->fetch())
											{
										?>
                                        <tbody>
                                          <tr>
                                          <?php 
										  getUserDetails($msg_from);
										  $user1 = $_SESSION['user_id'];
										  ?>
                                         <td><?php echo date('d M Y \a\t g:ia', strtotime($timestamp));?></td>
                                         <?php newSingMsg($user1,$unique_id); ?>
										 <?php if ($newmsgs >0){?>
           <td><a href="<?php echo ISVIPI_URL.'profile/';?><?php if($user1 == $msg_from){getUserDetails($msg_to);echo $username ;}else if ($user1 == $msg_to){$msg_from; getUserDetails($msg_from);echo $username ;}?>" title="View Profile"><?php if($user1 == $msg_from){getUserN($msg_to);echo $name ;}else if ($user1 == $msg_to){$msg_from; getUserN($msg_from);echo $name ;}?></a> <span class="label label-success">new</span></td>
                                            <?php } else{?>
                                            <td><a href="<?php echo ISVIPI_URL.'profile/'?><?php if($user1 == $msg_from){getUserDetails($msg_to);echo $username ;}else if ($user1 == $msg_to){$msg_from; getUserDetails($msg_from);echo $username ;}?>" title="View Profile"><?php if($user1 == $msg_from){getUserN($msg_to);echo $name ;}else if ($user1 == $msg_to){$msg_from; getUserN($msg_from);echo $name ;}?></a></td>
                                            <?php }?>
                                            <td><div class="message_options_bar">
                                            <?php $code = implode('/', array($msg_from, $unique_id, $msg_to,$msg_id));?>
                                            
                                <a href="<?php echo ISVIPI_URL.'read_pm/'.encrypt_str($code);?>" title="Read">Read <i class="fa fa-external-link"></i></a>
                                    </div>
                                    </td>
                                        </tr>
                                        </tbody>
                                        <?php } ?>
                                        <?php if (getAllmsgs($user) ==""){;?>
                                        <td>You have no messages</td>
                                        <?php }?>
                                     </table>
                                     </div>
                                  </div>
							  </div>
                          </div><!--end of panel-->
                        </div><!--end of dash_content-->
                        
<?php get_r_sidebar()?>
<?php get_footer()?>