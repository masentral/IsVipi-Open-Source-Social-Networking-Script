<?php include ISVIPI_THEMES_BASE.'/global/index_header.php';?>
<div class="home_log_content">
    <div class="home_login_welcome">
        <div class="home_register" style="width:500px; margin-right:-200px; ">
        <form method="post" action="<?php echo ISVIPI_USER_PROCESS; ?>" class="login-form">
        <input type="hidden" name="op" value="change">
        <input type="hidden" name="user" value="<?php echo $usern_n?>" required>
      <h3><?php echo CREATE_NEW_PASS_FOR ?> <?php echo $usern_n?></h3>
      <div class="form-group">
      <label><?php echo NEW_PASS ?></label>
        <input type="password" class="form-control" name="newpass" placeholder="<?php echo NEW_PASS ?>" required>
      </div>
      <div class="form-group">
      <label><?php echo REP_NEW_PASS ?></label>
        <input type="password" class="form-control" name="newpass2" placeholder="<?php echo REP_NEW_PASS ?>" required>
      </div>
      <p>
        <button class="btn btn-lg btn-primary" type="submit"><?php echo CHANGE_PASS ?></button>
       </p>
     </form>
     </div>
    </div>
</div>
<?php get_home_footer();?>
