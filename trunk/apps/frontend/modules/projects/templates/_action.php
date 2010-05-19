<ul class="sf_admin_td_actions">
  <?php if($project->isEditableBy($sf_user)): ?>
	<li class="sf_admin_action_edit">
		<?php echo link_to(__('Edit'),
			url_for('projects/edit?id=' . $project->getId()),
			array('title'=>__('Edit this project'))
		)?>
		</li>
  <?php endif ?>
  <?php if ($sf_user->hasCredential('schoolmaster')): ?>
	<li class="sf_admin_action_view">
		<?php echo link_to(__('View'),
			url_for('projects/view?id=' . $project->getId()),
			array('title'=>__('See the report for this project'))
		)?>
		</li>
    <?php endif ?>
</ul>
