<ul class="sf_admin_td_actions">
  <?php if($project->isEditableBy($sf_user) && $project->getState()!=Workflow::PROJ_FINISHED): ?>
	<li class="sf_admin_action_fill">
		<?php echo link_to(__('Fill'),
			url_for('projects/edit?id=' . $project->getId()),
			array('title'=>__('Fill in information for this project'))
		)?>
		</li>
  <?php endif ?>
  <?php if($project->isEditableBy($sf_user) && $project->getState()==Workflow::PROJ_FINISHED): ?>
	<li class="sf_admin_action_export">
		<?php echo link_to(__('Export'),
			url_for('projects/export?id=' . $project->getId()),
			array('title'=>__('Generate the document that has to be signed by the people who performed activities in the project'))
		)?>
		</li>
  <?php endif ?>
  <?php if ($project->isViewableBy($sf_user)): ?>
	<li class="sf_admin_action_view">
		<?php echo link_to(__('View'),
			url_for('projects/view?id=' . $project->getId()),
			array('title'=>__('See the report for this project'))
		)?>
		</li>
  <?php endif ?>
  <?php if ($project->isViewableBy($sf_user)): ?>
	<li class="sf_admin_action_clone">
		<?php echo link_to(__('Clone'),
			url_for('projects/clone?id=' . $project->getId()),
			array('title'=>__('Create a new project by duplicating and adapting this one'), 'method'=>'post')
		)?>
		</li>
  <?php endif ?>
  <?php if ($project->isDeletableBy($sf_user)): ?>
	<li class="sf_admin_action_delete">
		<?php echo link_to(__('Delete'),
			url_for('projects/delete?id=' . $project->getId()),
			array('title'=>__('Delete this project'), 'method'=>'post', 'confirm' => format_number_choice(__('[0]Are you sure?|[1]Are you sure?'), null, $sf_user->getProfile()->getIsMale()))
		)?>
		</li>
  <?php endif ?>
</ul>
