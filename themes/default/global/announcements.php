                        <!--Announcements-->
                        <?php getAnnouncements();
						global $getAnn;
						global $ann_id;
						global $ann_date;
						global $ann_subject;
						global $ann_content;
						?>
                        <div class="dash_announce">
                        <div class="panel panel-primary">
                          <div class="panel-heading">Announcements</div>
                               <div class="panel-body">
                                 <div class="ann">
                               <?php while ($getAnn->fetch() )
								{
							$subject = trunc_text($ann_subject, 5);
						    $announc = trunc_text($ann_content, 20);
									?>
                                <span class="ann_date"><?php echo $ann_date ?></span>
                                <?php
								$sub = str_replace(" ", "_", $subject);
								?>
                                <p class="ann_title"><a href="<?php echo ISVIPI_URL.'p/'.$sub.'-p'.$ann_id.'#.'.rand(0, 9999) ?>"><?php echo $subject ?></a></p>
                                <span class="ann_content">
								<?php echo makeLinks($announc)?>
								<?php //echo $announc ?></span>
                                <hr />
                                <?php }?>
                                <?php if ($getAnn->num_rows <1){?>
                                <p>There are no announcements</p>
                                <?php }?>
                                </div>
                               </div>
                          </div><!--end of panel-->
                        </div><!--end of dash_announce-->
                     </div><!--End of row-->
                </div><!--End of row-->
            </div><!--end of container-->

