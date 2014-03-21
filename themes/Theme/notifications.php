<?php get_header()?>
<?php get_sidebar()?>
                       <div class="dash_content">
                        <div class="panel panel-primary">
                          <div class="panel-heading">Site Notifications
                           </div>
                               <div class="panel-body members_full">
                                     <div class="m_list">
                                     <table class="table" style="width:500px">
                                        <thead>
                                            <tr>
                                                <th width="180">Date</th>
                                                <th>Notification</th>
                                            </tr>
                                        </thead>
    
                                        <tbody>
                                        </tbody>
                                       <?php getNotices($user);{
										while ($getnotice->fetch())
											{
									   ?>
                                          <tr class="warning">
                                            <td><?php echo date('d M Y \a\t g:ia', strtotime($time));?></td>
                                            
                                            <td><?php echo $notice;?></td>
                                        </tr>
                                        <?php }?>
                                        <?php }?>
                                        <?php noticeSeen($user);?>
                                        <?php if ($getnotice->num_rows()<1){?>
                                        <td colspan="3">You have no notifications</td>
                                        <?php } ?>
                                     </table>
                                  </div>
							  </div>
                          </div><!--end of panel-->
                        </div><!--end of dash_content-->
<?php get_r_sidebar()?>
<?php get_footer()?>