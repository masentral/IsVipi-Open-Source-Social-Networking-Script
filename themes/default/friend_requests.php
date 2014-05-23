<?php get_header()?>
<?php get_sidebar()?>
                  <?php DisplayFReq($user);?>
                       <div class="dash_content">
                        <div class="panel panel-primary">
                          <div class="panel-heading"><?php echo FRIEND_REQUESTS ?>
                           </div>
                               <div class="panel-body members_full">
                                     <div class="m_list">
                                     <table class="table" style="width:500px">
                                        <thead>
                                            <tr>
                                                <th width="150"><?php echo DATE ?></th>
                                                <th><?php echo FROM ?></th>
                                                <th width="120"><?php echo ACTION ?></th>
                                            </tr>
                                        </thead>
									   <?php while ($getusrst->fetch())
											{?>
                                          <tr class="success">
                                            <td><?php echo htmlspecialchars($timestamp, ENT_QUOTES, 'utf-8');?></td>
                                            <td><a href="<?php echo ISVIPI_URL. 'profile/'?><?php getUserDetails($from_id); echo $username;?>" title="View Profile"><?php  echo $username;?></a></td>
                                            <td><div class="message_options_bar">
                                <a href="<?php echo ISVIPI_URL. 'users/fRequests'?>?action=1&id=<?php echo htmlspecialchars($from_id, ENT_QUOTES, 'utf-8');?>" title="<?php echo ACCEPT_F_REQUEST ?>"><i class="fa fa-check"></i></a>
                                <a href="<?php echo ISVIPI_URL. 'users/fRequests'?>?action=0&id=<?php echo htmlspecialchars($from_id, ENT_QUOTES, 'utf-8');?>" title="<?php echo REJECT_F_REQUEST ?>"><i class="fa fa-times"></i></a>
                                </div></td>
                                
                                </tr>
                                <?php } ?>
                                <?php if ($getusrst->num_rows()<1){?>
                                <td colspan="3"><?php echo NO_F_REQUEST ?></td>
                                <?php }?>
                                </table>
                                  </div>
							  </div>
                          </div><!--end of panel-->
                        </div><!--end of dash_content-->
<?php get_r_sidebar()?>
<?php get_footer()?>