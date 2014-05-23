<?php get_home_header()?>
<link rel="stylesheet" href="http://code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
<div class="home_log_content">
    <div class="home_login_welcome">
        <div class="home_register">
      <form method="post" action="<?php echo ISVIPI_USER_PROCESS; ?>" class="login-form">
        <input type="hidden" name="op" value="login">
      <h3><?php echo LOG_IN ?></h3>
      <div class="form-group">
        <input type="email" class="form-control" name="email" placeholder="<?php echo ENTER_EMAIL ?>" required>
      </div>
      <div class="form-group">
        <input type="password" class="form-control" name="pass" placeholder="<?php echo PASSWORD ?>" required>
      </div>
        <button class="btn btn-lg btn-primary" type="submit"><?php echo SIGN_IN ?></button>
     <span style="margin-left:50px"><a href="<?php echo ISVIPI_URL.'auth/forgot_password' ?>"><?php echo FORGOT_PASSWORD ?></a></span>
     </form>
     
     </div>
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
        <input class="form-control" type="password" name="pass2" placeholder="<?php echo REPEAT_PASSWORD ?>" required="required">
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
        <button class="btn btn-lg btn-primary" type="submit"><?php echo REGISTER ?></button>
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