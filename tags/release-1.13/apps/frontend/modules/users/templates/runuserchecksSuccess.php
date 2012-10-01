<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'users/index' =>__('User management'),
    'users/list'=>__('List/Search'),
    'users/list?query='. $sf_user->getAttribute('currently_selected')=>__('Selected users'),
    ),
    'current'=>__("User checks")
  ))
?>

<?php include_partial('content/flashes'); ?>

<?php if(isset($checkList)): ?>

<?php include_partial('content/checks', array('checkList'=>$checkList, 'start_closed'=>false)) ?>

<?php if ($checkList->getTotalResults(Check::FAILED)+$checkList->getTotalResults(Check::WARNING)>0): ?>

<h2><?php echo __('Suggested commands') ?></h2>

	<ul class="sf_admin_actions">
	<?php if (sfConfig::get('app_system_commands_apply')): ?>
	<li class="sf_admin_action_execute">
		<?php echo link_to(
      __('Execute'), 
      url_for('content/execute?file=' . basename($filename)),
      array(
        'method'=>'POST'
        )
      ) ?>
  </li><br />
	<?php endif ?>
	<li class="sf_admin_action_export">
		<?php echo link_to(__('Download script'), url_for('content/script?file=' . basename($filename)) ) ?>
		<?php //echo link_to(__('Download script'), '@userchecks?sf_format=txt') ?>
	</li><br />
	<li class="sf_admin_action_toggle">
		<?php echo jq_link_to_function(
      __('Preview script'),
      jq_visual_effect('slideToggle', '#generatedscript')
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
