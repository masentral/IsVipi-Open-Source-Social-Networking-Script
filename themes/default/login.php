<div class="home_log_content">
    

    <div class="home_login_welcome">
        <div class="home_register">
        <?php if (isset($_SESSION['succ_reg'])){?>
    <div class="alert alert-info">
    <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
    <p>
    Registration successful! An email with a validation link has been sent to the email you provided. Please follow the instructions provided to validate your account. If you fail to find the email in your inbox, please check your <strong>spam folder</strong>.
    </p>
    </div>
    <?php unset ($_SESSION['succ_reg']);}?>
      <form method="post" action="<?php echo ISVIPI_USER_INC_URL. 'users.process.php'?>" class="login-form">
        <input type="hidden" name="op" value="login">
      <h3>Log In</h3>
      <div class="form-group">
        <input type="text" class="form-control" name="user" placeholder="Enter Username" required>
      </div>
      <div class="form-group">
        <input type="password" class="form-control" name="pass" placeholder="Password" required>
      </div>
        <button class="btn btn-lg btn-primary" type="submit">Login</button>
     </form>
     </div>
    </div>
    <div class="home_register">
      <form method="post" action="<?php echo ISVIPI_USER_INC_URL. 'users.process.php'?>" class="login-form">
        <input type="hidden" name="op" value="new">
      <h3>Create New Account</h3>
      <div class="form-group">
        <input class="form-control" type="text" name="user" value="<?php if(isset($_POST['user'])){echo $_POST['user'];}?>" placeholder="Username" onclick="this.value='';" required="required">
      </div>
      <div class="form-group">
        <input class="form-control" type="text" name="d_name" value="<?php if(isset($_POST['d_name'])){echo $_POST['d_name'];}?>" placeholder="Display Name" onclick="this.value='';" required="required">
      </div>
      <div class="form-group">
        <input class="form-control" type="email" name="email" value="<?php if(isset($_POST['email'])){echo $_POST['email'];}?>" placeholder="Email" onclick="this.value='';" required="required">
      </div>
      <div class="form-group">
        <input class="form-control" type="password" name="pass" value="" placeholder="Password" required="required">
      </div>
      <div class="form-group">
        <input class="form-control" type="password" name="pass2" value="" placeholder="Repeat Password" required="required">
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
        <input class="form-control" type="text" name="user_city" value="<?php if(isset($_POST['user_city'])){echo $_POST['user_city'];}?>" placeholder="City" onclick="this.value='';" required="required">
      </div>
      <div class="form-group">
        <input class="form-control" type="text" name="user_country" value="<?php if(isset($_POST['user_country'])){echo $_POST['user_country'];}?>" placeholder="Country" onclick="this.value='';" required="required">
      </div>
        <button class="btn btn-lg btn-primary" type="submit">Register</button>
     </form>
     </div>
</div>
