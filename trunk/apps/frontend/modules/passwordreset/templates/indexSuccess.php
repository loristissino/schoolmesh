<?php slot('title', __('Password reset')) ?>
<?php slot('breadcrumbs',
	__("Password reset")
	)
	
	?><h1><?php echo __("Password reset")?></h1>
	
<p><?php echo __('This page is for resetting the password of the students that might have forgot it.') ?></p>
<p><?php echo __('Teachers\'s and staff\'s passwords can be reset only by an administrator.') ?></p>

<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="notice"><?php echo $sf_user->getFlash('notice')?></div>
<?php endif; ?>
<?php if ($sf_user->hasFlash('error')): ?>
  <div class="error"><?php echo $sf_user->getFlash('error')?></div>
<?php endif; ?>

<form action="<?php echo url_for('passwordreset/confirm') ?>" method="get">

  <table>
    <?php echo $form ?>
	<tr>
      <td colspan="2">
         <input type="submit" name="choose" value="<?php echo __('Choose') ?>">
      </td>
    </tr>
  </table>

