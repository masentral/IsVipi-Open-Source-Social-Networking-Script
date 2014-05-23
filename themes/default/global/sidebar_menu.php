<div class="container dashboard_layout">
    <!-- left, vertical navbar -->
       <div class="col-md-4">
           <ul class="nav navbar-collapse collapse sidebar-menu">
               <li <?php global $ACTION; if ($ACTION[0]=="home"){echo "class='active'";}?>><a href="<?php echo ISVIPI_URL.'home/' ?>" title="<?php echo DASHBOARD ?>"><i class="fa fa-home"></i> <?php echo DASHBOARD ?></a></li>
               <?php global $username?>
               <?php if (isAdmin()==FALSE){?><li <?php if ($ACTION[0]=="profile"){echo "class='active'";}?>><a href="<?php echo ISVIPI_URL.'profile/' ?><?php echo htmlspecialchars($username, ENT_QUOTES, 'utf-8');?>" title="<?php echo MY_PROFILE ?>"><i class="fa fa-eye-slash"></i> <?php echo MY_PROFILE ?></a></li>
               <li <?php if ($ACTION[0]=="friendlist"){echo "class='active'";}?>><a href="<?php echo ISVIPI_URL.'friendlist/' ?>" title="<?php echo MY_FRIENDS ?>"><i class="fa fa-users"></i> <?php echo MY_FRIENDS ?></a></li>
               <li <?php if ($ACTION[0]=="messages"||$ACTION[0]=="read_pm"){echo "class='active'";}?>><a href="<?php echo ISVIPI_URL.'messages/' ?>" title="<?php echo MY_MESSAGES ?>"><i class="fa fa-envelope-o"></i> <?php echo MY_MESSAGES ?></a></li>
               <?php }?>
               <li <?php if ($ACTION[0]=="memberlist"){echo "class='active'";}?>><a href="<?php echo ISVIPI_URL.'memberlist/' ?>" title="<?php echo BROWSE_MEMBERS ?>"><i class="fa fa-users"></i> <?php echo BROWSE_MEMBERS ?></a></li>
          </ul>
     </div> <!--End col-md-4-->
