			<ul class="sf_admin_td_actions">
				<li class="sf_admin_action_edit">
					<?php echo link_to(
				__('Edit'),
				'users/edit?id='.$user->getSfGuardUser()->getId(),
				array('title'=>__('Edit information about this user'))
				)?>
				</li>
				<?php if($user->getIsDeleted()): ?>
				<li class="sf_admin_action_undelete">
					<?php echo link_to(
				__('Undelete'),
				'users/undelete?id='.$user->getUserId(),
				array('title'=>__('Undelete this user'), 'method'=>'POST')
				)?>
				</li>
				<?php endif ?>
			</ul>
