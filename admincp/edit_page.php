<?php
if (!isset($ACTION[2])){
	die404();
}
$pid = $ACTION[2];
$pid = decrypt_str($pid);
$pid = preg_replace('/[^0-9]/','',$pid);
include_once'header.php';
include_once'sidebar.php'?>
    <!-- Start of the container-->
    
    <div class="container-admin">
      <div class="page-header">
		<ul class="breadcrumb breadcrumb-admin">
  			<li><i class="fa fa-home"></i> <?php echo HOME ?></li>
  			<li class="active"><?php echo EDIT_PAGE ?></li>
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
     <?php getEditpage($pid)?>
     	<div class="panel panel-default">
    	<div class="panel-heading">
        <strong><?php echo EDIT_PAGE ?></strong>
        </div>
          <form method="post" action="<?php echo ISVIPI_URL.'conf/managePages/' ?>" class="edit_page">
          <div class='alert alert-info' style="width:580px; margin-left:10px">
          <?php echo PARAG_PROMPT ?>
          </div>
          <input type="hidden" name="page" value="Edit_Page">
          <input type="hidden" name="p_id" value="<?php echo $pid?>">
          <table width="600">
           <tbody>
           <tr>
           <td style="padding:10px;"><?php echo TITLE ?>: <input type="text" class="form-control" name="p_title" value="<?php echo $p_title?>"></td>
           </tr>
           <tr>
           <td width="450" style="padding:10px"><?php echo CONTENT ?>: <textarea class="form-control" name="p_content" rows="8" required="required"><?php echo $p_content?></textarea></td>
           </tr>
           <tr>
           <td>
           <?php 
		   $sub = str_replace(" ", "_", $p_title);
		   ?>
           <button type="submit" class="btn btn-primary" style="margin-left:10px"><?php echo UPDATE_PAGE ?></button> <a href="<?php echo ISVIPI_URL.'p/'.$sub.'-p'.$pid.'#.'.rand(0, 9999) ?>" target="_blank"><span class="label label-info" style="padding:5px; margin-left:10px"><?php echo VIEW_PAGE ?></span></a>
           <a href="<?php echo ISVIPI_URL.'admin/pages/'?>"><button type="button" class="btn btn-default" style="margin-left:10px"><?php echo BACK_TO_PAGES ?></button></a>
           </td>
           
           </tr>
           </tbody>
          </table>
          </form>
  		</div>  
<div style="clear:both"></div>
     </div>
     </div><!--end of dash_cont_stat-->
     </div><!-- End of main_content-->
    </div> <!-- End of the container-->
    
<?php include_once'footer.php';?>