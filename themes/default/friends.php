                  <!--========SIDEBAR MENU=====---->
                    <?php include ISVIPI_THEMES_BASE.'/global/sidebar_menu.php';?>
                    
                  <!--========/SIDEBAR MENU=====---->
                  <!--========EDIT PROFILE=====---->
                       <div class="dash_content">
                        <div class="panel panel-primary">
                          <div class="panel-heading">My Friends
                           </div>
                               <div class="panel-body members_full">
                                     <div class="m_list">
                                     <?php getMyFriends($user);?>
                                     	
                                        <?php while ($getfriends->fetch())
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
                                            <div class="msg_friend_button">
                                            <a href="<?php echo ISVIPI_MEMBER_URL.'profile.php?id='.$id.''?>"><button class="btn btn-info">View & Message</button></a>
                                            
                                            </div>
                                        </li>
										<?php }?>
                                     </div>
							  </div>
                          </div><!--end of panel-->
                        </div><!--end of dash_content-->
                 <!--========ANNOUNCEMENTS=====---->
                    <?php include ISVIPI_THEMES_BASE.'/global/announcements.php';?> 
                  <!--========/ANNOUNCEMENTS=====---->

                  
                  

