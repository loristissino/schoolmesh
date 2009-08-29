<?php slot('title', __('Confirm password reset')) ?>
<?php slot('breadcrumbs',
	__("Password reset") . ' » ' .
	__("Confirm password reset")
	)
	
	?><h1><?php echo __("Confirm password reset")?></h1>
	
<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="notice"><?php echo $sf_user->getFlash('notice')?></div>
<?php endif; ?>
<?php if ($sf_user->hasFlash('error')): ?>
  <div class="error"><?php echo $sf_user->getFlash('error')?></div>
<?php endif; ?>

<p>
<strong>
<?php echo __('You are about to reset the password for this account.') ?>
</strong> 
</p>
<p>
         <?php echo __('Is it ok to proceed?') ?>
</p>

<form action="<?php echo url_for('passwordreset/confirm') ?>" method="post">

  <table>
	<tr>
      <th><label><?php echo __('Username') ?></label></th>
	  <td>
		<?php echo $username ?>
      </td>
    </tr>
	<tr>
      <th><label><?php echo __('Account') ?></label></th>
	  <td>
		<?php echo $account ?>
      </td>
    </tr>
  
    <?php echo $form ?>
	<tr>
      <td colspan="2">
         <input type="submit" name="Confirm" value="<?php echo __('Confirm') ?>">
		<?php echo link_to(
			__('Cancel'),
			$referer
			);
		?>
      </td>
    </tr>
  </table>


