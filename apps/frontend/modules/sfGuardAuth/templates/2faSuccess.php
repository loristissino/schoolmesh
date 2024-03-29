<?php include_partial('content/breadcrumps', array(
  'current'=>sfConfig::get('app_school_name'),
  ))
?>
<?php $sf_user->setFlash('helpmodule', 'authentication') ?>

<?php include_partial('content/flashes'); ?>
<?php if($sf_user->hasFlash('error')): ?>
  <p><?php echo __('Tip: Codes are time-dependent. Please check that the time set on your mobile device is not too far from the one on the server: %time%.', array('%time%'=>date('H:i:s (T, O)'))) ?></p>
<?php endif ?>

<p><?php echo __('Enter the verification code generated by your mobile application.') ?></p>

<form action="<?php echo url_for('@2fa') ?>" method="post" id="loginbox">
	<table>
    <?php echo $form ?>
  </table>

  <input type="submit" value="<?php echo __('Verify') ?>" />
</form>

<?php use_javascript('2fa_codefocus.js') ?>
