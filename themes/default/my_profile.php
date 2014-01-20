                  <!--========SIDEBAR MENU=====---->
                    <?php include ISVIPI_THEMES_BASE.'/global/sidebar_menu.php';?>
                  <!--========/SIDEBAR MENU=====---->
                  <!--========MY PROFILE=====---->
                       <div class="dash_content">
                        <div class="panel panel-primary">
                          <div class="panel-heading">My Profile</div>
                               <div class="panel-body">
                                 <div class="my_pic">
                                 <?php if(htmlspecialchars($thumbnail, ENT_QUOTES, 'utf-8') == ""){$thumbnail="no-image.gif";}?>
                                 <img src="<?php echo ISVIPI_MEMBER_URL.'pics/'.htmlspecialchars($thumbnail, ENT_QUOTES, 'utf-8');?>" height="100%" width="100%" alt="" />
                                 </div>
                                 <div class="my_details">
                                  <table class="table table-bordered">
                                    <tbody>
                                      <tr>
                                        <td>Profile Name</td>
                                        <td><?php echo htmlspecialchars($d_name, ENT_QUOTES, 'utf-8');?></td>
                                      </tr>
                                      <!--<tr>
                                        <td>E-mail</td>
                                        <td></td>
                                      </tr>-->
                                      <tr>
                                        <td>Gender</td>
                                        <td><?php echo htmlspecialchars($gender, ENT_QUOTES, 'utf-8');?></td>
                                      </tr>
                                      <tr>
                                        <td>D.O.B</td>
                                        <td><?php echo htmlspecialchars($dob, ENT_QUOTES, 'utf-8');?></td>
                                      </tr>
                                      <!--<tr>
                                        <td>Phone</td>
                                        <td><?php echo htmlspecialchars($phone, ENT_QUOTES, 'utf-8');?></td>
                                      </tr>-->
                                      <tr>
                                        <td>Location</td>
                                        <td><?php echo htmlspecialchars($city, ENT_QUOTES, 'utf-8');?>, <?php echo htmlspecialchars($country, ENT_QUOTES, 'utf-8');?></td>
                                      </tr>
                                    </tbody>
                                  </table>
                                  <div class="profile_edit">
                                 <a href="edit_profile.php" class="btn btn-info" role="button">Edit my Profile</a>
                                 <!--<a class="btn btn-danger pull-right" role="button">Delete my Account</a>-->
                                 </div>
                                 </div>
                                 <div class="profile_options">
                                 <button class="btn btn-primary" data-toggle="modal" data-target="#profilePic">Upload Profile Pic</button>
                                 </div>
                               </div>
                          </div><!--end of panel-->
                        </div><!--end of dash_content-->
                  <!--========/MY PROFILE=====---->
                  <!--========ANNOUNCEMENTS=====---->
                    <?php include ISVIPI_THEMES_BASE.'/global/announcements.php';?> 
                  <!--========/ANNOUNCEMENTS=====---->
                 
                 <!--=========PROFILE PIC MODAL===========--->
                 <!-- Modal -->
                <div class="modal fade" id="profilePic" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">  
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel">Upload Profile Pic</h4>
                      </div>
                      <div class="modal-body">
                       <form action="<?php echo ISVIPI_USER_INC_URL. 'users.profilepic.php'?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="op" value="newpic">
                        <input type="hidden" name="userid" value="<?php echo $user?>">
                        <label for="file">Filename:</label>
                        <input type="file" class="form-control" name="file"><br>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" name="submit"/>Upload</button>
                        </form>
                      </div>
                    </div><!-- /.modal-content -->
                  </div><!-- /.modal-dialog -->
                </div><!-- /.modal -->
                