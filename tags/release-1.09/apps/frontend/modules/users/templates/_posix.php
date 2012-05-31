	<tr>
		<th><label><?php echo __('UID') ?></label></th>
		<td>
			<?php echo $account->getAccountInfo('uid') ?>
		</td>
	</tr>
	<tr>
		<th><label><?php echo __('Username') ?></label></th>
		<td>
			<?php echo $account->getAccountInfo('username') ?>
		</td>
	</tr>
	<tr>
		<th><label><?php echo __('Group') ?></label></th>
		<td>
			<?php echo $account->getAccountInfo('group') ?>
		</td>
	</tr>
	<tr>
		<th><label><?php echo __('Used blocks') ?></label></th>
		<td>
			<?php echo $account->getAccountInfo('used_blocks') ?>
		</td>
	</tr>
	<tr>
		<th><label><?php echo __('Used files') ?></label></th>
		<td>
			<?php echo $account->getAccountInfo('used_files') ?>
		</td>
	</tr>
