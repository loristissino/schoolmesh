<?php slot('title', __('Password reset confirmation')) ?>
<?php slot('breadcrumbs',
	__("Password reset") . ' » ' .
	__("Password reset confirmation")
	)
	
	?><h1><?php echo __("Password reset confirmation")?></h1>
	
<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="notice"><?php echo $sf_user->getFlash('notice')?></div>
<?php endif; ?>
<?php if ($sf_user->hasFlash('error')): ?>
  <div class="error"><?php echo $sf_user->getFlash('error')?></div>
<?php endif; ?>

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
	<tr>
      <th><label><?php echo __('Temporary password') ?></label></th>
	  <td>
		<?php echo $password ?>
      </td>
    </tr>
  
  </table>

<hr />

<p><?php echo link_to(
	'Homepage',
	'@homepage'
	)
	?></p>