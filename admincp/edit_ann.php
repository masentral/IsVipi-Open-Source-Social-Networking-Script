<?php
if (!isset($ACTION[2])){
	die404();
}
$annID = $ACTION[2];
$annID = decrypt_str($annID);
$annID = preg_replace('/[^0-9]/','',$annID);
include_once'header.php';
include_once'sidebar.php'?>
    <!-- Start of the container-->
    
    <div class="container-admin">
      <div class="page-header">
		<ul class="breadcrumb breadcrumb-admin">
  			<li><i class="fa fa-home"></i> Home</li>
  			<li class="active">Edit Page</li>
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
     <?php getEditAnn($annID)?>
     	<div class="panel panel-default">
    	<div class="panel-heading">
        <strong>Edit Page</strong>
        </div>
          <form method="post" action="<?php echo ISVIPI_URL.'conf/annManage/' ?>" class="edit_page">
          <input type="hidden" name="ann" value="edit">
          <input type="hidden" name="annID" value="<?php echo $annID?>">
          <table width="600">
           <tbody>
           <tr>
           <td style="padding:10px;">Title: <input type="text" class="form-control" name="a_subject" value="<?php echo $a_subject?>"></td>
           </tr>
           <tr>
           <td width="450" style="padding:10px">Content: <textarea class="form-control" name="a_content" rows="8" required="required"><?php echo $a_content?></textarea></td>
           </tr>
           <tr>
           <td>
           <?php 
		   $sub = str_replace(" ", "_", $a_subject);
		   ?>
           <button type="submit" class="btn btn-primary" style="margin-left:10px">Update Page</button> <a href="<?php echo ISVIPI_URL.'p/'.$sub.'-p'.$annID.'#.'.rand(0, 9999) ?>" target="_blank"><span class="label label-info" style="padding:5px; margin-left:10px">View Announcement</span></a>
           <a href="<?php echo ISVIPI_URL.'admin/dashboard/'?>"><button type="button" class="btn btn-default" style="margin-left:10px">Back to Announcements</button></a>
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