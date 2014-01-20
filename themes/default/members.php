                  <!--========SIDEBAR MENU=====---->
                    <?php include ISVIPI_THEMES_BASE.'/global/sidebar_menu.php';?>
                    
                  <!--========/SIDEBAR MENU=====---->
                  <!--========EDIT PROFILE=====---->
                       <div class="dash_content">
                        <div class="panel panel-primary">
                          <div class="panel-heading"><div class="members_options">
                          <div class="btn-group">
                                  <button type="button" class="btn btn-info"><i class="fa fa-plus"></i> Options</button>
                                  <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown">
                                    <span class="caret"></span>
                                    <span class="sr-only">Toggle Dropdown</span>
                                  </button>
                                  <ul class="dropdown-menu" role="menu">
                                    <li><a href="online.php"> Online Now</a></li>
                                    <li class="divider"></li>
                                    <li><a href="new_members.php">New Members</a></li>
                                  </ul>
                                </div>
                            </div>
                           </div>
                               <div class="panel-body members_full">
                                     <div class="m_list">
                                       <div class="scrollable2">
                                     <?php getMembers();?>
                                     	
                                        <?php while ($getmembers->fetch())
											{
												getMemberDet($id);
											?> 
                                            
                                            <li>
                                            <div class="member_pic">
                                  <?php if(htmlspecialchars($m_thumbnail, ENT_QUOTES, 'utf-8') == ""){$m_thumbnail="no-image.gif";}?>
                                 <a href="<?php echo ISVIPI_MEMBER_URL.'profile.php?id='.$id.''?>" title="<?php echo htmlspecialchars($m_name, ENT_QUOTES, 'utf-8');?>"><img src="<?php echo ISVIPI_MEMBER_URL.'pics/'.htmlspecialchars($m_thumbnail, ENT_QUOTES, 'utf-8');?>" height="100%" width="100%" alt="" /></a>
                                            </div>
                                            <div class="member_info">
                                            <span class="members_list_info">                                  
                                            <table class="table table-striped" style="width:200px">
                                                <tbody>
                                                  <tr>
                                                    <td><a href="<?php echo ISVIPI_MEMBER_URL.'profile.php?id='.$id.''?>"><?php echo htmlspecialchars($m_name, ENT_QUOTES, 'utf-8');?></a></td>
                                                  </tr>
                                                  <tr>
                                                    <td><?php echo htmlspecialchars($m_gender, ENT_QUOTES, 'utf-8');?> (<?php echo htmlspecialchars($m_age, ENT_QUOTES, 'utf-8');?>)</td>
                                                  </tr>
                                                  <tr>
                                                    <td><?php echo htmlspecialchars($m_city, ENT_QUOTES, 'utf-8');?>, <?php echo htmlspecialchars($m_country, ENT_QUOTES, 'utf-8');?></td>
                                                  </tr>
                                                </tbody>
                                              </table>
                                            </span>
                                            
                                            </div>
                                            <div class="friend_req_button">
                                            <?php if(checkExistingReq($id,$user)){
												//Check if a friend request exists
													echo '<span class="label label-primary">';
													echo 'Request Pending';
													echo '</span>';
											}
											//Check if the user is him/herself then hide add friend button
											else if($id ===$user){
											}
											//Check if the request was rejected
											else if(checkIfRejected($id,$user)){
													echo '<span class="label label-danger">';
													echo 'Request Rejected';
													echo '</span>';
											}
											//Check if they are already friends
											else if(checkFriendship($id,$user)){
													echo '<span class="label label-default">';
													echo 'Already Friends';
													echo '</span>';
											}
												else
											{?>
                                            <a href="<?php echo ISVIPI_USER_INC_URL. 'users.frequests.php'?>?action=3&id=<?php echo htmlspecialchars($id, ENT_QUOTES, 'utf-8');?>"><button type="submit" class="btn btn-success">Add Friend</button></a>
											<?php }?>
											</div>
                                        </li>
										<?php }?>
                                     </div>
                                     </div>
							  </div>
                          </div><!--end of panel-->
                        </div><!--end of dash_content-->
                 <!--========ANNOUNCEMENTS=====---->
                    <?php include ISVIPI_THEMES_BASE.'/global/announcements.php';?> 
                  <!--========/ANNOUNCEMENTS=====---->
