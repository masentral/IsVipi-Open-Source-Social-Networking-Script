<?php
/*
Theme Name: Default
Theme URL: http://isvipi.com
Description: Default IsVipi Theme
Version: 1.0.0
Author: IsVipi
Author URL: http://isvipi.com
*/
get_home_header();
if ($sysCron=="1"){
tenMinsCron();
}
?>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<div class="home_content">
    <div class="home_welcome">
    
    <h1><?php echo MEET_NEW_PEOPLE ?></h1>
    <?php if (isset($_SESSION['succ_reg'])){?>
    <div class="alert alert-info">
    <?php getAdminGenSett(); if ($usrValid=="1"){?>
    <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
    <h3>
    <?php echo REGISTRATION_SUCCESSFULL_TEXT ?>
    <?php } else {?>
    <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
    <h3>
    <?php echo REGISTRATION_SUCCESSFULL_TEXT2 ?>
    <?php }?>
    </h3>
    </div>
    <?php unset ($_SESSION['succ_reg']);}?>
    </div>
    <div class="home_register">
      <form method="post" action="<?php echo ISVIPI_USER_PROCESS; ?>" class="login-form">
        <input type="hidden" name="op" value="new">
      <h3><?php echo CREATE_NEW_ACCOUNT ?></h3>
      <div class="form-group">
        <input class="form-control" type="text" name="user" placeholder="<?php echo USERNAME ?>" required="required">
      </div>
      <div class="form-group">
        <input class="form-control" type="text" name="d_name" placeholder="<?php echo DISPLAY_NAME ?>" required="required">
      </div>
      <div class="form-group">
        <input class="form-control" type="email" name="email" placeholder="<?php echo EMAIL ?>" required="required">
      </div>
      <div class="form-group">
        <input class="form-control" type="password" name="pass" placeholder="<?php echo PASSWORD ?>" required="required">
      </div>
      <div class="form-group">
        <input class="form-control" type="password" name="pass2" value="" placeholder="<?php echo REPEAT_PASSWORD ?>" required="required">
      </div>
      <div class="form-group">
        <select name="user_gender" class="form-control" required="required">
           <option><?php echo MALE ?></option>
           <option selected><?php echo FEMALE ?></option>
        </select>
      </div>
      <div class="form-group">
        <input class="form-control shortened" type="text" id="datepicker" name="user_dob" required="required">
        <span class="label label-info"><?php echo DOB ?></span>
      </div>
      <div class="form-group">
        <input class="form-control" type="text" name="user_city" placeholder="<?php echo CITY ?>" required="required">
      </div>
      <div class="form-group">
        <?php cSelect();?>
      </div>
      <?php getAdminGenSett(); if ($usrReg == "1"){?>
      <button class="btn btn-lg btn-primary" type="submit" disabled="disabled"><?php echo REG_DISABLED ?></button>
      <?php } else {?>
        <button class="btn btn-lg btn-primary" type="submit" ><?php echo REGISTER ?></button>
        <?php }?>
     </form>
     </div>
</div>
<?php get_home_footer()?>
<script src="http://code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
<script>
  $(function() {
    $( "#datepicker" ).datepicker();
  });
  </script>