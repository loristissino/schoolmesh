			<ul class="sf_admin_td_actions">
				<li class="sf_admin_action_view">
					<?php echo link_to(
				__('View'),
				'wpmodule/show?id=' . $wpmodule->id,
				array('title'=>__('Show this module') . ' ' . __('(opens in a new window)'), 'popup' => array('popupWindow', 'width=600,height=300,left=250,top=0,scrollbars=yes'))
				)?>
				</li>
				<li class="sf_admin_action_import">
					<?php echo link_to(
				__('Import'),
				'wpmodule/import?id=' . $wpmodule->id . '&workplan=' . $workplan->getId(), 
				array('method' => 'put', 'title'=>__('Import this module from the database'))
				)?>
				</li>
				<?php if(!$wpmodule->appointment_id): ?>
				<li class="sf_admin_action_link">
					<?php echo link_to(
				__('Link'),
				'wpmodule/link?id=' . $wpmodule->id . '&workplan=' . $workplan->getId(), 
				array('method' => 'put', 'title'=>__('Link this module to the workplan'))
				)?>
				</li>
				<?php endif ?>
			</ul>
