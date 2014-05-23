<?php get_header()?>
<?php get_sidebar()?>
                       <div class="dash_content">
                        <div class="panel panel-primary">
                          <div class="panel-heading"><?php echo MY_CONV ?>
                           </div>
                               <div class="panel-body members_full">
                                     <div class="m_list">
                                        <div class="scrollable2">
                                     <table class="table msglist" style="width:500px">
                                        <thead>
                                            <tr>
                                            <th width="150"><?php echo DATE ?></th>
                                            <th><?php echo CHAT_WITH ?></th>
                                            <th width="120"><?php echo ACTION ?></th>
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
           <td><a href="<?php echo ISVIPI_URL.'profile/';?><?php if($user1 == $msg_from){getUserDetails($msg_to);echo $username ;}else if ($user1 == $msg_to){$msg_from; getUserDetails($msg_from);echo $username ;}?>" title="View Profile"><?php if($user1 == $msg_from){getUserDetails($msg_to);echo $username ;}else if ($user1 == $msg_to){$msg_from; getUserDetails($msg_from);echo $username ;}?></a> <span class="label label-success"><?php echo NEW_M ?></span></td>
                                            <?php } else{?>
                                            <td><a href="<?php echo ISVIPI_URL.'profile/'?><?php if($user1 == $msg_from){getUserDetails($msg_to);echo $username ;}else if ($user1 == $msg_to){$msg_from; getUserDetails($msg_from);echo $username ;}?>" title="View Profile"><?php if($user1 == $msg_from){getUserDetails($msg_to);echo $username ;}else if ($user1 == $msg_to){$msg_from; getUserDetails($msg_from);echo $username ;}?></a></td>
                                            <?php }?>
                                            <td><div class="message_options_bar">
                                            <?php $code = implode('/', array($msg_from, $unique_id, $msg_to,$msg_id));?>
                                            
                                <a href="<?php echo ISVIPI_URL.'read_pm/'.encrypt_str($code);?>" title="Read"><?php echo READ ?> <i class="fa fa-external-link"></i></a>
                                    </div>
                                    </td>
                                        </tr>
                                        </tbody>
                                        <?php } ?>
                                        <?php if (getAllmsgs($user) ==""){;?>
                                        <td><?php echo NO_MSGS ?></td>
                                        <?php }?>
                                     </table>
                                     </div>
                                  </div>
							  </div>
                          </div><!--end of panel-->
                        </div><!--end of dash_content-->
                        
<?php get_r_sidebar()?>
<?php get_footer()?>