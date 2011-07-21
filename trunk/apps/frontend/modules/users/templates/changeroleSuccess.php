<?php slot('title', __('User management')) ?>
<?php slot('breadcrumbs',
	link_to(__("User management"), 'users/index') . ' » ' .
	link_to(__("User list"), 'users/list') . ' » ' .
	link_to($current_user->getFullName(), 'users/edit?id=' . $current_user->getUserId()) . ' » '.
	$team . ' » ' .
	'Change role'
	)
	
	?><h1><?php echo sprintf(__('Edit %s'), $team->__toString())?></h1>

<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="notice"><?php echo $sf_user->getFlash('notice')?></div>
<?php endif; ?>
<?php if ($sf_user->hasFlash('error')): ?>
  <div class="error"><?php echo $sf_user->getFlash('error')?></div>
<?php endif; ?>

<form action="<?php echo url_for('users/changerole') ?>" method="post">

  <table>
	<tr>
		<th><label><?php echo __('Team') ?></label></th>
		<td>
			<?php echo $team ?>
		</td>
	</tr>
    <?php echo $form ?>
	<tr>
      <td colspan="2">
         <input type="submit" name="save" value="<?php echo __('Save') ?>">
      </td>
    </tr>
  </table>
  
</form>

