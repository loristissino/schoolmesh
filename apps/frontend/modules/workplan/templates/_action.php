<?php if ($lastlog): ?>
	<?php echo link_to(
				__($steps[$lastlog->getState()]['viewAction']),
				'workplan/'.$steps[$lastlog->getState()]['viewAction'].'?id='.$workplan->getId()
				)?>
<?php else: ?>
	No action
<?php endif ?>