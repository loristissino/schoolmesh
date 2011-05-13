<?php use_helper('Javascript') ?>
<?php use_helper('Form') ?>
<?php use_helper('Object') ?>

<?php slot('title', __('User management')) ?>
<?php slot('breadcrumbs',
	link_to(__("User management"), 'users/index') . ' » ' .
	link_to(__("User list"), 'users/list') . ' » ' .
	link_to($current_user->getFullName(), 'users/edit?id=' . $current_user->getUserId()) . ' » '.
	'Add credential'
	)
	
	?><h1><?php echo sprintf(__('Add a credential for %s'), $current_user->getFullName())?></h1>

<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="notice"><?php echo $sf_user->getFlash('notice')?></div>
<?php endif; ?>
<?php if ($sf_user->hasFlash('error')): ?>
  <div class="error"><?php echo $sf_user->getFlash('error')?></div>
<?php endif; ?>

<form action="<?php echo url_for('users/addcredential?user='. $current_user->getUserId()) ?>" method="post">

<p>
<?php foreach($credentials as $credential): ?>
<?php if ($current_user->hasPermission($credential->getName())): ?>
	<strong><?php echo $credential->getName() ?></strong>
<?php else: ?>
	<em><?php echo checkbox_tag('id[]', $credential->getId(), false) ?>&nbsp;<?php echo $credential->getName() ?></em>
<?php endif ?>
&nbsp;(<?php echo $credential->getDescription() ?>)<br />
<?php endforeach ?>
</p>

<input type="submit" name="save" value="<?php echo __('Add') ?>">
  
</form>

