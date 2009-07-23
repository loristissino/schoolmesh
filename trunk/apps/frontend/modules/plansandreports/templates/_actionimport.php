			<ul class="sf_admin_td_actions">
				<li class="sf_admin_action_view">
					<?php echo link_to(
				__('View'),
				'plansandreports/view?id=' . $iworkplan->getId(). '&layout=popup',
				array('title'=>__('Show this document') . ' ' . __('(opens in a new window)'), 'popup' => array('popupWindow', 'width=600,height=300,left=250,top=0,scrollbars=yes'))
				)?>
				</li>
				<li class="sf_admin_action_import">
					<?php echo link_to(
				__('Import'),
				'plansandreports/importfromdb?id=' . $workplan->getId() . '&from=' . $iworkplan->getId(), 
				array('method' => 'put', 'confirm' => format_number_choice(__('[0]Are you sure?|[1]Are you sure?') . ' ' . __('This action will replace all the contents of the workplan.'), null, $user->getProfile()->getIsMale()), 'title'=>sprintf(__('Import this workplan from the database, replacing all the contents of «%s»'), $workplan))
				)?>
				</li>
			</ul>
