<?php include ISVIPI_THEMES_BASE.'/global/header.php';?>
                  <!--========SIDEBAR MENU=====---->
                    <?php include ISVIPI_THEMES_BASE.'/global/sidebar_menu.php';?>
                    
                  <!--========/SIDEBAR MENU=====---->
                  <!--========EDIT PROFILE=====---->
                  <?php DisplayFReq($user);?>
                       <div class="dash_content">
                        <div class="panel panel-primary">
                          <div class="panel-heading">Friend Requests
                           </div>
                               <div class="panel-body members_full">
                                     <div class="m_list">
                                     <table class="table" style="width:500px">
                                        <thead>
                                            <tr>
                                                <th width="150">Date</th>
                                                <th>From</th>
                                                <th width="120">Action</th>
                                            </tr>
                                        </thead>
									   <?php while ($getusrst->fetch())
											{?>
                                          <tr class="success">
                                            <td><?php echo htmlspecialchars($timestamp, ENT_QUOTES, 'utf-8');?></td>
                                            <td><a href="<?php echo ISVIPI_URL. 'profile/'?><?php getUserDetails($from_id); echo $username;?>" title="View Profile"><?php getUsername(); echo htmlspecialchars($user_name, ENT_QUOTES, 'utf-8');?></a></td>
                                            <td><div class="message_options_bar">
                                <a href="<?php echo ISVIPI_URL. '/users/fRequests'?>?action=1&id=<?php echo htmlspecialchars($from_id, ENT_QUOTES, 'utf-8');?>" title="Accept Friend Request"><i class="fa fa-check"></i></a>
                                <a href="<?php echo ISVIPI_URL. '/users/fRequests'?>?action=0&id=<?php echo htmlspecialchars($from_id, ENT_QUOTES, 'utf-8');?>" title="Reject Friend Request"><i class="fa fa-times"></i></a>
                                </div></td>
                                
                                </tr>
                                <?php } ?>
                                <?php if ($getusrst->num_rows()<1){?>
                                <td colspan="3">You have no pending friend requests</td>
                                <?php }?>
                                </table>
                                  </div>
							  </div>
                          </div><!--end of panel-->
                        </div><!--end of dash_content-->
                 <!--========ANNOUNCEMENTS=====---->
                    <?php include ISVIPI_THEMES_BASE.'/global/announcements.php';?> 
                  <!--========/ANNOUNCEMENTS=====---->
<?php get_footer();?>