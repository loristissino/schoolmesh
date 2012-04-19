<h2><?php echo __('Actions') ?></h2>
	<ul class="sf_admin_actions">
		<li class="sf_admin_action_view">
				<?php echo link_to(
				__('Show this document'),
				'plansandreports/view?id='.$workplan->getId(),
				array('title'=>__('Show this document in a single page'))
				)?>
  <br />
	</li>
	<?php if (isset($show_fill) && ($show_fill==true)): ?>
		<li class="sf_admin_action_fill">
				<?php echo link_to(
				__('Fill this document'),
				'plansandreports/fill?id='.$workplan->getId(),
				array('title'=>__('Fill this document'))
				)?>
  <br />
	</li>
	<?php endif ?>
	<?php include_partial('export', array('workplan' => $workplan, 'steps'=>$steps)) ?>
	<?php if($workplan->getState()==Workflow::WP_DRAFT): ?>
    <?php if(!$workplan->getIsPublic()): ?>
      <li class="sf_admin_action_publish">
            <?php echo link_to(
            __('Publish'),
            'plansandreports/publish?id='.$workplan->getId(). '&makepublic=true',
            array(
              'method' => 'put',
              'title' => __('Make the whole document public before submission, so that your colleagues can see it')
              )
            )?>
      <br />
      </li>
    <?php else: ?>
      <li class="sf_admin_action_unpublish">
            <?php echo link_to(
            __('Keep private'),
            'plansandreports/publish?id='.$workplan->getId(). '&makepublic=false',
            array(
              'method' => 'put',
              'title' => __('Set the whole document to private')
              )
            )?>
      <br />
      </li>
    <?php endif ?>
	<?php endif ?>
	<?php if($workplan->getState()==Workflow::WP_DRAFT || $workplan->getState()==Workflow::IR_DRAFT): ?>
	<li class="sf_admin_action_submit">
				<?php echo link_to(
				__($steps[$workplan->getState()]['owner']['submitDisplayedAction']),
				'plansandreports/'. $steps[$workplan->getState()]['owner']['submitAction']. '?id='.$workplan->getId(),
				array(
          'method' => 'put',
          'confirm' => format_number_choice(__('[0]Are you sure?|[1]Are you sure?'), null, $sf_user->getProfile()->getIsMale()) . ' ' . __('Documents submitted cannot be modified anymore.'),
				  'title' => __($steps[$workplan->getState()]['owner']['submitDisplayedAction']) . '. ' . __('It will be then administratively checked and approved by the principal')
          )
				)?>
  <br />
	</li>
	<?php endif ?>
		<li class="sf_admin_action_back">
				<?php echo link_to(
				__('Plans and Reports'),
				'@plansandreports',
				array('title'=>__('Back to my workplans and reports'))
				)?>
  <br />
	</li>
	</ul>
