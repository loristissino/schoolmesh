<ul class="sf_admin_td_actions">

	<?php if ($workplan->getState()>Workflow::AP_ASSIGNED): ?>
		<li class="sf_admin_action_<?php echo $steps[$workplan->getState()]['owner']['viewAction'] ?>">
			<?php echo link_to(
		__($steps[$workplan->getState()]['owner']['displayedAction']),
		'plansandreports/'.$steps[$workplan->getState()]['owner']['viewAction'].'?id='.$workplan->getId(),
		array('title'=>__($steps[$workplan->getState()]['owner']['displayedAction']))
		)?>
		</li>
		<?php include_partial('export', array('workplan' => $workplan, 'steps'=>$steps)) ?>
	<?php endif ?>
<?php if ($workplan->getState()==Workflow::WP_DRAFT): ?>
	<li class="sf_admin_action_import">
		<?php echo link_to(
	__('Import'),
	'plansandreports/import?id='.$workplan->getId(),
	array('title'=>__('Import the workplan from a file or from the database'))
	)?>
	</li>
<?php endif ?>
</ul>
