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

<?php include_partial('content/checks', array('checkList'=>$checkList, 'start_closed'=>false)) ?>

<?php if ($checkList->getTotalResults(Check::FAILED)+$checkList->getTotalResults(Check::WARNING)>0): ?>

<h2><?php echo __('Suggested commands') ?></h2>

	<ul class="sf_admin_actions">
	<?php if (sfConfig::get('app_system_commands_apply')): ?>
	<li class="sf_admin_action_execute">
		<?php echo link_to(__('Execute'), url_for('content/execute?file=' . basename($filename)) ) ?>
  </li><br />
	<?php endif ?>
	<li class="sf_admin_action_export">
		<?php echo link_to(__('Download script'), url_for('content/script?file=' . basename($filename)) ) ?>
		<?php //echo link_to(__('Download script'), '@userchecks?sf_format=txt') ?>
	</li><br />
	<li class="sf_admin_action_toggle">
		<?php echo link_to_function(
      __('Preview script'),
      visual_effect('toggle_blind', 'generatedscript')
      ) ?>
	</li>
	</ul>
  
<div id="generatedscript" style="display:none">
<h2><?php echo __('Script preview') ?></h2>
<p><?php echo __('You might just execute these commands by copying them on a terminal.') ?></p>

<textarea rows="20" cols="80">
<?php include($filename) ?>
</textarea>
</div>

<?php endif /* are there failed */?>

<?php endif /* is there a Checklist */?>
