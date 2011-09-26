<?php if ($state!=NULL): ?>
	<?php echo image_tag('wpfr_workflow_'.$state.$size, 'title=' . __($steps[$state]['stateDescription'])) ?>
<?php else: ?>
	<?php echo __("No info available") ?>
<?php endif ?>