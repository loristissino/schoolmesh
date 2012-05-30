<?php slot('title', __('Profile')) ?>
<?php slot('breadcrumbs',
	link_to(__('My profile'), url_for('profile')) . ' » ' .
	$account
	)
	
	?><h1><?php echo $account ?></h1>

<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="notice"><?php echo $sf_user->getFlash('notice')?></div>
<?php endif; ?>
<?php if ($sf_user->hasFlash('error')): ?>
  <div class="error"><?php echo $sf_user->getFlash('error')?></div>
<?php endif; ?>


<form action="<?php echo url_for('profile/changeaccountpassword') ?>" method="post">

  <table>
    <?php echo $form ?>
	<tr>
      <td colspan="2">
         <input type="submit" name="save" value="<?php echo __('Change password') ?>">
      </td>
    </tr>
  </table>
