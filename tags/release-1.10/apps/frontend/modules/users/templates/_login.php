	<tr>
		<th><label><?php echo __('Last known login') ?></label></th>
		<td>
			<?php echo Generic::datetime($account->getAccountInfo('lastlogin_at'), $sf_context) ?>
		</td>
	</tr>
