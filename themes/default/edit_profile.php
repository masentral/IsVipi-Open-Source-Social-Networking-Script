                  <!--========SIDEBAR MENU=====---->
                    <?php include ISVIPI_THEMES_BASE.'/global/sidebar_menu.php';?>
                    
                  <!--========/SIDEBAR MENU=====---->
                  <!--========EDIT PROFILE=====---->
                       <div class="dash_content">
                        <div class="panel panel-primary">
                          <div class="panel-heading">My Profile</div>
                               <div class="panel-body">
                              
                               <ul class="nav nav-tabs" id="myTab" >
                                  <li class="active"><a href="#details" data-toggle="tab">Personal Details</a></li>
                                  <li><a href="#password" data-toggle="tab">Change Password</a></li>
                                  <li class="disabled"><a href="#settings">Account Settings</a></li>
                               </ul>
                                <div id='content' class="tab-content">
                                  <div class="tab-pane active" id="details">
                                   <div class="edit_profile_i">
                                        <form class="c_prof" action="<?php echo ISVIPI_USER_INC_URL. 'users.process.php'?>" method="POST">
                                        <input type="hidden" name="op" value="p_details">
                                        <input type="hidden" name="user" value="<?php echo $username?>">
                                        <input type="hidden" name="userid" value="<?php echo $user?>">
                                             <div class="form-group">
                                             <input type="email" class="form-control" name="email" value="<?php echo htmlspecialchars($email, ENT_QUOTES, 'utf-8');?>" placeholder="Email" disabled>
                                             <p class="edit_prof_hints"><span class="label label-warning">You cannot change your email</span></p>
                                             </div>
                                             <div class="form-group">
                                             <input type="text" class="form-control" value="<?php echo htmlspecialchars($d_name, ENT_QUOTES, 'utf-8');?>" name="display_name" placeholder="Display Name">
                                             <p class="edit_prof_hints"><span class="label label-info">Will be displayed to your visitors</span></p>
                                             </div>
                                             <div class="form-group">
                                             <select name="user_gender" class="form-control">
                                                  <option <?php if(htmlspecialchars($gender, ENT_QUOTES, 'utf-8') == "Male"){echo("selected");}?>>Male</option>
                                                  <option <?php if(htmlspecialchars($gender, ENT_QUOTES, 'utf-8') == "Female"){echo("selected");}?>>Female</option>
                                                </select>
                                            <p class="edit_prof_hints"><span class="label label-info">Select your gender</span></p>
                                            </div>
                                             <div class="form-group">
                                             <input type="text" name="dob" class="form-control tcal" size="1" value="<?php echo htmlspecialchars($dob, ENT_QUOTES, 'utf-8');?>" />
                                             <p class="edit_prof_hints"><span class="label label-info">Select your date of birth</span></p>
                                             </div>
                                             <div class="form-group">
                                             <input type="text" name="phone" class="form-control" value="<?php echo htmlspecialchars($phone, ENT_QUOTES, 'utf-8');?>" />
                                             <p class="edit_prof_hints"><span class="label label-info">Provide your phone number</span></p>
                                             </div>
                                             <div class="form-group">
                                             <input type="text" class="form-control" name="city" placeholder="City" value="<?php echo htmlspecialchars($city, ENT_QUOTES, 'utf-8');?>">
                                             <p class="edit_prof_hints"><span class="label label-info">Your current city</span></p>
                                             </div>
                                             <div class="form-group">
                                             <input type="text" class="form-control" name="country" value="<?php echo htmlspecialchars($country, ENT_QUOTES, 'utf-8');?>" placeholder="Country">
                                             <p class="edit_prof_hints"><span class="label label-info">Your current country</span></p>
                                             </div>
                                       		 <button type="submit" class="btn btn-primary">Update Profile</button>
                                       </form>
                                   </div>

                                  </div>
                                  <div class="tab-pane" id="password">
                                   <div class="edit_profile_i">
                                    <ul>
                                        <form class="c_pass" action="<?php echo ISVIPI_USER_INC_URL. 'users.process.php'?>" method="POST">
                                        <input type="hidden" name="op" value="change">
                                        <input type="hidden" name="user" value="<?php echo $username?>">
                                             <div class="form-group">
                                             <input type="password" class="form-control" name="newpass" placeholder="New password">
                                             <p class="edit_prof_hints"><span class="label label-info">New Password</span></p>
                                             </div>
                                             <div class="form-group">
                                             <input type="password" class="form-control" name="newpass2" placeholder="Repeat new password">
                                             <p class="edit_prof_hints"><span class="label label-info">Repeat New Password</span></p>
                                             </div>
                                       		 <button type="submit" class="btn btn-primary">Change Password</button>
                                       </form>
                                    </ul>
                                   </div>
                                  </div>
                                  <div class="tab-pane" id="settings">

                                  </div>
    							</div>    
							  </div>
                          </div><!--end of panel-->
                        </div><!--end of dash_content-->
                  <!--========/EDIT PROFILE=====---->
                  <!--========ANNOUNCEMENTS=====---->
                    <?php include ISVIPI_THEMES_BASE.'/global/announcements.php';?> 
                  <!--========/ANNOUNCEMENTS=====---->
