<?php use_helper('jQuery') ?>
<div id='quotas_update'>
<table>
	<tr>
		<th><label>Used blocks</label></th>
		<td><?php echo $current_user->getDiskUsedBlocks() ?></td>
	</tr>
	<tr>
		<th><label>Used files</label></th>
		<td><?php echo $current_user->getDiskUsedFiles() ?></td>
	</tr>
	<tr>
		<th><label>Last check</label></th>
		<td><?php echo $current_user->getDiskUpdatedAt() ?></td>
	</tr>
	<tr>
		<th><label><?php echo __('Actions') ?></label></th>
		<td>
		<?php
			echo jq_link_to_remote(
				__('Check now'),
				array(
					'update'=>'quotas_update',
					'url'=>'users/updatequota?id=' . $current_user->getUserId())
		)
		?>
		</td>
	</tr>
</table>
</div>
