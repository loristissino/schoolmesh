<?php use_helper('Javascript') ?>
<?php use_helper('Form') ?>
<?php use_helper('Object') ?>

<?php slot('title', __('User management')) ?>
<?php slot('breadcrumbs',
	link_to(__("User management"), 'users/index') . ' » ' .
	link_to(__("User list"), 'users/list') . ' » ' .
	link_to($current_user->getFullName(), 'users/edit?id=' . $current_user->getUserId()) . ' » '.
	'Add to team'
	)
	
	?><h1><?php echo sprintf(__('Add %s to team'), $current_user->getFullName())?></h1>

<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="notice"><?php echo $sf_user->getFlash('notice')?></div>
<?php endif; ?>
<?php if ($sf_user->hasFlash('error')): ?>
  <div class="error"><?php echo $sf_user->getFlash('error')?></div>
<?php endif; ?>

<form action="<?php echo url_for('users/addtoteam?user='. $current_user->getUserId()) ?>" method="post">


<p>
<?php foreach($teams as $team): ?>
<?php if ($current_user->getBelongsToTeam($team->getPosixName())): ?>
	<strong><?php echo $team->getDescription() ?></strong>
<?php else: ?>
	<?php echo checkbox_tag('id[]', $team->getId(), false) ?>&nbsp;<?php echo $team->getDescription() ?>
<?php endif ?>
<br />
<?php endforeach ?>
</p>

<?php echo select_tag('role', options_for_select($roles, 0)) ?>

<input type="submit" name="save" value="<?php echo __('Add') ?>">
  
</form>
