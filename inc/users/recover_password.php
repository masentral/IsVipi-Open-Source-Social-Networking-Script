<?php include ISVIPI_THEMES_BASE.'/global/index_header.php';?>
<div class="home_log_content">
    <div class="home_login_welcome">
        <div class="home_register" style="width:500px; margin-right:-200px; ">
        <form method="post" action="<?php echo ISVIPI_USER_PROCESS; ?>" class="login-form">
        <input type="hidden" name="op" value="change">
        <input type="hidden" name="user" value="<?php echo $usern_n?>" required>
      <h3>Create a new password for <?php echo $usern_n?></h3>
      <div class="form-group">
      <label>New Password</label>
        <input type="password" class="form-control" name="newpass" placeholder="Password" required>
      </div>
      <div class="form-group">
      <label>Repeat New Password</label>
        <input type="password" class="form-control" name="newpass2" placeholder="Repeat Password" required>
      </div>
      <p>
        <button class="btn btn-lg btn-primary" type="submit">Save new password</button>
       </p>
     </form>
     
     </div>
    </div>
</div>
<?php get_home_footer();?>
