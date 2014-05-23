<?php get_header()?>
<?php get_sidebar()?>
                       <div class="dash_content">
                        <div class="panel panel-primary">
                        <script>$(function () { $("[data-toggle='tooltip']").tooltip(); });</script>
                        
                          <div class="panel-heading"><?php echo CHAT_WITH ?> <span class="chat_with"><?php $me = $_SESSION['user_id'];
						  if($me == $msg_from){$user_id = $msg_to;}
						  else if ($me == $msg_to){$user_id = $msg_from;}
						  else {$user_id = $_SESSION['user_id'];$_SESSION['err'] = ERR_PM_NOT_ALLOWED ;}
						  {getUserN($user_id);echo $name;} ?></span></div>
                               <div class="panel-body">
                                	<div class="m_list">
                                        <div class="scrollable3">
                                        <?php if (getConvMsgs($user,$msg_from,$unique_id) >0){
											if ($_SESSION['user_id'] == $msg_from || $_SESSION['user_id'] == $msg_to){
												
										while ($geUtmsgs->fetch())
											{
												$user = $msg_from;
										  		getUserDetails($user);
												
										?>
                                         <div>
                                         <div class="r_msg">
                                         <?php if ($from == $user){?>
                                         <div class="chat_user_ico2"><a href="#" data-toggle="tooltip" data-placement="top" title="<?php $user_id = $user; getUserDetails($user_id);echo $username ?>"><i class="fa fa-user"></i></a></div><p class="triangle-right right">
										<?php echo $message;?>
                                        <span class="chat_time">
                                        <?php 
										$time = $timestamp;echo relativeTime($time);
										?>
                                        </span>
                                        </p>
                                        <?php } else{?>
                                         <div class="chat_user_ico"><a href="#" data-toggle="tooltip" data-placement="right" title="<?php $user_id = $from; getUserDetails($user_id);echo $username ?>"><i class="fa fa-user"></i></a></div><p class="triangle-right left green">
										 <?php echo $message;?>
                                         <span class="chat_time">
                                        <?php 
										$time = $timestamp;echo relativeTime($time);
										?>
                                        </span>
                                         </p>
                                         <?php }?>
                                         
                                         </div>
                                         </div>
                                         <?php } ?>
                                         <?php } ?>
                                         <?php } else {?>
                                         <?php } ?>
                                 		</div>
                                 	</div>
                               </div>
                               <div class="reply_msg">
                                <form method="post" action="<?php echo ISVIPI_URL. 'users/processPM'?>">
                                <input type="hidden" name="msg" value="0">
                              <div class="form-group">
                                <input class="form-control" type="hidden" name="recip" value="<?php echo htmlspecialchars($msg_from, ENT_QUOTES, 'utf-8');?>">
                              </div>
                              <div class="form-group">
                                <input class="form-control" type="hidden" name="title" value="<?php if(isset($_POST['title'])){echo $_POST['title'];}?>">
                              </div>
                              <div class="form-group">
                                <textarea id="message" name="message" required="required"></textarea>
                              </div>
                                <button class="btn btn-primary" type="submit"><?php echo REPLY ?></button>
                             </form>
                            </div>

                          </div><!--end of panel-->
                        </div><!--end of dash_content-->
<?php get_r_sidebar()?>
<?php get_footer();?>