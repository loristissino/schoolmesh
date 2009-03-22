<?php if ($lastlog): ?>
	<?php echo image_tag('wpfr_workflow_'.$lastlog->getState().'r', 'title=' . __($steps[$lastlog->getState()]['stateDescription'])) ?>
<?php else: ?>
	<?php echo __("No info available") ?>
<?php endif ?>