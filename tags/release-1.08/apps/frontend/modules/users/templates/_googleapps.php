<?php /*      'account_id',
      'account_name',
      'status',
      'quota_in_mb',
      'usage_in_bytes',
      'primary_account_id',
      'primary_account_name',
      'creation_date',
      'last_login_date',
      'last_web_mail_date',
      'surname',
      'given_name',
      'service_tier',
      'channel',
      'suspension_reason',
      'last_pop_date',
      'creation_time',
      'last_login_time',
      'last_web_mail_time',
      'last_pop_time'

*/ ?>

<tr>
		<th><label><?php echo __('Account Id') ?></label></th>
		<td>
			<?php echo $account->getAccountInfo('account_id') ?>
		</td>
	</tr>
	<tr>
		<th><label><?php echo __('Status') ?></label></th>
		<td>
			<?php echo $account->getAccountInfo('status') ?>
		</td>
	</tr>
