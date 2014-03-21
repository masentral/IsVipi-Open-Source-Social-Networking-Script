<?php include_once'header.php';?>
<?php include_once'sidebar.php';?>
    <!-- Start of the container-->
    <div class="container-admin">
      <div class="page-header">
		<ul class="breadcrumb breadcrumb-admin">
  			<li><i class="fa fa-home"></i> Home</li>
  			<li class="active">Site Stats</li>
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
       <?php getMembersAll()?>
     	<div class="panel panel-default maxi-left">
    	<div class="panel-heading"><strong>All Members</strong></div>
          <table class="table table-bordered">
          <thead>
          <tr>
           <th width="100">User ID</th>
           <th width="180">Username</th>
           <th width="250">User Email</th>
           <th width="100">Status</th>
           <th>Manage</th>
           </tr>
           </thead>
           <tbody>
           <?php while ($getmembersAll->fetch() )
			{?>
           <tr>
           <td><?php echo $id ?></td>
           <td><a href="<?php echo ISVIPI_URL.'profile/'; echo $profile_name;?>" data-toggle="tooltip" data-placement="bottom" title="View <?php echo $profile_name ?>'s Profile" target="_blank"><?php echo $profile_name ?></a></td>
           <td><?php echo $email ?></td>
           <td><?php if ($status==0){echo "Unvalidated";}else if ($status==1){echo "Active";}else if ($status==3){echo "Suspended";}?></td>
           <td><div class="user_manage_options"><a href="" title="Edit User" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-pencil"></i> Edit</a> | <a href="" title="Suspend User" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-lock"></i> Suspend</a> | <a href="" title="Delete User" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-trash-o"></i> Delete</a> | <a href="" title="Message User" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-envelope"></i> Message</a></div></td>
           </tr>
           <?php }?>
           </tbody>
          </table>
  		</div>  
     </div> 
<div style="clear:both"></div>
     </div>
     </div><!--end of dash_cont_stat-->
     </div><!-- End of main_content-->
    </div> <!-- End of the container-->
<?php include_once'footer.php';?>