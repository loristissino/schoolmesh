<ul class="sf_admin_td_actions">
	<li class="sf_admin_action_edit">
		<?php echo link_to(__('Edit'),
			url_for('projects/edit?id=' . $project->getId()),
			array('title'=>__('Edit this project'))
		)?>
		</li>
</ul>
