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
		<?php echo $current_user->getGoogleappsAccountApprovedAt() ?>
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
					__('Disable'),
					array(
						'update'=>'googleapps_update',
						'url'=>url_for('users/googleapps?id=' . $current_user->getUserId() . '&todo=disable'))
			)
			?>
		<?php else: ?>
			<?php
				echo link_to_remote(
					__('Enable'),
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


