<h1>Restricted Area</h1>
<form action="<?php echo url_for('@sf_guard_signin') ?>" method="post">
  <table>
    <?php echo $form ?>
  </table>

  <input type="submit" value="sign in" />
  <a href="<?php echo url_for('@sf_guard_password') ?>"><?php echo __("Forgot your password?") ?></a>
</form>