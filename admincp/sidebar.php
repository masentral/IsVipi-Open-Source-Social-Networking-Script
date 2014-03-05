<div class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-left" id="cbp-spmenu-s1">
  <ul class="nav nav-pills nav-stacked nav-admin">
    <li <?php if ($ACTION[1]=="dashboard"){echo "class='active'";}?>><a href="<?php echo ISVIPI_URL.'admin/dashboard' ?>"><i class="fa fa-dashboard"></i>&nbsp;Dashboard</a></li>
    <li class="dropdown <?php if($ACTION[1]=="gen_settings" || $ACTION[1]=="email_settings"){echo "has_active";}?>">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#">
        <i class="fa fa-cogs"></i>&nbsp;Site Settings<span class="caret"></span>
      </a>
      <ul class="dropdown-menu">
        <li <?php if ($ACTION[1]=="gen_settings"){echo "class='active'";}?>><a href="<?php echo ISVIPI_URL.'admin/gen_settings' ?>">&raquo; General Settings</a></li>
        <!--<li /<?php /* if ($ACTION[1]=="email_settings"){echo "class='active'";}?>><a href="<?php echo ISVIPI_URL.'admin/email_settings' */?>">&raquo; Email Settings</a></li>-->
      </ul>
    </li>
    <li class="dropdown <?php if($ACTION[1]=="members" || $ACTION[1]=="add_new" || $ACTION[1]=="edit_profile"){echo "has_active";}?>">
      <a class="dropdown-toggle" data-toggle="dropdown" href="#">
        <i class="fa fa-users"></i>&nbsp;Member Management<span class="caret"></span>
      </a>
      <ul class="dropdown-menu">
        <li <?php if ($ACTION[1]=="members"){echo "class='active'";}?>><a href="<?php echo ISVIPI_URL.'admin/members' ?>">&raquo; Members</a></li>
        <li <?php if ($ACTION[1]=="add_new"){echo "class='active'";}?>><a href="<?php echo ISVIPI_URL.'admin/add_new' ?>">&raquo; Add New User</a></li>
        <li <?php if ($ACTION[1]=="edit_profile"){echo "class='active'";}?>><a href="<?php echo ISVIPI_URL.'admin/edit_profile' ?>">&raquo; Edit my Profile</a></li>
        </ul>
    </li>
  </ul> 
</div>