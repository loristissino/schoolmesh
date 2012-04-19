			<ul class="sf_admin_td_actions">
				<li class="sf_admin_action_edit">
					<?php echo link_to(
				__('Edit'),
				'users/edit?id='.$user->getSfGuardUser()->getId(),
				array('title'=>__('Edit information about %user%', array('%user%'=>$user->getFullName())))
				)?>
				</li>
				<?php if($user->getIsScheduledForDeletion()): ?>
				<li class="sf_admin_action_undelete">
					<?php echo link_to(
				__('Undelete'),
				'users/undelete?id='.$user->getUserId(),
				array('title'=>__('Undelete %user%', array('%user%'=>$user->getFullName())), 'method'=>'POST')
				)?>
				</li>
				<?php endif ?>
        <?php if($sf_user->hasCredential('admin')): ?>
				<li class="sf_admin_action_log">
					<?php echo link_to(
				__('Logs'),
				'lanlog/viewbyuser?id='.$user->getUserId(),
				array('title'=>__('View LAN access logs for %user%', array('%user%'=>$user->getFullName())))
				)?>
				</li>
        <?php endif ?>
			</ul>
