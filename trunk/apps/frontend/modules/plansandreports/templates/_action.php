			<ul class="sf_admin_td_actions">
				<li class="sf_admin_action_<?php echo $steps[$workplan->getState()]['viewAction'] ?>">
					<?php echo link_to(
				__($steps[$workplan->getState()]['owner']['displayedAction']),
				'plansandreports/'.$steps[$workplan->getState()]['owner']['viewAction'].'?id='.$workplan->getId()
				)?>
				</li>
			</ul>
