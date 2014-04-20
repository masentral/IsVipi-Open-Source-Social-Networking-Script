<?php get_home_header();?>
                       <div class="pages">
                        <div class="panel panel-primary">
                               <div class="panel-body">
                                <h2><?php echo $titleSplit ?></h2>
                                <hr />
                                <?php
								$content = ParText($content);
								?>
                                <p><?php echo makeLinks($content) ?></p>
								</div>
                               </div>
                          </div><!--end of panel-->
                        </div><!--end of dash_content-->
<?php get_home_footer()?>