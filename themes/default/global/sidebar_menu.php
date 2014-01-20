<div class="container dashboard_layout">
    <!-- left, vertical navbar -->
       <div class="col-md-4">
           <ul class="nav navbar-collapse collapse sidebar-menu">
               <li class="active"><a href="../members/" title="My Dashboard"><i class="fa fa-home"></i> Dashboard</a></li>
               <li><a href="profile.php?id=<?php echo htmlspecialchars($user, ENT_QUOTES, 'utf-8');?>" title="My Public Profile"><i class="fa fa-eye-slash"></i> My Profile</a></li>
               <li><a href="friendlist.php" title="My Friends"><i class="fa fa-users"></i> My Friends</a></li>
               <li><a href="messages.php" title="My Friends"><i class="fa fa-envelope-o"></i></i> My Messages</a></li>
               <li><a href="members.php" title="Members Online"><i class="fa fa-users"></i> Browse Members</a></li>
               <li class="disabled"><a href="#" title="Groups"><i class="glyphicon glyphicon-chevron-right"></i> Groups</a></li>
          </ul>
     </div> <!--End col-md-4-->
