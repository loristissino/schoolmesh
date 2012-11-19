<?php include_partial('content/breadcrumps', array(
  'current'=>sfConfig::get('app_school_name'),
  ))
?>
<?php $sf_user->setFlash('helpmodule', 'authentication') ?>

<p><?php echo __("You need to login to access the page you requested.") ?></p>

<form action="<?php echo url_for('@sf_guard_signin') ?>" method="post" id="loginbox">
	<table>

    <?php $form->setDefault('username', $sf_request->getParameter('loginas', '')) ?>
    <?php $form->setDefault('password', $sf_request->getParameter('demopassword', '')) ?>
    <?php //$form['password']->getWidget()->setAttribute('class', 'input capLocksCheck') ?>
    <?php // this allows to set the username for an action (and also the password, for the demo website ?>
    <?php echo $form['username']->renderRow() ?>
    <tr>
      <th>
        <?php echo $form['password']->renderLabel() ?>
      </th>
      <td>
        <?php echo $form['password']->renderError() ?>
        <?php echo $form['password']->render(array('class'=>'input capLocksCheck')) ?>
        <br />
        <span id="capsLockNotice" style="display: none">
          <?php include_partial('content/dubious', array('text'=>__('Caps lock is on'), 'with_text'=>true)) ?>
        </span>
  </td>
  </tr>
      </td>
    </tr>

  </table>
  <!--<a href="/schoolmesh/frontend_dev.php/request_password">Dimenticata la password?</a>-->
  

  <input type="submit" value="<?php echo __('Sign in') ?>" />
  <!--<a href="<?php echo url_for('@sf_guard_password') ?>"><?php echo __("Forgot your password?") ?></a>-->
</form>

<?php use_javascript('capslockdetector.js') ?>
<?php if($sf_request->getParameter('loginas', '')!=''): ?>
  <?php use_javascript('signin_passwordfocus.js') ?>
<?php else: ?>
  <?php use_javascript('signin_usernamefocus.js') ?>
<?php endif ?>
