<div class="row">
    <div class="index-footer">
    <div class="footer_menu_index">
     <?php getAllPagesFront(); global $getAllP;global $p_title; global $p_id?>
     <?php while($getAllP->fetch()){
     $sub = str_replace(" ", "_", $p_title);?>
    <li><a href="<?php echo ISVIPI_URL.'p/'.$sub.'-p'.$p_id.'#.'.rand(0, 9999) ?>"><?php echo $p_title ?></a> </li>
	<?php }?>
    </div>
     <p><?php footer_text()?></p>
    </div>
</div><!--end of row-->
   <script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
   <script type="text/javascript" src="<?php echo ISVIPI_STYLE_URL; ?>js/bootstrap.min.js"></script>
   <script type="text/javascript" src="<?php echo ISVIPI_STYLE_URL; ?>js/alertify.min.js"></script>
    </body>
</html>