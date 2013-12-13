                  <!--========HEADER=====---->
                    <?php include ISVIPI_THEMES_BASE.$theme.'/global/header.php';?>
  <!-- IsVipi Timeline Style -->
  <link href="<?php echo ISVIPI_THEME_URL; ?><?php echo $theme; ?>/css/isvipi-timeline.css" rel="stylesheet" type="text/css" />
                  <!--========/HEADER=====---->
        
                  <!--========SIDEBAR MENU=====---->
                    <?php include ISVIPI_THEMES_BASE.$theme.'/global/sidebar_menu.php';?>
                  <!--========/SIDEBAR MENU=====---->
                  
                  <!--========TIMELINE=====---->
                    <?php
                     define('INCLUDE_CHECK',1);
                      require_once('../lib/functions/timeline_functions.php');
                      // remove tweets older than 1 hour to prevent spam
                      //mysql_query("DELETE FROM timeline WHERE id>1 AND dt<SUBTIME(NOW(),'0 1:0:0')");
	
                      //fetch the timeline
                      $q = mysql_query("SELECT * FROM timeline ORDER BY ID DESC");
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
                 <div class="isvipi-panel-content tabless-panel-content collapse in">
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
          <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js"></script>
          <script type="text/javascript" src="<?php echo ISVIPI_THEME_URL; ?><?php echo $theme; ?>/js/timeline.js"></script>

                  <!--========/TIMELINE=====---->
                        
                  <!--========ANNOUNCEMENTS=====---->
                    <?php include ISVIPI_THEMES_BASE.$theme.'/global/announcements.php';?> 
                  <!--========/ANNOUNCEMENTS=====---->
                  <!--========FOOTER=====---->
                    <?php include ISVIPI_THEMES_BASE.$theme.'/global/footer.php';?> 
                  <!--========/FOOTER=====---->
