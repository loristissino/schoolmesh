<?php include_partial('content/breadcrumps', array(
  'current'=>sfConfig::get('app_school_name'),
  ))
?>
<p><?php echo __("You need to login to access the page you requested.") ?></p>

<form action="<?php echo url_for('@sf_guard_signin') ?>" method="post" id="loginbox">
	<table>
    <?php $form->setDefault('username', $sf_request->getParameter('loginas', '')) ?>
    <?php $form->setDefault('password', $sf_request->getParameter('demopassword', '')) ?>
    <?php // this allows to set the username for an action (and also the password, for the demo website ?>
    <?php echo $form['username']->renderRow() ?>
    <?php echo $form['password']->renderRow() ?>
  </table>
  <!--<a href="/schoolmesh/frontend_dev.php/request_password">Dimenticata la password?</a>-->

  <input type="submit" value="<?php echo __('sign in') ?>" />
  <!--<a href="<?php echo url_for('@sf_guard_password') ?>"><?php echo __("Forgot your password?") ?></a>-->
</form>

<?php if($sf_request->getParameter('loginas', '')!=''): ?>
  <?php use_javascript('signin_passwordfocus.js') ?>
<?php else: ?>
  <?php use_javascript('signin_usernamefocus.js') ?>
<?php endif ?>
