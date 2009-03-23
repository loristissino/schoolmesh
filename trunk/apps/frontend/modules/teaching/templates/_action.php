<?php if ($lastlog): ?>
	<?php echo link_to(
				__($steps[$lastlog->getState()]['viewAction']),
				'teaching/show?id='.$workplan->getId()
				)?>
<?php else: ?>
	No action
<?php endif ?>