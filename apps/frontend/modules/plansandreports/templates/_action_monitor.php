			<ul class="sf_admin_td_actions">
				<?php if($workplan->getState() > Workflow::WP_DRAFT): ?>
				<li class="sf_admin_action_view">
					<?php echo link_to(
				__('View'),
				'plansandreports/view?id=' . $workplan->getId(). '&layout=popup',
				array('title'=>__('Show this document') . ' ' . __('(opens in a new window)'), 'popup' => array('popupWindow', 'width=600,height=300,left=250,top=0,scrollbars=yes'))
				)?>
				</li>
				
				<li class="sf_admin_action_export">
					<?php echo link_to(
				__('Export'),
				'plansandreports/export?id='.$workplan->getId().'&back=monitor',
				array('title'=>__(__($steps[$workplan->getState()]['owner']['exportActionTip'])))
				)?>
				</li>
				<?php endif ?>

			<?php if(@$sf_user->getProfile()->hasCheckedPermission($steps[$workplan->getState()]['actions']['approve']['permission'])): ?>
				<li class="sf_admin_action_approve">
					<?php echo link_to(
				__('Approve'),
				'plansandreports/approve?id=' . $workplan->getId() . '&page=' . $page, 
				array('method'=>'put', 'title' =>__($steps[$workplan->getState()]['actions']['approve']['submitDisplayedAction']))
				)?>
				</li>
			<?php endif ?>
			<?php if(@$sf_user->getProfile()->hasCheckedPermission($steps[$workplan->getState()]['actions']['reject']['permission'])): ?>
				<li class="sf_admin_action_reject">
					<?php echo link_to(
				__('Reject'),
				'plansandreports/reject?id=' . $workplan->getId(). '&page=' . $page,
				array('title' => __($steps[$workplan->getState()]['actions']['reject']['submitDisplayedAction']))
				)?>
				</li>
			<?php endif ?>
				
			<?php if(@$sf_user->hasCredential('backadmin')): ?>
				<li class="sf_admin_action_log">
					<?php echo link_to(
				__('View events'),
				'plansandreports/viewwfevents?id=' . $workplan->getId() . '&page=' . $page)
				?>
				</li>
				<li class="sf_admin_action_edit">
					<?php echo link_to(
				__('Edit'),
				'plansandreports/fill?id=' . $workplan->getId() . '&page=' . $page)
				?>
				</li>
				
			<?php endif ?>
			</ul>
			
