			<ul class="sf_admin_td_actions">
				<?php if($workplan->state > Workflow::WP_DRAFT): ?>
				<li class="sf_admin_action_view">
					<?php echo link_to(
				__('View'),
				'plansandreports/view?id=' . $workplan->id. '&layout=popup',
				array('title'=>__('Show this document') . ' ' . __('(opens in a new window)'), 'popup' => array('popupWindow', 'width=600,height=300,left=250,top=0,scrollbars=yes'))
				)?>
				</li>
				
				<li class="sf_admin_action_export">
					<?php echo link_to(
				__('Export'),
				'plansandreports/export?id='.$workplan->id,
				array('title'=>__(__($steps[$workplan->state]['owner']['exportActionTip'])))
				)?>
				</li>

			<?php if(@$sf_user->hasCredential($steps[$workplan->state]['actions']['approve']['permission'])): ?>
				<li class="sf_admin_action_approve">
					<?php echo link_to(
				__('Approve'),
				'plansandreports/approve?id=' . $workplan->id, 
				array('method'=>'put', 'title' => __($steps[$workplan->state]['actions']['approve']['submitDisplayedAction']))
				)?>
				</li>
			<?php endif ?>
			<?php if(@$sf_user->hasCredential($steps[$workplan->state]['actions']['reject']['permission'])): ?>
				<li class="sf_admin_action_reject">
					<?php echo link_to(
				__('Reject'),
				'plansandreports/reject?id=' . $workplan->id, 
				array('method' => 'post', 'title' => __($steps[$workplan->state]['actions']['reject']['submitDisplayedAction']))
				)?>
				</li>
			<?php endif ?>
				<?php endif ?>
				
			</ul>
			
