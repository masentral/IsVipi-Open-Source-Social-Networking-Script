<?php get_header()?>
<?php get_sidebar()?>
                       <div class="dash_content">
                        <div class="panel panel-primary">
                          <div class="panel-heading"><div class="members_options">
                               <span class="label" style="font-size:15px; float:right; position:absolute; margin-left:50px;padding:10px">
							   <?php 
							   if ($results == 1){$ResNumber = RESULT;} else {$ResNumber = RESULTS;}
							   
							   ?>
							   <?php echo $results."&nbsp;".$ResNumber."&nbsp;".FOUND_FOR ?> "<?php echo $term ?>"</span>
                            </div>
                            
                           </div>
                               <div class="panel-body members_full">
                                     <div class="m_list">
                                       <div class="scrollable2">
                                     
                                        <?php while ($search->fetch())
											{
												getMemberDet($id);
												getUserDetails($id)
											?> 
                                            
                                            <li>
                                            <div class="member_pic">
                              <?php if(htmlspecialchars($m_thumbnail, ENT_QUOTES, 'utf-8') == ""){$m_thumbnail=".gif";}?>
                                 <a href="<?php echo ISVIPI_URL.'profile/' ?><?php echo htmlspecialchars($username, ENT_QUOTES, 'utf-8');?>" title="<?php echo htmlspecialchars($m_name, ENT_QUOTES, 'utf-8');?>"><img src="<?php echo ISVIPI_PROFILE_PIC_URL.ISVIPI_THUMB_150.htmlspecialchars($m_thumbnail, ENT_QUOTES, 'utf-8');?>" height="100%" width="100%" alt="" /></a>
                                            </div>
                                            <div class="member_info">
                                            <span class="members_list_info">                                  
                                            <table class="table table-striped" style="width:200px">
                                                <tbody>
                                                  <tr>
                                                    <td><a href="<?php echo ISVIPI_URL.'profile/' ?><?php echo htmlspecialchars($username, ENT_QUOTES, 'utf-8');?>"><?php echo $username?></a></td>
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
													echo REQ_PENDING;
													echo '</span>';
											}
											//Check if the user is him/herself then hide add friend button
											else if($id ===$user){
											}
											//Check if the request was rejected
											else if(checkIfRejected($id,$user)){
													echo '<span class="label label-danger">';
													echo REQ_REJECTED;
													echo '</span>';
											}
											//Check if they are already friends
											else if(checkFriendship($id,$user)){
													echo '<span class="label label-default">';
													echo ALREADY_FRIENDS;
													echo '</span>';
											}
												else
											{?>
                                            <a href="<?php echo ISVIPI_URL. 'users/fRequests'?>?action=3&id=<?php echo htmlspecialchars($id, ENT_QUOTES, 'utf-8');?>"><button type="submit" class="btn btn-success"><?php echo ADD_FRIEND ?></button></a>
											<?php }?>
											</div>
                                        </li>
										<?php }?>
                                        <?php if ($results < 1){?>
                                        <p><?php echo MEMBERS_WTH_USR ?> "<?php echo $term ?>" <?php echo NOT_FOUND ?></p>
                                        <?php }?>
                                     </div>
                                     </div>
							  </div>
                          </div><!--end of panel-->
                        </div><!--end of dash_content-->
<?php get_r_sidebar()?>
<?php get_footer()?>