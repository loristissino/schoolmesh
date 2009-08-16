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

<?php if(isset($checkList)): ?>

<?php include_partial('content/checks', array('checkList'=>$checkList, 'start_closed'=>true)) ?>

<?php if ($checkList->getTotalResults(Check::FAILED)>0): ?>

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
CODICE DA RISCRIVERE - REFACTORING IN CORSO...
<?php// include_partial('commands', array('userlist'=>$userlist)) ?>
</textarea>
<?php endif /* are there failed */?>

<?php endif /* is there a Checklist */?>
