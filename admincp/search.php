<?php
/*******************************************************
 *   Copyright (C) 2014  http://isvipi.com

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License along
    with this program; if not, write to the Free Software Foundation, Inc.,
    51 Franklin Street, Fifth Floor, Boston, MA 02110-1301 USA.
 ******************************************************/ 
$type = $ACTION[2];
if (empty($type)) {
		$_SESSION['err'] =E_WRONG_SEARCH_TYPE;
		header ('location:'.ISVIPI_URL.'home');
		exit();
		}
$term = $ACTION[3];
	if (empty($term)) {
		$_SESSION['err'] = E_EMPTY_SEARCH_TERM;
		header ('location:'.ISVIPI_URL.'home');
		exit();
		}
		if ($type == 'username'){
			$term = str_replace('%', '', $term);
			if (!preg_match('/^[a-zA-Z0-9_]{1,60}$/', $term)){
			$_SESSION['err'] =E_INVALID_CHAR_USERNAME;
			header ('location:'.ISVIPI_URL.$adminPath.'/members/');
			exit();
			}
			
		} else if ($type == 'id'){
			if (!is_numeric($term)){
			$_SESSION['err'] =E_INVALID_CHAR_ID;
			header ('location:'.ISVIPI_URL.$adminPath.'/members/');
			exit();
			}
		} else if ($type == 'email'){
			if (!filter_var($term, FILTER_VALIDATE_EMAIL)){
			$_SESSION['err'] =E_INVALID_EMAIL;
			header ('location:'.ISVIPI_URL.$adminPath.'/members/');
			exit();
			}
		}
include_once'header.php';
include_once'sidebar.php';
findUsersAdmin($type,$term);
?>
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
        <?php echo SEARCH_FOR ?> <strong><?php echo $term?></strong>
        </div>
          <table class="table table-bordered">
          <?php if($ResulT >0){?>
          <colgroup>
          <?php if ($type == "id"){echo  "<col style='background-color:#D6FFC1'>";} else {echo  "<col style='background-color:white'>";}?>
          <?php if ($type == "username"){echo  "<col style='background-color:#D6FFC1'>";} else {echo  "<col style='background-color:white'>";}?>
          <?php if ($type == "email"){echo  "<col style='background-color:#D6FFC1'>";} else {echo  "<col style='background-color:white'>";}?>
          </colgroup>
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
           <tr>
           <td><?php echo $ID ?></td>
           <td><a href="<?php echo ISVIPI_URL.'profile/'; echo $username;?>" data-toggle="tooltip" data-placement="bottom" title="<?php echo VIEW ?> <?php echo $username ?>'s <?php echo PROFILE ?>" target="_blank"><?php echo $username ?> </a><?php if (isOnlineNOW($ID)){?><span class="green" style="font-size:12px; margin-left:10px"><i class="fa fa-circle"></i></span><?php } else {?><span class="red" style="font-size:12px; margin-left:10px"><i class="fa fa-circle"></i></span><?php }?></td>
           <td><?php echo $email ?></td>
           <td><?php if ($status==0){echo "<i class='fa fa-times'></i> ".UNVALIDATED."";}else if ($status==1){echo "<i class='fa fa-check'></i> ".ACTIVE."";}else if ($status==3){echo "<i class='fa fa-lock'></i> ".SUSPENDED."";}?></td>
           <td><div class="user_manage_options"><a href="<?php echo ISVIPI_URL.'admin/edit_member/'; echo $username;?>" title="<?php echo EDIT ?> <?php echo $username ?>" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-pencil"></i> <?php echo EDIT ?></a> | <?php if($filter==3 || $status==3){?><a href="<?php echo ISVIPI_URL.'conf/usersManage/3/'.$ID.'' ?>" title="<?php echo UNSUSPEND ?> <?php echo $username ?>" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-unlock"></i> <?php echo UNSUSPEND ?></a><?php } else if ($status==0){?> <a href='<?php echo ISVIPI_URL.'conf/usersManage/1/'.$ID.'' ?>' title='<?php echo VALIDATE ?> <?php echo $username ?>' data-toggle='tooltip' data-placement='bottom'><?php echo VALIDATE ?></a><?php } else {?><a href="<?php echo ISVIPI_URL.'conf/usersManage/2/'.$ID.'' ?>" title="<?php echo SUSPEND ?> <?php echo $username ?>" data-toggle="tooltip" data-placement="bottom"><i class="fa fa-lock"></i> <?php echo SUSPEND ?></a><?php }?> | <a href="<?php echo ISVIPI_URL.'conf/usersManage/4/'.$ID.'' ?>" id="focus" title="<?php echo DELETE ?> <?php echo $username ?>" data-toggle="tooltip" data-placement="bottom" onclick="return confirm('<?php echo DELETE_PROMPT ?>')"><i class="fa fa-trash-o"></i> <?php echo DELETE ?></a> </td>
           </tr>
           </tbody>
           <?php } else {?>
           <tr>
           <td height="60"><?php echo NO_SUCH_USER ?></td>
           </tr>
           <?php }?>
          </table>
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
<?php include_once'footer.php';?>