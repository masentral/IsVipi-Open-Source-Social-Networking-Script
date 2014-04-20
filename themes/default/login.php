<?php get_home_header()?>
<link href="<?php echo ISVIPI_STYLE_URL ?>css/tcal.css" rel="stylesheet" type="text/css" />
<div class="home_log_content">
    <div class="home_login_welcome">
        <div class="home_register">
      <form method="post" action="<?php echo ISVIPI_USER_PROCESS; ?>" class="login-form">
        <input type="hidden" name="op" value="login">
      <h3>Log In</h3>
      <div class="form-group">
        <input type="email" class="form-control" name="email" placeholder="Enter Email" required>
      </div>
      <div class="form-group">
        <input type="password" class="form-control" name="pass" placeholder="Password" required>
      </div>
        <button class="btn btn-lg btn-primary" type="submit">Login</button>
     <span style="margin-left:50px"><a href="<?php echo ISVIPI_URL.'auth/forgot_password' ?>">Forgot Password</a></span>
     </form>
     
     </div>
    </div>
    <div class="home_register">
      <form method="post" action="<?php echo ISVIPI_USER_PROCESS; ?>" class="login-form">
        <input type="hidden" name="op" value="new">
      <h3>Create New Account</h3>
      <div class="form-group">
        <input class="form-control" type="text" name="user" placeholder="Username" onclick="this.value='';" required="required">
      </div>
      <div class="form-group">
        <input class="form-control" type="text" name="d_name" placeholder="Display Name" onclick="this.value='';" required="required">
      </div>
      <div class="form-group">
        <input class="form-control" type="email" name="email" placeholder="Email" onclick="this.value='';" required="required">
      </div>
      <div class="form-group">
        <input class="form-control" type="password" name="pass" placeholder="Password" required="required">
      </div>
      <div class="form-group">
        <input class="form-control" type="password" name="pass2" placeholder="Repeat Password" required="required">
      </div>
      <div class="form-group">
        <select name="user_gender" class="form-control" required="required">
           <option>Male</option>
           <option selected>Female</option>
        </select>
      </div>
      <div class="form-group">
        <input class="tcal shortened" type="text" name="user_dob" placeholder="Date of Birth" required="required">
        <span class="label label-info">Date of Birth</span>
      </div>
      <div class="form-group">
        <input class="form-control" type="text" name="user_city" placeholder="City" onclick="this.value='';" required="required">
      </div>
      <div class="form-group">
        <input class="form-control" type="text" name="user_country" placeholder="Country" onclick="this.value='';" required="required">
      </div>
        <button class="btn btn-lg btn-primary" type="submit">Register</button>
     </form>
     </div>
</div>
<?php get_home_footer()?>