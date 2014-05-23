<?php get_header()?>
<?php get_sidebar()?>
                       <div class="dash_content">
                        <div class="panel panel-primary">
                          <div class="panel-heading"><strong><?php echo htmlspecialchars($username, ENT_QUOTES, 'utf-8');?>'s <?php echo PROFILE ?></strong></div>
                               <div class="panel-body">
                                 <div class="my_pic">
                                 <?php if(htmlspecialchars($m_thumbnail, ENT_QUOTES, 'utf-8') == ""){$m_thumbnail=".gif";}?>
                                 <img src="<?php echo ISVIPI_PROFILE_PIC_URL.ISVIPI_THUMB_150.htmlspecialchars($m_thumbnail, ENT_QUOTES, 'utf-8');?>" alt="" />
                                 </div>
                                 <div class="my_details">
                                  <table class="table table-bordered">
                                    <tbody>
                                      <tr>
                                        <td><?php echo DISPLAY_NAME ?></td>
                                        <td><?php echo htmlspecialchars($m_name, ENT_QUOTES, 'utf-8');?></td>
                                      </tr>
                                      <tr>
                                        <td><?php echo GENDER ?></td>
                                        <td><?php echo htmlspecialchars($m_gender, ENT_QUOTES, 'utf-8');?></td>
                                      </tr>
                                      <tr>
                                        <td><?php echo AGE ?></td>
                                        <td><?php echo htmlspecialchars($m_age, ENT_QUOTES, 'utf-8');?></td>
                                      </tr>
                                      <tr>
                                        <td><?php echo LOCATION ?></td>
                                        <td><?php echo htmlspecialchars($m_city, ENT_QUOTES, 'utf-8');?>, <?php echo htmlspecialchars($m_country, ENT_QUOTES, 'utf-8');?></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                 </div>
                                 <div class="profile_edit">
                                 <?php if($id==$user) {?>
                                    <?php if ($m_thumbnail !="no-image.gif"){?>
                                    <button class="btn btn-primary" data-toggle="modal" data-target="#profilePic"><?php echo CHANGE_PIC ?></button>
                                    <?php } else {?>
                                 <button class="btn btn-primary" data-toggle="modal" data-target="#profilePic"><?php echo UPLOAD_PIC ?></button>							<?php }?>
                                 <a href="<?php echo ISVIPI_URL.'edit_profile/' ?>" class="btn btn-info" role="button"><?php echo EDIT_MY_PROFILE ?></a>
                                 
                                 <?php } else{?>
                                <button class="btn btn-info" data-toggle="modal" data-target="#sendPM">
  									<?php echo SEND_MSG ?>
								</button>
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
													
											}
												else
											{?>
                                            <a href="<?php echo ISVIPI_URL. 'users/fRequests'?>?action=3&id=<?php echo htmlspecialchars($id, ENT_QUOTES, 'utf-8');?>"><button type="submit" class="btn btn-success"><?php echo ADD_FRIEND ?></button></a>
											<?php }?>
                                <?php if(checkFriendship($id,$user)){?>
                                <a href="#" id="focus"><button type="submit" class="btn btn-danger"><?php echo REM_FRIEND ?></button></a>
                                <?php }?>
                                 <a href="<?php echo $_SERVER['HTTP_REFERER'];?>" class="btn btn-default pull-right" role="button"><?php echo BACK ?></a>
                                 <?php }?>
                                 </div>
                               </div>
                          </div><!--end of panel-->
                        </div><!--end of dash_content-->
<?php get_r_sidebar()?>
					<script>
                            function reset () {
                                $("#toggleCSS").attr("href", "../themes/alertify.default.css");
                                alertify.set({
                                    labels : {
                                        ok     : "Yes",
                                        cancel : "No"
                                    },
                                    delay : 5000,
                                    buttonReverse : false,
                                    buttonFocus   : "ok"
                                });
                            }
                            $("#focus").on( 'click', function () {
                                reset();
                                alertify.set({ buttonFocus: "cancel" });
                                alertify.confirm("<?php echo UNFRIEND_PROMPT ?> <span><?php echo $username ?></span>?", function (e) {
                                    if (e) {
                                        window.location = "<?php echo ISVIPI_URL. 'users/fRequests'?>?action=4&id=<?php echo htmlspecialchars($id, ENT_QUOTES, 'utf-8');?>";
                                    } else {
                                        alertify.error("<?php echo CANCELLED ?>");
                                    }
                                });
                                return false;
                            });
                    </script>
                
                <!-- Modal -->
                <div class="modal fade" id="sendPM" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel"><?php echo MSG_TO ?>: <span class="green"><?php echo htmlspecialchars($username, ENT_QUOTES, 'utf-8');?></span></h4>
                      </div>
                      <div class="modal-body">
                              <form method="post" action="<?php echo ISVIPI_URL. 'users/processPM'?>">
                                <input type="hidden" name="msg" value="0">
                              <div class="form-group">
                                <input class="form-control" type="hidden" name="recip" value="<?php echo htmlspecialchars($id, ENT_QUOTES, 'utf-8');?>" placeholder="Recipient">
                              </div>
                              <div class="form-group">
                                <textarea id="message" name="message" required="required">
								</textarea>
                              </div>
                                

                      </div>
                      <div class="modal-footer">
                      <button class="btn btn-lg btn-primary" type="submit"><?php echo SEND_MSG ?></button>
                       </form>
                        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo CLOSE ?></button>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->       
                
                 <!-- Modal -->
                <div class="modal fade" id="profilePic" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">  
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel"><?php echo UPLOAD_PIC ?></h4>
                      </div>
                      <div class="modal-body">
                       <form action="<?php echo ISVIPI_URL. 'users/processPIC'?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="op" value="newpic">
                        <input type="hidden" name="userid" value="<?php echo $user?>">
                        <label for="file"><?php echo NAME_OF_FILE ?>:</label>
                        <input type="file" class="form-control" name="file"><br>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo CLOSE ?></button>
                        <button type="submit" class="btn btn-primary" name="submit"/><?php echo UPLOAD ?></button>
                        </form>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
<?php get_footer()?>         