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
<?php
/*


<?php use_helper('Javascript') ?>
<div id='googleapps_update'>
<table>
	<tr>
		<th><label><?php echo __('Account status') ?></label></th>
		<td>
		<?php $ga_states=Workflow::getGoogleappsAccountStatusses(); ?>
		<?php echo __($ga_states[$current_user->getGoogleappsAccountStatus()]) ?>
		</td>
	</tr>
	<tr>
		<th><label><?php echo __('Account approved?') ?></label></th>
		<td>
		<?php if($current_user->getGoogleappsAccountApprovedAt()): ?>
			<?php echo sprintf(__('Approved on %s'), $current_user->getGoogleappsAccountApprovedAt()) ?>
		<?php else: ?>
			<?php echo __('Not approved') ?>
		<?php endif ?>
		</td>
	</tr>
<?php if($current_user->getGoogleappsAccountTemporaryPassword()): ?>
	<tr>
		<th><label><?php echo __('Temporary password') ?></label></th>
		<td>
		<?php echo $current_user->getGoogleappsAccountTemporaryPassword() ?>
		</td>
	</tr>
<?php endif ?>
	<tr>
		<th><label><?php echo __('Actions') ?></label></th>
		<td>
		<?php if($current_user->getGoogleappsAccountApprovedAt()): ?>
			<?php
				echo link_to_remote(
					__('Remove approval'),
					array(
						'update'=>'googleapps_update',
						'url'=>url_for('users/googleapps?id=' . $current_user->getUserId() . '&todo=disable'),
						'confirm'=>sprintf(__('You are about to remove the approval for Google Apps account of «%s».'), $current_user->getUsername()) . ' ' . __('Are you sure?'))
			)
			?>
		<?php else: ?>
			<?php
				echo link_to_remote(
					__('Approve account'),
					array(
						'update'=>'googleapps_update',
						'url'=>url_for('users/googleapps?id=' . $current_user->getUserId() . '&todo=enable'))
			)
			?>
		<?php endif ?>
		</td>
	</tr>
</table>
</div>


*/
?>