			<ul class="sf_admin_td_actions">
				<li class="sf_admin_action_<?php echo $steps[$workplan->getState()]['owner']['viewAction'] ?>">
					<?php echo link_to(
				__($steps[$workplan->getState()]['owner']['displayedAction']),
				'plansandreports/'.$steps[$workplan->getState()]['owner']['viewAction'].'?id='.$workplan->getId(),
				array('title'=>__($steps[$workplan->getState()]['owner']['displayedAction']))
				)?>
				</li>
<?php include_partial('export', array('workplan' => $workplan, 'steps'=>$steps)) ?>
			</ul>
