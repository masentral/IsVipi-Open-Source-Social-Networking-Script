<?php include_once'header.php';?>
<?php include_once'sidebar.php';?>
    <!-- Start of the container-->
    <div class="container-admin">
      <div class="page-header">
		<ul class="breadcrumb breadcrumb-admin">
  			<li><i class="fa fa-home"></i> <?php echo HOME ?></li>
  			<li class="active"><?php echo MEMBER_MGMT ?></li>
            <span class="donate_support"><span class="label label-danger"><?php echo DONATE ?></span></span>
        <div class="donate">
        <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=8EKWYJABNLDE2" data-toggle="tooltip" data-placement="bottom" target="_blank" title="<?php echo DONATE_TEXT ?>"><img src="<?php echo ISVIPI_STYLE_URL.'images/donate.png';?>" width="100%" alt="" /></a>
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
        <?php 
		getMembersAll();{ $AllMCount = $Allcount;}
		getUnValMembers(); { $UnValMCount = $un_count;}
		getSusMembers(); {$SusMAccnts = $sus_count;}
		?>
          <li <?php if($filter=="5"){echo 'class="active"';}?>><a href="<?php echo ISVIPI_URL."admin/members"?>"><?php echo ALL ?> (<?php echo $AllMCount?>)</a></li>
<li <?php if($filter=="1"){echo 'class="active"';}?>><a href="<?php echo ISVIPI_URL."admin/members?pager=0"?>&filter=1"><?php echo ACTIVE ?> (<?php echo $AllMCount - ($UnValMCount + $SusMAccnts)?>)</a></li>
<li <?php if($filter=="0"){echo 'class="active"';}?>><a href="<?php echo ISVIPI_URL."admin/members?pager=0"?>&filter=0"><?php echo UNVALIDATED ?> (<?php echo $UnValMCount?>)</a></li>
<li <?php if($filter=="3"){echo 'class="active"';}?>><a href="<?php echo ISVIPI_URL."admin/members?pager=0"?>&filter=3"><?php echo SUSPENDED ?> (<?php echo $SusMAccnts?>)</a></li>
	   </ul>
       <ul class="nav nav-pills pull-right">
       <li class='active'><a href="<?php echo ISVIPI_URL.'admin/add_new' ?>" class="btn btn-info"><?php echo ADD_NEW_USER ?></a>
       
       </li>
       </ul>
       <div style="clear:both"></div>
       
        </div>
          <table class="table table-bordered">
          <thead>
          <tr>
           <th width="80"><?php echo USER_ID ?></th>
           <th width="180"><?php echo USERNAME ?></th>
           <th width="200"><?php echo EMAIL ?></th>
           <th width="120"><?php echo STATUS ?></th>
           <th><?php echo MANAGE ?></th>
           </tr>
           </thead>
           <tbody>
           <?php while ($getmembersAll2->fetch() )
			{?>
           <tr>
           <td><?php echo $id ?></td>
           <td><a href="<?php echo ISVIPI_URL.'profile/'; echo $profile_name;?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo VIEW ?> <?php echo $profile_name ?>'s <?php echo PROFILE ?>" target="_blank"><?php echo $profile_name ?> </a><?php if (isOnlineNOW($id)){?><span class="green" style="font-size:12px; margin-left:10px"><i class="fa fa-circle"></i></span><?php } else {?><span class="red" style="font-size:12px; margin-left:10px"><i class="fa fa-circle"></i></span><?php }?></td>
           <td><?php echo $email ?></td>
           <td><?php if ($status==0){echo "<i class='fa fa-times'></i> ".UNVALIDATED."";}else if ($status==1){echo "<i class='fa fa-check'></i> ".ACTIVE."";}else if ($status==3){echo "<i class='fa fa-lock'></i> ".SUSPENDED."";}?></td>
           
           
           <td><div class="user_manage_options"><a href="<?php echo ISVIPI_URL.'admin/edit_member/'; echo $profile_name;?>" title="<?php echo EDIT ?> <?php echo $profile_name ?>" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-pencil"></i> <?php echo EDIT ?></a> | <?php if($filter==3 || $status==3){?><a href="<?php echo ISVIPI_URL.'conf/usersManage/3/'.$id.'' ?>" title="<?php echo UNSUSPEND ?> <?php echo $profile_name ?>" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-unlock"></i> <?php echo UNSUSPEND ?></a><?php } else if ($status==0){?> <a href='<?php echo ISVIPI_URL.'conf/usersManage/1/'.$id.'' ?>' title='<?php echo VALIDATE ?> <?php echo $profile_name ?>' data-toggle='tooltip' data-placement='bottom'><?php echo VALIDATE ?></a><?php } else {?><a href="<?php echo ISVIPI_URL.'conf/usersManage/2/'.$id.'' ?>" title="<?php echo SUSPEND ?> <?php echo $profile_name ?>" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-lock"></i> <?php echo SUSPEND ?></a><?php }?> | <a href="<?php echo ISVIPI_URL.'conf/usersManage/4/'.$id.'' ?>" id="focus" title="<?php echo DELETE ?> <?php echo $profile_name ?>" data-toggle="tooltip" data-placement="bottom" onclick="return confirm('<?php echo DELETE_PROMPT ?>')"><i class="fa fa-trash-o"></i> <?php echo DELETE ?></a> </td>
           </tr>
           <?php }?>
           </tbody>
          </table>
          <div class="pagination_options">
          <?php getMembersAll(); if($Allcount > $p_limit && $filter=="5"){?>
          <ul class="pagination upped pull-left">
              <li <?php if ($pager=="0"){echo "class='disabled'";}?>><a href="<?php echo ISVIPI_URL."admin/members"?>" title="<?php echo GO_TO_FIRST ?>" data-toggle="tooltip" data-placement="bottom">&laquo;&laquo;</a></li>
              <li <?php if ($pager=="0"){echo "class='disabled'";}?>><a href="<?php echo ISVIPI_URL."admin/members?pager=".($pager-$p_limit)?>" title="<?php echo BACK ?>" data-toggle="tooltip" data-placement="bottom"><?php echo BACK ?></a></li>
              <li <?php if ($pager>=$Allcount - $p_limit){echo "class='disabled'";}?>><a href="<?php echo ISVIPI_URL."admin/members?pager=".($pager+$p_limit)?>&filter=<?php $filter ?>" title="<?php echo NEXT ?>" data-toggle="tooltip" data-placement="bottom"><?php echo NEXT ?></a></li>
              <li <?php if ($pager>=$Allcount - $p_limit){echo "class='disabled'";}?>><a href="<?php echo ISVIPI_URL."admin/members?pager=".($Allcount-$p_limit)?>&filter=<?php $filter ?>" title="<?php echo GO_TO_LAST ?>" data-toggle="tooltip" data-placement="bottom">&raquo;&raquo;</a></li>
		</ul>
        <?php } ?>
        <div class="member_manage_options">
        <a href="<?php echo ISVIPI_URL.'conf/usersManage/s_All/' ?>" class="btn btn-info" onclick="return confirm('<?php echo SUS_ALL_PROMPT ?>')"><?php echo SUS_ALL ?></a>
        <a href="<?php echo ISVIPI_URL.'conf/usersManage/uns_All/' ?>" class="btn btn-info" onclick="return confirm('<?php echo UNSUS_ALL_PROMPT ?>')"><?php echo UNSUS_ALL ?></a>
        <a href="<?php echo ISVIPI_URL.'conf/usersManage/del_unv_All/' ?>" class="btn btn-danger" onclick="return confirm('<?php echo DEL_ALL_UNVAL_PROMPT ?>')"><?php echo DEL_ALL_UNVAL ?></a>
        <a href="<?php echo ISVIPI_URL.'conf/usersManage/del_sus_All/' ?>" onclick="return confirm('<?php echo DEL_ALL_SUS_PROMPT ?>')" class="btn btn-danger"><?php echo DEL_ALL_SUS ?></a>
          </div>
          </div>
          <div class="panel-heading">
          <div style="width:500px">
          <form name="search" method="post" action="<?php echo ISVIPI_URL.'conf/search/' ?>">
                      <input type="hidden" name="search" value="search">
                        <div class="input-group">
                          <input type="text" class="form-control" name="searchTerm" value="" placeholder="<?php echo SEARCH_ADMIN_PLACEHOLDER ?>">
                          <span class="input-group-btn">
                            <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
                          </span>
                        </div><!-- /input-group -->
        				<input type="radio" name="type" value="username" checked="checked"> <?php echo BY_USERNAME ?> &nbsp;&nbsp;
                        <input type="radio" name="type" value="id"> <?php echo BY_ID ?> &nbsp;&nbsp;
                        <input type="radio" name="type" value="email"> <?php echo BY_EMAIL ?>
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