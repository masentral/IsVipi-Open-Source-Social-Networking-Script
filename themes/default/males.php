                  
                  <!--========HEADER=====---->
                    <?php include ISVIPI_THEMES_BASE.'global/header.php';?>
                  <!--========/HEADER=====---->
        
                  <!--========SIDEBAR MENU=====---->
                    <?php include ISVIPI_THEMES_BASE.'global/sidebar_menu.php';?>
                  <!--========/SIDEBAR MENU=====---->
                  
                  <!--========MEMBERS=====---->
                 <div class="col-md-6">
                  <div class="row">
                   <div class="panel panel-default tabless-panel timeline-layout">
                     <div class="panel-heading">
                      <div class="member_pills">
                      <ul class="nav nav-pills">
                      <li><a href="members.php">All</a></li>
                      <li><a href="online.php">Online</a></li>
                      <li class="active"><a href="males.php">Males</a></li>
                      <li><a href="females.php">Females</a></li>
                      </ul>
                      </div>
                    </div>
                    <div class="isvipi-panel-content tabless-panel-content collapse in">
                    <?php
//We get the IDs, usernames and emails of users
$req = mysql_query('select * from users where gender="male" ORDER BY id DESC');
while($dnn = mysql_fetch_array($req))
{
$thumb = htmlentities($dnn['thumb_path']);
if(!$thumb) $thumb = "pics/no-image.gif";

$gender = htmlentities($dnn['gender']);
if ($gender=="male")
  {
  $genderd= '<i class="fa fa-male"></i>';
  }
  else
  {$genderd ='<i class="fa fa-female"></i>';
  }
 $online = htmlentities($dnn['online']);
if ($online=="1")
  {
  $onlined= '<span style="color:#090"><i class="fa fa-circle"></i></span>';
  }
  else
  {$onlined ='<span style="color:#900"><i class="fa fa-circle"></i></span>';
  }
?>
  <div class="col-xs-6 col-md-3">
    <a href="member_profile.php?id=<?php echo $dnn['id']; ?>" class="thumbnail" title="<?php echo htmlentities($dnn['username'], ENT_QUOTES, 'UTF-8'); ?>">
      <img src="<?php echo ISVIPI_MEMBER_URL; ?><?php echo $thumb; ?>" alt="...">
    </a>
    <div class="profile_gender"><?php echo $genderd; ?></div><div class="member_online"><?php echo $onlined; ?></div>
    <div class="members_details"><span class="text-right"><a href="member_profile.php?id=<?php echo $dnn['id']; ?>" title="<?php echo htmlentities($dnn['username'], ENT_QUOTES, 'UTF-8'); ?>"><?php echo htmlentities($dnn['username'], ENT_QUOTES, 'UTF-8'); ?></a></span>, <?php echo htmlentities($dnn['age'], ENT_QUOTES, 'UTF-8'); ?><br />
    <?php echo htmlentities($dnn['city'], ENT_QUOTES, 'UTF-8'); ?>, <?php echo htmlentities($dnn['country'], ENT_QUOTES, 'UTF-8'); ?></span></div>
  </div>
  <?php
}
?>
                    </div><!--End of isvipi-panel-content-->
          </div><!--End of panel-->
              <!--========/MEMBERS=====---->
                        
                  <!--========IMPORTANT TAGS=====---->
                        </div><!--End of row-->
                   </div><!--End of col-md-6-->
                </div><!--End of row-->
            </div><!--end of container-->
            </div>
            </div>
            </div>

                  <!--========/IMPORTANT TAGS=====---->
                  <!--========FOOTER=====---->
                    <?php include ISVIPI_THEMES_BASE.'global/footer.php';?> 
                  <!--========/FOOTER=====---->
