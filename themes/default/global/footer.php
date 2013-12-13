<div class="row">
    <div class="footer">
     <p>&copy; <?php echo date("Y"); ?> <a href="http://isvipi.com" target="_blank">IsVipi.com - Open Source Social Networking Script</a></p>
    </div>
</div><!--end of row-->
            
   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
   <script type="text/javascript" src="http://code.jquery.com/jquery-2.0.3.min.js"></script>
   <!-- Include all compiled plugins (below), or include individual files as needed -->
   <script type="text/javascript" src="<?php echo ISVIPI_THEME_URL; ?><?php echo $theme; ?>/js/bootstrap.min.js"></script>
   <script type="text/javascript" src="<?php echo ISVIPI_THEME_URL; ?><?php echo $theme; ?>/js/twitter-bootstrap-hover-dropdown.min.js"></script>
        <script type="text/javascript" src="<?php echo ISVIPI_THEME_URL; ?><?php echo $theme; ?>/vendors/easypiechart/jquery.easy-pie-chart.js"></script>

     <script type="text/javascript">
        $(function() {
           // Easy pie charts
            $('.easyPieChart').easyPieChart({animate: 1000});
            });
     </script>
    </body>
</html>