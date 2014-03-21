<div class="container dashboard_layout">
    <!-- left, vertical navbar -->
       <div class="col-md-4">
           <ul class="nav navbar-collapse collapse sidebar-menu">
               <li <?php global $ACTION; if ($ACTION[0]=="home"){echo "class='active'";}?>><a href="<?php echo ISVIPI_URL.'home/' ?>" title="My Dashboard"><i class="fa fa-home"></i> Dashboard<?php global $ACTION; echo $ACTION[0];?></a></li>
               <?php global $username?>
               <li <?php if ($ACTION[0]=="profile"){echo "class='active'";}?>><a href="<?php echo ISVIPI_URL.'profile/' ?><?php echo htmlspecialchars($username, ENT_QUOTES, 'utf-8');?>" title="My Public Profile"><i class="fa fa-eye-slash"></i> My Profile</a></li>
               <li <?php if ($ACTION[0]=="friendlist"){echo "class='active'";}?>><a href="<?php echo ISVIPI_URL.'friendlist/' ?>" title="My Friends"><i class="fa fa-users"></i> My Friends</a></li>
               <li <?php if ($ACTION[0]=="messages"||$ACTION[0]=="read_pm"){echo "class='active'";}?>><a href="<?php echo ISVIPI_URL.'messages/' ?>" title="My Friends"><i class="fa fa-envelope-o"></i></i> My Messages</a></li>
               <li <?php if ($ACTION[0]=="memberlist"){echo "class='active'";}?>><a href="<?php echo ISVIPI_URL.'memberlist/' ?>" title="Members Online"><i class="fa fa-users"></i> Browse Members</a></li>
               <li class="disabled"><a href="#" title="Groups"><i class="glyphicon glyphicon-chevron-right"></i> Groups</a></li>
          </ul>
     </div> <!--End col-md-4-->
