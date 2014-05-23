<?php get_header()?>
<script type="text/javascript">
$(document).ready(function()
{
$(".comment_button").click(function(){

var element = $(this);
var I = element.attr("id");

$("#slidepanel"+I).slideToggle(500);
$(this).toggleClass("active"); 

return false;});});
</script>

<link href="<?php echo ISVIPI_STYLE_URL; ?>css/isvipi-timeline.css" rel="stylesheet" type="text/css" />
<?php get_sidebar()?>
                  <?php getFeeds2($user);?>
                       <div class="dash_content">
                        <div class="panel panel-primary full-length">
                          <div id="nobgcolor">
                          <div class="panel-heading">
						  <ul class="nav nav-tabs" id="myTab" >
                                  <li class="active"><a href="#feed" data-toggle="tab"><i class="fa fa-pencil-square"></i> <?php echo UPDATE_STATUS ?></a></li>
                                  <li><a href="#imageUpload" data-toggle="tab"><i class="fa fa-picture-o"></i> <?php echo ADD_PHOTOS ?></a></li>
                               </ul>
                          </div>
                          </div>
                          <div id='content' class="tab-content">
                                  <div class="tab-pane active" id="feed">
                                    <div id="isvipi-timeline">
                         <form id="tweetForm" action="<?php echo ISVIPI_USER_PROCESS ?>" method="post">
                         <input type="hidden" value="<?php echo $username; ?>" name="user" />
                         <input type="hidden" value="feed" name="op" />
                         <textarea name="myfeed" class="form-control" id="inputField" placeholder="<?php echo WHAT_U_DOING ?>"></textarea>
                                  <input type="submit" class="btn btn-primary" value="<?php echo UPDATE ?>"/>
                                 <div class="clear"></div>
                                 </form>
                                  </div>

                                  </div>
                                  <div class="tab-pane" id="imageUpload">
                                   <div class="upload_timeline_image_holder">
                       	<form method="post" action="<?php echo ISVIPI_URL. 'users/processFeed/'?>" enctype="multipart/form-data">
                       	<input type="hidden" name="action" value="9">
                      	<input type="hidden" name="userid" value="<?php echo $user?>">
                        <input type="hidden" name="username" value="<?php echo $username?>">
       <textarea name="myfeed" class="form-control picUpstyled" placeholder="<?php echo TYPE_SMTH ?>"></textarea>
                      	<input type="file" id="fileStatus" onchange="this.form.submit();" name="file">
						<button type="button" id="statusPic"><?php echo UPLOAD_PHOTO ?></button>
                       	</form>
								<script>
                                document.querySelector('#statusPic').addEventListener('click', function(e) {
                                document.querySelector('#fileStatus').click();
                                }, false);
                                </script>
                           </div>
                           </div>
                           </div>
                                
                                <div class="refresh_timeline">
								<?php while ($getusrFeed->fetch()) {?>
                                <?php 	
								xtractUID($act_user)
								?>
                                <div id="<?php echo encryptHardened($FIDentinty) ?>">
                                <div id="feed_block">
                                <div class="feed_user_head">
                                 <div class='timeline_pic'>
                                    <?php t_thumb($uid);?>
                                    <?php if(htmlspecialchars($t_thumb, ENT_QUOTES, 'utf-8') == ""){$t_thumb=".gif";}?>
                                    <div class="member_pic_home"><a href="<?php echo ISVIPI_URL.'profile/' ?><?php getUserDetails($uid); echo $username;?>" data-toggle="tooltip" data-placement="top" title="<?php getUserDetails($uid); echo $username;?>"><img src='<?php echo ISVIPI_PROFILE_PIC_URL.ISVIPI_THUMB_150.htmlspecialchars($t_thumb, ENT_QUOTES, 'utf-8');?>' height='40' width='40' alt='' /></a></div>
                                    <div class="homeUserhead"><a href='<?php echo ISVIPI_URL.'profile/' ?><?php echo $act_user;?>'><?php echo htmlspecialchars($act_user, ENT_QUOTES, 'utf-8');?></a>
                                    <?php if ($shared !== 0){?>
                                    <div class="shared_txt"><?php echo SHARED ?> <a href="<?php echo ISVIPI_URL.'profile/' ?><?php getUserDetails($shared); echo $username;?>"><?php echo $username; ?>'s</a> <?php echo STATUS ?>
                                    </div>
                                    <?php } ?>
                                    </div>
                                    </div>
                                    <div class="hometime"><span class='time_stamp'><i class="fa fa-clock-o"></i> <?php echo relativeTime($time)?></span></div>
                                    <div style="clear:both"></div>
                                    </div>

                                    <div class='timeline_posts'>
                                    <?php echo makeLinks($activity);?><br/>
                                    <?php xtractUID($act_user) ?>
                                    </div>
                                    <?php if($feedImage !=""){?>
                                    <div class="timeline_img">
                                    <img src="<?php echo ISVIPI_TIMELINE_PICS_URL.$feedImage;?>" width="300" />
                                    
                                    </div>
                                    <?php } ?>
                                    <hr />
                                    <div class="feed_options">
                                    <?php $feedposter = $_SESSION['user_id']; ?>
                                    <?php if (hasLiked($FIDentinty,$user)){?>
                                    <span><?php echo YOU_LIKE_THIS ?></span>
                                    <a href="<?php echo ISVIPI_URL. 'users/processFeed/'.encryptHardened('2').'/'.encryptHardened($FIDentinty).'/'.encryptHardened($feedposter).'/'?>"><?php echo UNLIKE ?></a>
                                    <?php } else {?>
                                    <a href="<?php echo ISVIPI_URL. 'users/processFeed/'.encryptHardened('1').'/'.encryptHardened($FIDentinty).'/'.encryptHardened($feedposter).'/'?>"><?php echo LIKE ?></a>
                                    <?php } ?>
                                    <a href="#" class="comment_button" id="<?php echo $FIDentinty; ?>"><?php echo COMMENT ?></a>
                                    <a href="<?php echo ISVIPI_URL. 'users/processFeed/'.encryptHardened('3').'/'.encryptHardened($FIDentinty).'/'.encryptHardened($feedposter).'/'?>" onclick="return confirm('<?php echo N_SHARE_TXT ?>')"><?php echo SHARE ?></a>
                                    </div>
                                    <div class="feed_option_notices">
                                    <?php AllLikes($FIDentinty); if ($allLikes >0 ){?>
                                    <i class="fa fa-thumbs-o-up"></i> <?php echo $allLikes ?>
                                    <?php } ?>
                                    <?php AllComments($FIDentinty); if ($allComms > 0){?>
                                    <i class="fa fa-comment-o"></i> <?php echo $allComms ?>
                                    <?php } ?>
                                    <?php AllShares($FIDentinty); if ($allShares > 0){?>
                                    <i class="fa fa-share"> <?php echo $allShares ?></i>
                                    <?php } ?>
                                    </div>
                                    <?php if($user == $feedUID){?>
                                    <div class="manage_feed_display">
                                    <a href="<?php echo ISVIPI_URL. 'users/processFeed/'.encryptHardened('5').'/'.encryptHardened($FIDentinty).'/'.encryptHardened($feedposter).'/'?>" data-toggle="tooltip" data-placement="top" title="<?php echo DELETE.' '.POST ?>" onclick="return confirm('<?php echo N_DELETE_FEED_TXT ?>')"><i class="fa fa-times"></i></a>
                                    </div>
                                    <?php } ?>
                                    <div style="clear:both"></div>
                                    <hr />
                                    <div class="comments_show">
                                    <div class="reply_panel reply_form_styled" id="slidepanel<?php echo $FIDentinty; ?>">
                                        <form action="<?php echo ISVIPI_URL. 'users/processFeed/'?>" method="post">
                                        <textarea class="form-control common" name="comment_reply" id="comments" placeholder="<?php echo N_PLEASE_TYPE_COMM ?>" required="required"></textarea>
                                        <input type="hidden" name="feed_identity" value="<?php echo $FIDentinty; ?>" />
                                        <input type="hidden" name="userid" value="<?php echo $user; ?>" />
                                        <input type="hidden" name="action" value="4" />
                                        <input type="submit" class="btn btn-primary btn-xs pull-right" value="<?php echo COMMENT ?>"/><div style="clear:both"></div>
                                        </form>
                                        </div>
                                    <?php getComments ($FIDentinty) ?>
                                    <?php while ($getComm->fetch()) {
										?>
                                    <div class="comments_display_block">
                                    <?php t_thumb($feedCommentBy);?>
                                    <?php if(htmlspecialchars($t_thumb, ENT_QUOTES, 'utf-8') == ""){$t_thumb=".gif";}?>
                                    <div class="member_pic_home_comment"><a href="<?php echo ISVIPI_URL.'profile/' ?><?php getUserDetails($feedCommentBy); echo $username;?>" data-toggle="tooltip" data-placement="top" title="<?php getUserDetails($feedCommentBy); echo $username;?>"><img src='<?php echo ISVIPI_PROFILE_PIC_URL.ISVIPI_THUMB_150.htmlspecialchars($t_thumb, ENT_QUOTES, 'utf-8');?>' height='35' width='35' alt='' /></a></div>
                                    <div class="actual_comment"><?php echo $feedComment ?></div>
                                    <div style="clear:both"></div>
                                    <div class="like_comment">
                                    <div class="like_comment_count">
                                    <?php AllCommentsLikes($FeedCommentID)?>
                                    <?php if ($allCommsLike == 1){?>
                                    <?php echo $allCommsLike ?> <?php echo LIKES_THIS ?>
                                    <?php } else if ($allCommsLike > 1){?>
                                    <?php echo $allCommsLike ?> <?php echo LIKE_THIS ?>
                                    <?php } ?>
                                    </div>
                                    <?php hasLikedComment($FeedCommentID,$user) ?>
                                    <?php if ($haslikedComm > 0){ ?>
                                    <a href="<?php echo ISVIPI_URL. 'users/processFeed/'.encryptHardened('7').'/'.encryptHardened($FeedCommentID).'/'.encryptHardened($user)?>"><?php echo UNLIKE ?></a>
                                    <?php } else { ?>
                                    <a href="<?php echo ISVIPI_URL. 'users/processFeed/'.encryptHardened('6').'/'.encryptHardened($FIDentinty).'/'.encryptHardened($FeedCommentID).'/'.encryptHardened($user)?>"><?php echo LIKE ?></a>
                                    <?php }?>
                                    <?php if ($user == $feedCommentBy || $user == $feedUID){?>
                                    <a href="<?php echo ISVIPI_URL. 'users/processFeed/'.encryptHardened('8').'/'.encryptHardened($FeedCommentID)?>" data-toggle="tooltip" data-placement="top" title="<?php echo DELETE.' '.COMMENT ?>" onclick="return confirm('<?php echo N_DELETE_FEED_COMMENT_TXT ?>')"><?php echo DELETE ?></a>
                                    <span class="comment_tyme"><i class="fa fa-clock-o"></i> <?php echo relativeTime($commentTime) ?> </span>
                                    <?php } ?>
                                    
                                    </div>
                                    <div style="clear:both"></div>
                                    </div>
                                    <?php  } ?>
                                    
                                    </div>
                                    </div>
                                    </div>
                                    <?php } ?>
                                   </div>
                                   </div>
                                   </div>
                                  
                                                                    
<script type="text/javascript">

$(document).ready(function(){
var txt = $('#comments'),
    hiddenDiv = $(document.createElement('div')),
    content = null;

txt.addClass('txtstuff');
hiddenDiv.addClass('hiddendiv common');

$('body').append(hiddenDiv);

txt.on('keyup', function () {

    content = $(this).val();

    content = content.replace(/\n/g, '<br>');
    hiddenDiv.html(content + '<br class="lbr">');

    $(this).css('height', hiddenDiv.height());

});
});</script>

<?php get_r_sidebar()?>
<?php get_footer()?>