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

<?php foreach($userlist as $current_user): ?>
	<p>
	<?php echo image_tag($current_user->getCountFailedChecks()==0? 'done':'notdone', 'title=' . $current_user->getCountFailedChecks()==0?__('passed'):__('failed')) ?>
	<strong>	
	<?php echo link_to_function(
  $current_user,
  visual_effect('toggle_blind', 'user'.$current_user->getUsername()), array(__('Hide'))
) ?></strong>  (<?php echo format_number_choice('[0]No check failed.|[1]One check failed.|(1,+Inf]A total of %1 checks failed.', array('%1'=>($current_user->getCountFailedChecks())), $current_user->getCountFailedChecks()); ?>)

	<?php echo link_to(
  __('Edit'),
  url_for('users/edit?id=' . $current_user->getUserId())
)  
 ?>




</p>

		<div class='check_results' id="user<?php echo $current_user->getUsername() ?>" style="display:<?php echo $current_user->getCountFailedChecks()>0? 'none': 'none' ?>">
		<?php foreach($current_user->getChecks() as $check): ?>
		<p>
			<?php echo image_tag($check->getIsPassed()? 'done':'notdone', 'title=' . ($check->getIsPassed()?__('passed'):__('failed'))); ?>
			<?php echo $check->getMessage() ?>
		</p>
		<?php endforeach ?>
		</div>
<?php endforeach ?>

<?php if ($failed>0): ?>

<h2><?php echo __('Commands') ?></h2>

	<ul class="sf_admin_actions">
	<?php if (sfConfig::get('app_system_commands_apply')): ?>
	<li class="sf_admin_action_execute">
		<?php echo link_to(__('Execute'), url_for('users/runuserchecks?execute=true' . (isset($id)?'&id='.$id:''))) ?>
	</li>
	<?php endif ?>
	<li class="sf_admin_action_export">
		<?php echo link_to(__('Download script'), '@userchecks?sf_format=txt') ?>
	</li>
	</ul>

<textarea rows="20" cols="80">
<?php include_partial('commands', array('userlist'=>$userlist)) ?>
</textarea>
<?php endif ?>

<?php endif ?>
