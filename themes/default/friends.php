                  
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
                      <li class="active"><a href="friends.php">All</a></li>
                      </ul>
                      </div>
                    </div>
                    <div class="isvipi-panel-content tabless-panel-content collapse in">
                    <?php
//We get the IDs, usernames and emails of users
$my_id = $getuser[0]['id'];
$req = mysql_query("SELECT * FROM my_friends WHERE user1='".$my_id."'");
while($dnn = mysql_fetch_array($req))
{
//$thumb = htmlentities($dnn['thumb_path']);
//if(!$thumb) $thumb = "pics/no-image.gif";

//$gender = htmlentities($dnn['gender']);
//if ($gender=="male")
 // {
 // $genderd= '<i class="fa fa-male"></i>';
//  }
 // else
//  {$genderd ='<i class="fa fa-female"></i>';
//  }
// $online = htmlentities($dnn['online']);
//if ($online=="1")
//  {
//  $onlined= '<span style="color:#090"><i class="fa fa-circle"></i></span>';
//  }
//  else
//  {$onlined ='<span style="color:#900"><i class="fa fa-circle"></i></span>';
//  }

$users = htmlentities($dnn['user2']);
$req2 = mysql_query("SELECT * FROM users WHERE id='".$users."'");
while($dnnn = mysql_fetch_array($req2))
{
$thumb = htmlentities($dnnn['thumb_path']);
if(!$thumb) $thumb = "pics/no-image.gif";
// get the IDs, usernames and emails of users
$online = htmlentities($dnnn['online']);
if ($online=="1")
  {
  $onlined= '<span style="color:#090"><i class="fa fa-circle"></i></span>';
  }
  else
  {$onlined ='<span style="color:#900"><i class="fa fa-circle"></i></span>';
  }
?>
<!--Display friends-->
<div class="friend_list">
  <div class="col-xs-6 col-md-3">
    <a href="member_profile.php?id=<?php echo $dnnn['id']; ?>" class="thumbnail">
      <img src="<?php echo ISVIPI_MEMBER_URL; ?><?php echo $thumb; ?>" alt="...">
    </a>
    <div class="member_online"><?php echo $onlined; ?></div>
    <li><?php echo htmlentities($dnnn['username']);?></li>
  </div>
</div>
<?php
}
}
?>
                    </div><!--End of isvipi-panel-content-->
          </div><!--End of panel-->
              <!--========/MEMBERS=====---->
                        
                        <!--========ANNOUNCEMENTS=====---->
                    <?php include ISVIPI_THEMES_BASE.'global/announcements.php';?> 
                  <!--========/ANNOUNCEMENTS=====---->
                  <!--========/IMPORTANT TAGS=====---->
                  <!--========FOOTER=====---->
                    <?php include ISVIPI_THEMES_BASE.'global/footer.php';?> 
                  <!--========/FOOTER=====---->
