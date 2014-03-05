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
<link href="<?php echo ISVIPI_STYLE_URL; ?>css/tcal.css" rel="stylesheet" type="text/css" />
<div class="home_content">
    <div class="home_welcome">
    
    <h1>Meet New People, Chat and Have Fun!</h1>
    <?php if (isset($_SESSION['succ_reg'])){?>
    <div class="alert alert-info">
    <?php getAdminGenSett(); if ($usrValid=="1"){?>
    <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
    <h3>
    Registration successful! An email with a validation link has been sent to the email you provided. Please follow the instructions provided to validate your account. If you fail to find the email in your inbox, please check your <strong>spam folder</strong>.
    <?php } else {?>
    <a class="close" data-dismiss="alert" href="#" aria-hidden="true">&times;</a>
    <h3>
    Registration successful! You can now log in to your account</strong>.
    <?php }?>
    </h3>
    </div>
    <?php unset ($_SESSION['succ_reg']);}?>
    </div>
    <div class="home_register">
      <form method="post" action="<?php echo ISVIPI_USER_PROCESS; ?>" class="login-form">
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
        <?php cSelect();?>
      </div>
      <?php getAdminGenSett(); if ($usrReg == "1"){?>
      <button class="btn btn-lg btn-primary" type="submit" disabled="disabled">Registration is Disabled</button>
      <?php } else {?>
        <button class="btn btn-lg btn-primary" type="submit" >Register</button>
        <?php }?>
     </form>
     </div>
</div>
<?php get_home_footer()?>
<script type="text/javascript" src="<?php echo ISVIPI_STYLE_URL; ?>js/tcal.js"></script>