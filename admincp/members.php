<?php include_once'header.php';?>
<?php include_once'sidebar.php';?>
    <!-- Start of the container-->
    <div class="container-admin">
      <div class="page-header">
		<ul class="breadcrumb breadcrumb-admin">
  			<li><i class="fa fa-home"></i> Home</li>
  			<li class="active">Member Management</li>
            <span class="donate_support"><span class="label label-danger">Support IsVipi, Donate!</span></span>
        <div class="donate">
        <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=8EKWYJABNLDE2" data-toggle="tooltip" data-placement="bottom" target="_blank" title="Support us by making a donation"><img src="<?php echo ISVIPI_STYLE_URL.'images/donate.png';?>" width="100%" alt="" /></a>
        </div>
        </ul>
     </div>
     <!-- Start of main_content-->
     <div class="main_content">
     <div style="clear:both"></div>
     <div class="dash_admin_panel_cont"> <!--start of dash_cont_stat-->
     
       <div class="all_members_page">
       <?php 
	   		global $pager;
			$p_limit = "10";
			if (!isset($_GET['pager']) or !is_numeric($_GET['pager'])) {
			  $pager = 0;
			} else {
			  $pager = (int)$_GET['pager'];
			}
			if (!isset($_GET['filter']) or !is_numeric($_GET['filter'])) {
			  $filter = "5";
			} else {
			  $filter = (int)$_GET['filter'];
			}
			
	   getMembersAll2($pager,$filter,$p_limit)?>
     	<div class="panel panel-default maxi-left">
    	<div class="panel-heading">
        <ul class="nav nav-pills pull-left">
          <li <?php if($filter=="5"){echo 'class="active"';}?>><a href="<?php echo ISVIPI_URL."admin/members"?>">All</a></li>
<li <?php if($filter=="1"){echo 'class="active"';}?>><a href="<?php echo ISVIPI_URL."admin/members?pager=0"?>&filter=1">Active</a></li>
<li <?php if($filter=="0"){echo 'class="active"';}?>><a href="<?php echo ISVIPI_URL."admin/members?pager=0"?>&filter=0">Unvalidated</a></li>
<li <?php if($filter=="3"){echo 'class="active"';}?>><a href="<?php echo ISVIPI_URL."admin/members?pager=0"?>&filter=3">Suspended</a></li>
	   </ul>
       <div class="altered">
       <span class="label label-info"><?php getMembersAll();echo $Allcount?> registered members</span>
       <span class="label label-info"><?php getUnValMembers(); echo $un_count?> unvalidated members</span>
       <span class="label label-info"><?php getSusMembers();echo $sus_count?> suspended members</span>
       </div>
       <ul class="nav nav-pills pull-right">
       <li class='active'><a href="<?php echo ISVIPI_URL.'admin/add_new' ?>" class="btn btn-info">Add New User</a>
       
       </li>
       </ul>
       <div style="clear:both"></div>
       
        </div>
          <table class="table table-bordered">
          <thead>
          <tr>
           <th width="80">User ID</th>
           <th width="180">Username</th>
           <th width="200">User Email</th>
           <th width="120">Status</th>
           <th>Manage</th>
           </tr>
           </thead>
           <tbody>
           <?php while ($getmembersAll2->fetch() )
			{?>
           <tr>
           <td><?php echo $id ?></td>
           <td><a href="<?php echo ISVIPI_URL.'profile/'; echo $profile_name;?>" data-toggle="tooltip" data-placement="bottom" title="View <?php echo $profile_name ?>'s Profile" target="_blank"><?php echo $profile_name ?> </a><?php if (isOnlineNOW($id)){?><span class="green" style="font-size:12px; margin-left:10px"><i class="fa fa-circle"></i></span><?php } else {?><span class="red" style="font-size:12px; margin-left:10px"><i class="fa fa-circle"></i></span><?php }?></td>
           <td><?php echo $email ?></td>
           <td><?php if ($status==0){echo "<i class='fa fa-times'></i> Unvalidated";}else if ($status==1){echo "<i class='fa fa-check'></i> Active";}else if ($status==3){echo "<i class='fa fa-lock'></i> Suspended";}?></td>
           
           
           <td><div class="user_manage_options"><a href="<?php echo ISVIPI_URL.'admin/edit_member/'; echo $profile_name;?>" title="Edit <?php echo $profile_name ?>" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-pencil"></i> Edit</a> | <?php if($filter==3 || $status==3){?><a href="<?php echo ISVIPI_URL.'conf/usersManage/3/'.$id.'' ?>" title="Unsuspend <?php echo $profile_name ?>" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-unlock"></i> Unsuspend</a><?php } else if ($status==0){?> <a href='<?php echo ISVIPI_URL.'conf/usersManage/1/'.$id.'' ?>' title='Validate <?php echo $profile_name ?>' data-toggle='tooltip' data-placement='bottom'>Validate</a><?php } else {?><a href="<?php echo ISVIPI_URL.'conf/usersManage/2/'.$id.'' ?>" title="Suspend <?php echo $profile_name ?>" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-lock"></i> Suspend</a><?php }?> | <a href="<?php echo ISVIPI_URL.'conf/usersManage/4/'.$id.'' ?>" id="focus" title="Delete <?php echo $profile_name ?>" data-toggle="tooltip" data-placement="bottom" onclick="return confirm('Are you sure you want to delete this users?')"><i class="fa fa-trash-o"></i> Delete</a> </td>
           </tr>
           <?php }?>
           </tbody>
          </table>
          <div class="pagination_options">
          <?php getMembersAll(); if($Allcount > $p_limit && $filter=="5"){?>
          <ul class="pagination upped pull-left">
              <li <?php if ($pager=="0"){echo "class='disabled'";}?>><a href="<?php echo ISVIPI_URL."admin/members"?>" title="Go to First" data-toggle="tooltip" data-placement="bottom">&laquo;&laquo;</a></li>
              <li <?php if ($pager=="0"){echo "class='disabled'";}?>><a href="<?php echo ISVIPI_URL."admin/members?pager=".($pager-$p_limit)?>" title="Back" data-toggle="tooltip" data-placement="bottom">Back</a></li>
              <li <?php if ($pager>=$Allcount - $p_limit){echo "class='disabled'";}?>><a href="<?php echo ISVIPI_URL."admin/members?pager=".($pager+$p_limit)?>&filter=<?php $filter ?>" title="Next" data-toggle="tooltip" data-placement="bottom">Next</a></li>
              <li <?php if ($pager>=$Allcount - $p_limit){echo "class='disabled'";}?>><a href="<?php echo ISVIPI_URL."admin/members?pager=".($Allcount-$p_limit)?>&filter=<?php $filter ?>" title="Go to Last" data-toggle="tooltip" data-placement="bottom">&raquo;&raquo;</a></li>
		</ul>
        <?php } ?>
        <div class="member_manage_options">
        <a href="<?php echo ISVIPI_URL.'conf/usersManage/s_All/' ?>" class="btn btn-info" onclick="return confirm('Are you sure you want to suspended ALL users?')">Suspend All</a>
        <a href="<?php echo ISVIPI_URL.'conf/usersManage/uns_All/' ?>" class="btn btn-info" onclick="return confirm('Are you sure you want to unsuspend ALL suspended users?')">Unsuspend All Suspended</a>
        <a href="<?php echo ISVIPI_URL.'conf/usersManage/del_unv_All/' ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete unvalidated users?')">Delete All Unvalidated</a>
        <a href="<?php echo ISVIPI_URL.'conf/usersManage/del_sus_All/' ?>" onclick="return confirm('Are you sure you want to delete suspended users?')" class="btn btn-danger">Delete All Suspended</a>
          </div>
          </div>
          <div class="panel-heading">
          <div style="width:500px">
          <form name="search" method="post" action="<?php echo ISVIPI_URL.'conf/search/' ?>">
                      <input type="hidden" name="search" value="search">
                        <div class="input-group">
                          <input type="text" class="form-control" name="searchTerm" value="" placeholder="Search by username, id or email">
                          <span class="input-group-btn">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                          </span>
                        </div><!-- /input-group -->
        				<input type="radio" name="type" value="username" checked="checked"> By Username &nbsp;&nbsp;
                        <input type="radio" name="type" value="id"> By ID &nbsp;&nbsp;
                        <input type="radio" name="type" value="email"> By Email
                        </form>
          </div>
          </div>
          <div style="clear:both"></div>
  		</div>
     </div> 
<div style="clear:both"></div>


     </div>
     </div><!--end of dash_cont_stat-->
     </div><!-- End of main_content-->
    </div> <!-- End of the container-->
     </div>
<?php include_once'footer.php';?>