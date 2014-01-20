                  <!--========SIDEBAR MENU=====---->
                    <?php include ISVIPI_THEMES_BASE.'/global/sidebar_menu.php';?>
                  <!--========/SIDEBAR MENU=====---->
                  <!--========PROFILE=====---->
                       <div class="dash_content">
                        <div class="panel panel-primary">
                        <script>$(function () { $("[data-toggle='tooltip']").tooltip(); });</script>
                        
                          <div class="panel-heading">Chat with <span class="chat_with"><?php $me = $_SESSION['user_id'];
						  if($me == $msg_from){$user_id = $msg_to;}
						  else if ($me == $msg_to){$user_id = $msg_from;}{getUserN($user_id);echo $name;} ?></span></div>
                               <div class="panel-body">
                                	<div class="m_list">
                                        <div class="scrollable3">
                                        <?php if (getConvMsgs($user,$msg_from,$unique_id) >0){
										while ($geUtmsgs->fetch())
											{
												$user = $msg_from;
										  		getUserDetails($user)
												
										?>
                                         <div>
                                         <div class="r_msg">
                                         <?php if ($from == $user){?>
                                         <div class="chat_user_ico2"><a href="#" data-toggle="tooltip" data-placement="top" title="<?php $user_id = $user; getUserN($user_id);echo $name ?>"><i class="fa fa-user"></i></a></div><p class="triangle-right right">
										<?php echo $message;?>
                                        <span class="chat_time">
                                        <?php 
										$time = $timestamp;echo relativeTime($time);
										?>
                                        </span>
                                        </p>
                                        <?php } else{?>
                                         <div class="chat_user_ico"><a href="#" data-toggle="tooltip" data-placement="right" title="<?php $user_id = $from; getUserN($user_id);echo $name ?>"><i class="fa fa-user"></i></a></div><p class="triangle-right left green">
										 <?php echo $message;?>
                                         <span class="chat_time">
                                        <?php 
										$time = $timestamp;echo relativeTime($time);
										?>
                                        </span>
                                         </p>
                                         <?php }?>
                                         
                                         </div>
                                         <div class="tooltip">
                                            <div class="tooltip-inner">
                                            Tooltip!
                                            </div>
                                            <div class="tooltip-arrow"></div>
                                            </div>
                                         </div>
                                         <?php } ?>
                                         <?php } ?>
                                 		</div>
                                 	</div>
                               </div>
                               <div class="reply_msg">
                                <form method="post" action="<?php echo ISVIPI_USER_INC_URL. 'users.pm.process.php'?>">
                                <input type="hidden" name="msg" value="0">
                              <div class="form-group">
                                <input class="form-control" type="hidden" name="recip" value="<?php echo htmlspecialchars($msg_from, ENT_QUOTES, 'utf-8');?>" placeholder="Recipient" onclick="this.value='';" required="required">
                              </div>
                              <div class="form-group">
                                <input class="form-control" type="hidden" name="title" value="<?php if(isset($_POST['title'])){echo $_POST['title'];}?>" placeholder="Title" onclick="this.value='';" required="required">
                              </div>
                              <div class="form-group">
                                <textarea id="message" name="message" required="required"><?php if(isset($_POST['message'])){echo $_POST['message'];}?></textarea>
                              </div>
                                <button class="btn btn-primary" type="submit">Reply</button>
                             </form>
                            </div>

                          </div><!--end of panel-->
                        </div><!--end of dash_content-->
                  <!--========/PROFILE=====---->
                  <!--========ANNOUNCEMENTS=====---->
                    <?php include ISVIPI_THEMES_BASE.'/global/announcements.php';?> 
                  <!--========/ANNOUNCEMENTS=====---->
