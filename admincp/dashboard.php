<?php include_once'header.php';?>
<?php include_once'sidebar.php';?>
    <!-- Start of the container-->
    <div class="container-admin">
      <div class="page-header">
		<ul class="breadcrumb breadcrumb-admin">
  			<li><i class="fa fa-home"></i> Home</li>
  			<li class="active">Dashboard</li>
            <span class="donate_support"><span class="label label-danger">Support IsVipi, Donate!</span></span>
        <div class="donate">
        <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=8EKWYJABNLDE2" data-toggle="tooltip" data-placement="bottom" target="_blank" title="Support us by making a donation"><img src="<?php echo ISVIPI_STYLE_URL.'images/donate.png';?>" width="100%" alt="" /></a>
        </div>
        </ul>
     </div>
     <!-- Start of main_content-->
     <div class="main_content">
     <div class="padded_content">
     <center>
     <!--New Members-->
     <a href="<?php echo ISVIPI_URL.'admin/members' ?>"><div class="col-md-3 col-md-3-1">
     <span class="dash_stat white"><center><?php getNewMembersAll(); echo $n_count?></center></span>
     <hr>
     <span class="dash_stat_txt blue"><center>New Members Today</center></span>
     </div></a>
     <!--Online members-->
     <a href="<?php echo ISVIPI_URL.'admin/members' ?>"><div class="col-md-3 col-md-3-1 col-md-3-3">
     <span class="dash_stat green"><center><?php getOnlineMembers(); echo $o_count?></center></span>
     <hr>
     <span class="dash_stat_txt blue"><center>Members Online</center></span>
     </div></a>
     <!--Unvalidated accounts-->
     <a href="<?php echo ISVIPI_URL.'admin/members' ?>"><div class="col-md-3 col-md-3-3">
     <span class="dash_stat red"><center><?php getUnValMembers(); echo $un_count?></center></span>
     <hr>
     <span class="dash_stat_txt black"><center>Unvalidated Accounts</center></span>
     </div></a>
     <!--Total Registered Members-->
     <a href="<?php echo ISVIPI_URL.'admin/members' ?>"><div class="col-md-3 col-md-3-3">
     <span class="dash_stat green"><center><?php getMembersAll(); echo $Allcount?></center></span>
     <hr>
     <span class="dash_stat_txt black"><center>All Registered Members</center></span>
     </div></a>
     <div style="clear:both"></div>
     </center>
     </div><!--End of padded-content-->
     <div style="clear:both"></div>
     <div class="dash_admin_panel_cont"> <!--start of dash_cont_stat-->
       <div class="row">
     	<div class="panel panel-default midi-left">
    	<div class="panel-heading"><strong>Quick Stats </strong></div>
          <table class="table">
           <tbody>
           <tr>
           <td width="350">All Registered members</td>
           <td><strong><span class="label label-info"><?php getMembersAll();echo $Allcount?></span></strong></td>
           </tr>
           <tr>
           <tr>
           <td width="350">New members today</td>
           <td><strong><span class="label label-info"><?php getNewMembersAll(); echo $n_count?></span></strong></td>
           </tr>
           <tr>
           <td>Online members</td>
           <td><strong><span class="label label-info"><?php getOnlineMembers(); echo $o_count?></span></strong></td>
           </tr>
           <tr>
           <td>No. of unvalidated accounts</td>
           <td><strong><span class="label label-info"><?php getUnValMembers(); echo $un_count?></span></strong></td>
           </tr>
           <tr>
           <td>No. of male members</td>
           <td><strong><span class="label label-info"><?php getMaleMembers(); echo $male_count?></span></strong></td>
           </tr>
           <tr>
           <td>No. of female members</td>
           <td><strong><span class="label label-info"><?php getFemMembers(); echo $fem_count?></span></strong></td>
           </tr>
           </tbody>
          </table>
  		</div>  
        <div class="panel panel-default midi-left2">
    	<div class="panel-heading"><strong>5 Latest Members <a href="<?php echo ISVIPI_URL.'admin/members' ?>"><i class="fa fa-external-link"></i></a></strong></div>
          <table class="table">
          <thead>
           <tr>
           <?php getNewMembersAll2();?>
            <th width="70">User Id</th>
            <th>Username</th>
            <th>Email</th>
            </tr>
           </thead>
           <tbody>
           <?php while ($getmembers->fetch() )
			{
			getMemberDet($id);
			?> 
           <tr>
           <td><strong><?php echo $id ?></strong></td>
           <td><a href="<?php echo ISVIPI_URL.'profile/'; getUserDetails($id); echo $username;?>"><?php echo $username ?></a></td>
           <td><?php echo $email ?></td>
           </tr>
           <?php }?>
           </tbody>
          </table>
  		</div> 
     </div> 
<div style="clear:both"></div>
	<div class="row">
        <div class="panel panel-default midi-left">
    	<div class="panel-heading"><strong>Latest from IsVipi</strong> <a href="http://isvipi.com" target="_blank"><i class="fa fa-external-link"></i></a></div>
      	<div class="panel-body">
      	<?php getIsVipiFeeds(); ?>
      	</div>
  		</div> 
       <div class="panel panel-default midi-left2">
    	<div class="panel-heading"><strong>Quick Announcement</strong></div>
        <div class="admin_announcements">
        <form method="post" action="<?php echo ISVIPI_URL.'conf/adminSettings/' ?>">
        <?php $date = date('m/d/Y h:i:s a', time());?>
        <span class="announce_date"><?php echo $date ?></span>
        <div class="form-group">
        <input type="text" class="form-control" name="ann_subject" placeholder="Subject" required>
        </div>
        <div class="form-group">
        <textarea class="form-control" name="ann_cont" rows="3" placeholder="Type your announcement here..." required="required"></textarea>
        </div>
        <input type="hidden" name="action" value="new_ann">
        <input type="hidden" name="date" value="<?php echo $date ?>">
        <button class="btn btn-primary" type="submit">Publish</button>
        </form>
  		</div> 
		</div>
     </div>
     </div><!--end of dash_cont_stat-->
     </div><!-- End of main_content-->
    </div> <!-- End of the container-->
<?php include_once'footer.php';?>