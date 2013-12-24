                  
                  <!--========HEADER=====---->
                    <?php include ISVIPI_THEMES_BASE.'global/header.php';?>
                  <!--========/HEADER=====---->
        
                  <!--========SIDEBAR MENU=====---->
                    <?php include ISVIPI_THEMES_BASE.'global/sidebar_menu.php';?>
                  <!--========/SIDEBAR MENU=====---->
                  
                  <!--========MY PROFILE=====---->
                  <div class="col-md-6">
                  <div class="row">
                   <div class="panel panel-default tabless-panel timeline-layout">
                     <div class="panel-heading">
                      <div class="text-muted isvipi-title">My Profile
                       <a href="" title="Edit Profile"><div class="profile_options"><i class="fa fa-cogs"></i> </div></a>
                       <div class="user_minor_details">Date of Reg: <b><?=$getuser[0]['reg_date'];?></b></div>
                      </div>
                    </div>
                    <div class="isvipi-panel-content tabless-panel-content collapse in">
                  <div class="profile_image"><img src="<?=$getuser[0]['thumb_path'];?>" height="100%" width="100%" alt="" /></div>
                  <div class="profile_info">
                  <div class="isvipi-panel-content">
                                    <table class="table table-striped">
                                        <tbody>
                                            <tr>
                                                <td><b>Username</b></td>
                                                <td><b>:</b></td>
                                                <td><?=$getuser[0]['username'];?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Email</b></td>
                                                <td><b>:</b></td>
                                                <td><?=$getuser[0]['email'];?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Phone No.</b></td>
                                                <td><b>:</b></td>
                                                <td>+<?=$getuser[0]['dialing_code'];?>-<?=$getuser[0]['phone'];?></td>
                                            </tr>
                                            <tr>
                                                <td><b>Location</b></td>
                                                <td><b>:</b></td>
                                                <td><?=$getuser[0]['city'];?>, <?=$getuser[0]['country'];?></td>
                                            </tr>
                                            <tr>
                                                <td><b>User Type</b></td>
                                                <td><b>:</b></td>
                                                <td>Member</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div><!--end of isvipi-panel-content-->
                                <div class="profile_options_bar">
                                 <div class="upload_pic"><button class="btn btn-primary" data-toggle="modal" data-target="#picUpload">Upload Profile Pic</button></div>
                                </div>
                                <!-- Button trigger modal -->
          
                             </div><!--end of profile_info-->
              </div><!--End of isvipi-panel-content-->
          </div><!--End of panel-->

          <!----------------------------------------------------------------
          --------------------UPLOAD PROFILE PIC MODAL----------------------------
          ------------------------------------------------------------------>
          <!-- Modal -->
          <div class="modal fade" id="picUpload" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
           <div class="modal-dialog">
            <div class="modal-content">
             <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
               <h4 class="modal-title" id="myModalLabel">Upload Profile Picture</h4>
            </div>
            <div class="modal-body">
            <div class="form-group">
            <form name="addphoto" method="post" enctype="multipart/form-data" action="process_photo.php">
             <input type="hidden" name="addphoto" value="1" />
             <input type="hidden" name="id" value="<?= $getuser[0]['id'];?>" />
              <label class="col-lg-4 control-label" for="fileInput">File input</label>
                <div class="col-lg-10">
               <input class="form-control uniform_on" id="fileInput" type="file" name="picture" size="30">
               <input type="hidden" name="max" value="300000" />
                </div>
             </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary" name="submit"/>Upload</button>
            </form>
            </div>
          </div><!-- /.modal-content -->
       </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
              <!--========/MY PROFILE=====---->
                        
                  <!--========ANNOUNCEMENTS=====---->
                    <?php include ISVIPI_THEMES_BASE.'global/announcements.php';?> 
                  <!--========/ANNOUNCEMENTS=====---->
                  <!--========FOOTER=====---->
                    <?php include ISVIPI_THEMES_BASE.'global/footer.php';?> 
                  <!--========/FOOTER=====---->
