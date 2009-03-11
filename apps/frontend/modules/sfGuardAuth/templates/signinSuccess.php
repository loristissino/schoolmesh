<h1 class="topbar"><?php echo sfConfig::get('app_school_name'); ?></h1>
<p><?php echo __("You need to login to access the page you requested.") ?></p>

<form action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
  <table>
    <?php echo $form ?>
  </table>

  <input type="submit" value="sign in" />
  <a href="<?php echo url_for('@sf_guard_password') ?>"><?php echo __("Forgot your password?") ?></a>
</form>
