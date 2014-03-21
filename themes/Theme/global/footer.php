<div class="row">
    <div class="footer">
     <p>Copyright &copy;. <?php echo date("Y"); ?>. This site is proudly powered by <a href="http://isvipi.com" target="_blank">IsVipi Open Source Social Networking Script</a></p>
    </div>
</div><!--end of row-->
     
   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
  
   <!-- Include all compiled plugins (below), or include individual files as needed -->
   <script type="text/javascript" src="<?php echo ISVIPI_STYLE_URL; ?>js/bootstrap.min.js"></script>
   <script type="text/javascript" src="<?php echo ISVIPI_STYLE_URL; ?>js/alertify.min.js"></script>
   <script type="text/javascript" src="<?php echo ISVIPI_STYLE_URL; ?>js/idle.min.js"></script>
   <script type="text/javascript">
setIdleTimeout(1800000);
document.onIdle = function() {window.location = "<?php echo ISVIPI_URL. 'session_expire'?>";}
</script>
       </body>
</html>