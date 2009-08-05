<?php use_helper('Javascript') ?>
<?php use_helper('Form') ?>
<?php use_helper('Object') ?>

<?php slot('title', __('User checks')) ?>
	
<?php slot('breadcrumbs',
	link_to(__("User management"), 'users/index') . ' » ' .
	__("User checks")
	)

?><h1><?php echo __("User checks")?></h1>

<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="notice"><?php echo $sf_user->getFlash('notice')?></div>
<?php endif; ?>
<?php if ($sf_user->hasFlash('error')): ?>
  <div class="error"><?php echo $sf_user->getFlash('error')?></div>
<?php endif; ?>

<?php if(isset($checks)): ?>

<h2><?php echo __('Checks') ?></h2>

<p><?php echo format_number_choice('[0]No check has been done.|[1]One check has been done.|(1,+Inf]A total of %1 checks have been done.', array('%1'=>($ok+$failed)), $ok+$failed); ?></p>
<ul>
<li>
<strong style="color:<?php echo ($failed>0)? 'red':'green' ?>">
<?php echo format_number_choice('[0]No check failed.|[1]One check failed.|(1,+Inf]A total of %1 checks failed.', array('%1'=>($failed)), $failed); ?>
</strong>
</li>
<li>
<?php echo format_number_choice('[0]No check passed.|[1]One check passed.|(1,+Inf]A total of %1 checks passed.', array('%1'=>$ok), $ok); ?>
</li>
</ul>

<hr />

<?php $oldcontent=''; ?>
<?php foreach($checks as $check): ?>
<?php if($check->getContent()!=$oldcontent): ?>
	<p><strong><?php echo $check->getContent() ?></strong>
	<?php if($check->getLinkTo()): ?>
		<?php echo link_to('(' . __('Edit') .')', $check->getLinkTo()) ?>
	<?php endif ?>
	</p>
	<?php $oldcontent=$check->getContent() ?>
<?php endif ?>
	<div class='check_results'>
	<p>
		<?php echo image_tag($check->getIsPassed()? 'done':'notdone', 'title=' . ($check->getIsPassed()?__('passed'):__('failed'))); ?>
		<?php echo $check->getMessage() ?>
	</p>
	</div>
<?php endforeach; ?>

<?php if ($failed>0): ?>

<h2><?php echo __('Commands') ?></h2>

	<ul class="sf_admin_actions">
	<li class="sf_admin_action_export">
		<?php echo link_to(__('Download script'), '@userchecks?sf_format=txt') ?>
	</li>
	</ul>

<textarea rows="20" cols="80">
<?php include_partial('commands', array('checks'=>$checks)) ?>
</textarea>
<?php endif ?>

<?php endif ?>
