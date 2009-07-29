			<ul class="sf_admin_td_actions">
				<li class="sf_admin_action_edit">
					<?php echo link_to(
				__('Edit'),
				'users/edit?id='.$user->getSfGuardUser()->getId(),
				array('title'=>__('Edit information about this user'))
				)?>
				</li>
			</ul>
