<?php include ISVIPI_THEMES_BASE.'/global/index_header.php';?>
<div class="home_log_content">
    <div class="home_login_welcome">
        <div class="home_register" style="width:500px; margin-right:-200px; ">
      <form method="post" action="<?php echo ISVIPI_USER_PROCESS; ?>" class="login-form">
        <input type="hidden" name="op" value="forgot_pass">
        <input type="hidden" name="user" value="reset_user" required>
      <h4>Please provide the email associated with your account</h4>
      <div class="form-group">
        <input type="email" class="form-control" name="recov_email" placeholder="Email" required>
      </div>
      <p>
        <button class="btn btn-lg btn-primary" type="submit">Send Recovery Email</button>
       </p>
     </form>
     
     </div>
    </div>
</div>
<?php get_home_footer();?>
