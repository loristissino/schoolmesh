<ul class="sf_admin_td_actions">
  <?php if($project->isEditableBy($sf_user)): ?>
	<li class="sf_admin_action_fill">
		<?php echo link_to(__('Fill'),
			url_for('projects/edit?id=' . $project->getId()),
			array('title'=>__('Fill in information for this project'))
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
  <?php if($project->getsfGuardUser()->getProfile()->getHasValidatedEmail()): ?>
  <li class="sf_admin_action_email">
		<?php echo link_to(__('Email'),
			url_for('projects/email?id=' . $project->getId()),
			array('title'=>__('Prepare and send an email to the coordinator of this project'))
		)?>
		</li>
  <?php endif ?>
  
    <?php endif ?>
</ul>
