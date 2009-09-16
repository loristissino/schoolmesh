<?php use_helper('Javascript') ?>
<?php use_helper('Form') ?>
<?php use_helper('Object') ?>

<?php slot('title', __('User management')) ?>
<?php slot('breadcrumbs',
	link_to(__("User management"), 'users/index') . ' » ' .
	link_to(__("User list"), 'users/list') . ' » ' .
	link_to($current_user->getFullName(), 'users/edit?id=' . $current_user->getUserId()) . ' » '.
	'Add to guardgroup'
	)
	
	?><h1><?php echo sprintf(__('Add %s to guardgroup'), $current_user->getFullName())?></h1>

<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="notice"><?php echo $sf_user->getFlash('notice')?></div>
<?php endif; ?>
<?php if ($sf_user->hasFlash('error')): ?>
  <div class="error"><?php echo $sf_user->getFlash('error')?></div>
<?php endif; ?>

<form action="<?php echo url_for('users/addtoguardgroup?user='. $current_user->getUserId()) ?>" method="post">

<p>
<?php foreach($guardgroups as $guardgroup): ?>
<?php if ($current_user->getBelongsToGuardGroupByName($guardgroup->getName())): ?>
	<strong><?php echo $guardgroup->getName() ?></strong>
<?php else: ?>
	<?php echo checkbox_tag('id[]', $guardgroup->getId(), false) ?>&nbsp;<?php echo $guardgroup->getName() ?>
<?php endif ?>
<br />
<?php endforeach ?>
</p>

<input type="submit" name="save" value="<?php echo __('Add') ?>">
  
</form>

