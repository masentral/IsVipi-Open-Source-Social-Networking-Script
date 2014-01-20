                  <!--========SIDEBAR MENU=====---->
                    <?php include ISVIPI_THEMES_BASE.'/global/sidebar_menu.php';?>
                  <!--========/SIDEBAR MENU=====---->
                  <!--========EDIT PROFILE=====---->
                        
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
										  $user = $msg_from;
										  getUserDetails($user);
										  $user1 = $_SESSION['user_id'];
										  ?>
                                         <td><?php echo date('d M Y \a\t g:ia', strtotime($timestamp));?></td>
                                         <?php newSingMsg($user1,$unique_id); ?>
										 <?php if ($newmsgs >0){?>
           <td><a href="<?php echo ISVIPI_MEMBER_URL.'profile.php?id='.$msg_from.'&msg='.$msg_id.''?>" title="View Profile"><?php echo htmlspecialchars($d_name, ENT_QUOTES, 'utf-8');?></a> <span class="label label-success">new</span></td>
                                            <?php } else{?>
                                            <td><a href="<?php echo ISVIPI_MEMBER_URL.'profile.php?id='.$msg_from.''?>" title="View Profile"><?php $me = $_SESSION['user_id']; if($me == $msg_from){$user_id = $msg_to; getUserN($user_id);echo $name ;}else if ($me == $msg_to){$user_id = $msg_from; getUserN($user_id);echo $name ;}?></a></td>
                                            <?php }?>
                                            <td><div class="message_options_bar">
                                            <?php $code = implode('-', array($msg_from, $unique_id, $msg_to,$msg_id));?>
                                <a href="read_pm.php?id=<?php echo $code?>" title="Read">Read <i class="fa fa-external-link"></i></a>
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
                        
                 <!--========ANNOUNCEMENTS=====---->
                    <?php include ISVIPI_THEMES_BASE.'/global/announcements.php';?> 
                  <!--========/ANNOUNCEMENTS=====---->
