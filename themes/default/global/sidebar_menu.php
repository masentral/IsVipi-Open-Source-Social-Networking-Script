<div class="container dashboard_layout">
    <!-- left, vertical navbar -->
       <div class="col-md-4">
           <ul class="nav navbar-collapse collapse sidebar-menu">
               <li class="active"><a href="<?php echo ISVIPI_URL.'home/' ?>" title="My Dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
               <li><a href="<?php echo ISVIPI_URL.'profile/' ?><?php echo htmlspecialchars($username, ENT_QUOTES, 'utf-8');?>" title="My Public Profile"><i class="fa fa-eye-slash"></i> My Profile</a></li>
               <li><a href="<?php echo ISVIPI_URL.'friendlist/' ?>" title="My Friends"><i class="fa fa-users"></i> My Friends</a></li>
               <li><a href="<?php echo ISVIPI_URL.'messages/' ?>" title="My Friends"><i class="fa fa-envelope-o"></i></i> My Messages</a></li>
               <li><a href="<?php echo ISVIPI_URL.'memberlist/' ?>" title="Members Online"><i class="fa fa-users"></i> Browse Members</a></li>
               <li class="disabled"><a href="#" title="Groups"><i class="glyphicon glyphicon-chevron-right"></i> Groups</a></li>
          </ul>
     </div> <!--End col-md-4-->
