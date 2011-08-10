<h2><?php echo __('Actions') ?></h2>
	<ul class="sf_admin_actions">
		<li class="sf_admin_action_view">
				<?php echo link_to(
				__('Show this document'),
				'plansandreports/view?id='.$workplan->getId(),
				array('title'=>__('Show this document in a single page'))
				)?>
	</li><br />
	<?php if (isset($show_fill) && ($show_fill==true)): ?>
		<li class="sf_admin_action_fill">
				<?php echo link_to(
				__('Fill this document'),
				'plansandreports/fill?id='.$workplan->getId(),
				array('title'=>__('Fill this document'))
				)?>
	</li><br />
	<?php endif ?>
	<?php include_partial('export', array('workplan' => $workplan, 'steps'=>$steps)) ?><br />
	<?php if($workplan->getState()==Workflow::WP_DRAFT || $workplan->getState()==Workflow::IR_DRAFT): ?>
	<li class="sf_admin_action_submit">
				<?php echo link_to(
				__($steps[$workplan->getState()]['owner']['submitDisplayedAction']),
				'plansandreports/'. $steps[$workplan->getState()]['owner']['submitAction']. '?id='.$workplan->getId(),
				array(
          'method' => 'put',
          'confirm' => format_number_choice(__('[0]Are you sure?|[1]Are you sure?'), null, $sf_user->getProfile()->getIsMale()) . ' ' . __('Documents submitted cannot be modified anymore.'),
				  'title' => __($steps[$workplan->getState()]['owner']['submitDisplayedAction']) . '. ' . __('It will be then administratively checked and approved by the schoolmaster')
          )
				)?>
	</li><br />
	<?php endif ?>
		<li class="sf_admin_action_back">
				<?php echo link_to(
				__('Plans and Reports'),
				'@plansandreports',
				array('title'=>__('Back to my workplans and reports'))
				)?>
	</li><br />
	</ul>
