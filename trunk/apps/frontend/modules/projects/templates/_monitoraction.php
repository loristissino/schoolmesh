<ul class="sf_admin_td_actions">

	<li class="sf_admin_action_view">
		<?php echo link_to(__('View'),
			url_for('projects/view?id=' . $project->getId()),
			array('title'=>__('See the report for this project'))
		)?>
		</li>
  <?php if($project->isReadyForEmail()): ?>
  <li class="sf_admin_action_email">
		<?php echo link_to(__('Email'),
			url_for('projects/email?id=' . $project->getId()),
			array('title'=>__('Prepare and send an email to the coordinator of this project'))
		)?>
		</li>
  <?php endif ?>
</ul>