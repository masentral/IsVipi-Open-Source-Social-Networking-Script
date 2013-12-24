                  <!--========HEADER=====---->
                    <?php include ISVIPI_THEMES_BASE.'/global/header.php';?>
  <!-- IsVipi Timeline Style -->
  <link href="<?php echo ISVIPI_THEME_URL; ?>css/isvipi-timeline.css" rel="stylesheet" type="text/css" />
                  <!--========/HEADER=====---->
        
                  <!--========SIDEBAR MENU=====---->
                    <?php include ISVIPI_THEMES_BASE.'/global/sidebar_menu.php';?>
                  <!--========/SIDEBAR MENU=====---->
                  
                  <!--========TIMELINE=====---->
                    <?php
                     define('INCLUDE_CHECK',1);
                      require_once('../lib/functions/timeline_functions.php');
                      // remove tweets older than 1 hour to prevent spam
                      //mysql_query("DELETE FROM timeline WHERE id>1 AND dt<SUBTIME(NOW(),'0 1:0:0')");
	
                      //fetch the timeline
                      $q = mysql_query("SELECT * FROM timeline ORDER BY ID DESC LIMIT 0, 10");
                      $timeline='';
                      while($row=mysql_fetch_assoc($q))
                      {
	                   $timeline.=formatTweet($row['tweet'],$row['dt'],$row['username']);
                      }

                     // fetch the latest tweet
                     //$lastTweet = '';
                     //list($lastTweet) = mysql_fetch_array(mysql_query("SELECT tweet FROM timeline ORDER BY id DESC LIMIT 1"));
                    //if(!$lastTweet) $lastTweet = "You don't have any tweets yet!";
                     ?>

                   
                  <!-- content -->
                  <div class="col-md-6">
                  <div class="row">
                     <div class="panel panel-default tabless-panel timeline-layout">
                       <div class="panel-heading">
                       <div class="text-muted isvipi-title">Timeline</div>
                  </div>
                 <div class="isvipi-panel-content tabless-panel-content collapse in overflow">
                  <div id="isvipi-timeline">
                     <form id="tweetForm" action="<?php echo ISVIPI_CORE_URL; ?>user_timeline.php" method="post">
                     <input type="hidden" value="<?=$getuser[0]['username'];?>" name="user_username" />
                       <span class="counter">140</span>
                     <label for="inputField">What are you doing?</label>
                     <textarea name="inputField" class="form-control" id="inputField" tabindex="1"rows="2" cols="40"></textarea>
                     <input class="submitButton inact" name="submit" type="submit" value="update" />
                         <div class="clear"></div>
                     </form>
                   <h3 class="timeline">Timeline</h3>
                     <ul class="statuses"><?=$timeline?></ul>
                </div><!--End of isvipi-timeline-->
              </div><!--End of isvipi-panel-content-->
          </div><!--End of panel-->
                       		  <!--Important javascript timeline functions-->
		  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
           <script type="text/javascript">
              $(document).ready(function(){
	          $('#inputField').bind("blur focus keydown keypress keyup", function(){recount();});
	          $('input.submitButton').attr('disabled','disabled');
	          $('#tweetForm').submit(function(e){
		      tweet();
		      e.preventDefault();
	        });
          });
function recount()
{
	var maxlen=140;
	var current = maxlen-$('#inputField').val().length;
	$('.counter').html(current);
	if(current<0 || current==maxlen)
	{
		$('.counter').css('color','#D40D12');
		$('input.submitButton').attr('disabled','disabled').addClass('inact');
	}
	else
		$('input.submitButton').removeAttr('disabled').removeClass('inact');
	if(current<10)
		$('.counter').css('color','#D40D12');
	else if(current<20)
		$('.counter').css('color','#5C0002');
	else
		$('.counter').css('color','#cccccc');
}
function tweet()
{
	var submitData = $('#tweetForm').serialize();
	$('.counter').html('<img src="<?php echo ISVIPI_THEME_URL;?>images/ajax_load.gif" width="16" height="16" style="padding:12px" alt="loading" />');
	$.ajax({
		type: "POST",
		url: "<?php echo ISVIPI_URL;?>/lib/core/user_timeline.php",
		data: submitData,
		dataType: "html",
		success: function(msg){
			if(parseInt(msg)!=0)
			{
				$('ul.statuses li:first-child').before(msg);
				$("ul.statuses:empty").append(msg);
				
				$('#lastTweet').html($('#inputField').val());
				
				$('#inputField').val('');
				recount();
			}
		}
	});
}
</script>
        
                  <!--========/TIMELINE=====---->
                        
                  <!--========ANNOUNCEMENTS=====---->
                    <?php include ISVIPI_THEMES_BASE.'/global/announcements.php';?> 
                  <!--========/ANNOUNCEMENTS=====---->
                  <!--========FOOTER=====---->
                    <?php include ISVIPI_THEMES_BASE.'/global/footer.php';?> 
                  <!--========/FOOTER=====---->
