<?php if ($lastlog): ?>
			<ul class="sf_admin_td_actions">
				<li class="sf_admin_action_<?php echo $steps[$lastlog->getState()]['viewAction'] ?>">
					<?php echo link_to(
				__($steps[$lastlog->getState()]['owner']['displayedAction']),
				'plansandreports/'.$steps[$lastlog->getState()]['owner']['viewAction'].'?id='.$workplan->getId()
				)?>
				</li>
			</ul>
<?php else: ?>
	No action
<?php endif ?>