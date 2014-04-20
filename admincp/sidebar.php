<div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
  <ul class="nav nav-pills nav-stacked nav-admin">
    <li <?php if ($ACTION[1]=="dashboard"){echo "class='active'";}?>><a href="<?php echo ISVIPI_URL.$adminPath.'/dashboard' ?>"><i class="fa fa-dashboard"></i>&nbsp;Dashboard</a></li>
    <li <?php if ($ACTION[1]=="gen_settings"){echo "class='active'";}?>><a href="<?php echo ISVIPI_URL.$adminPath.'/gen_settings' ?>"><i class="fa fa-wrench"></i> General Settings</a></li>
        <li <?php if ($ACTION[1]=="pages"){echo "class='active'";}?>><a href="<?php echo ISVIPI_URL.$adminPath.'/pages' ?>"><i class="fa fa-print"></i> Manage Pages</a></li>
    <li class="dropdown <?php if($ACTION[1]=="members" || $ACTION[1]=="add_new" || $ACTION[1]=="edit_profile"){echo "has_active";}?>">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#">
        <i class="fa fa-users"></i>&nbsp;Member Management<span class="caret"></span>
      </a>
      <ul class="dropdown-menu">
        <li <?php if ($ACTION[1]=="members"){echo "class='active'";}?>><a href="<?php echo ISVIPI_URL.$adminPath.'/members' ?>">&raquo; Members</a></li>
        <li <?php if ($ACTION[1]=="add_new"){echo "class='active'";}?>><a href="<?php echo ISVIPI_URL.$adminPath.'/add_new' ?>">&raquo; Add New User</a></li>
        <li <?php if ($ACTION[1]=="edit_profile"){echo "class='active'";}?>><a href="<?php echo ISVIPI_URL.$adminPath.'/edit_profile' ?>">&raquo; Edit my Profile</a></li>
        </ul>
    </li>
    <li <?php if ($ACTION[1]=="sys_management"){echo "class='active'";}?>><a href="<?php echo ISVIPI_URL.$adminPath.'/sys_management' ?>"><i class="fa fa-cog"></i>&nbsp;System Management</a></li>
  </ul> 
</div>