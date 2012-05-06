<div id="accounts">
<h2><?php echo __('Accounts') ?></h2>

	<table>
	  <thead>
    <tr>
      <th class="sf_admin_text"><?php echo __('Name') ?></th>
      <th class="sf_admin_text"><?php echo __('Credential') ?></th>
      <th class="sf_admin_text"><?php echo __('Account') ?></th>
      <th class="sf_admin_text"><?php echo __('Really exists?') ?></th>
      <th class="sf_admin_text"><?php echo __('Is locked?') ?></th>
      <th class="sf_admin_text"><?php echo __('Last sync') ?></th>
      <th class="sf_admin_text"><?php echo __('Last known login') ?></th>
      <th class="sf_admin_text"><?php echo __('Quota') ?></th>
      <th class="sf_admin_text"><?php echo __('Actions') ?></th>
    </tr>
  </thead>
<tbody>  
	<?php foreach($available_accounts as $available_account): ?>
	<tr>
		<th><?php echo image_tag($available_account) ?>&nbsp;<?php echo $available_account ?></th>
		<td>
			<?php echo $current_user->hasPermission($available_account)?__('enabled'):__('disabled') ?>
		</td>
		<td>
			<?php echo get_partial('content/list_field_boolean', array('value' => $current_user->hasAccountOfType($available_account))) ?>
		</td>
		<?php if($current_user->hasAccountOfType($available_account)): ?>
		<?php $account=$current_user->getAccountByType($available_account) ?>
		<td>
			<?php echo get_partial('content/list_field_boolean', array('value' => $account->getExists())) ?>
		</td>
		<td>
			<?php echo get_partial('content/list_field_boolean', array('value' => $account->getIsLocked())) ?>
		</td>
		<td>
			<?php echo Generic::datetime($account->getInfoUpdatedAt('U'), $sf_context) ?>
      <?php if (time() - $account->getInfoUpdatedAt('U')>86400): ?>
        <?php echo image_tag('dubious', array(
          'title'=>__('Last sync was done more than one day ago')
          )) ?>
      <?php endif ?>
		</td>
		<td>
			<?php echo Generic::datetime($account->getLastKnownLoginAt('U'), $sf_context) ?>
		</td>
		<td>
			<?php echo $account->getQuotaPercentage() ? $account->getQuotaPercentage() . '%':'' ?>
		</td>
		<?php else: ?>
		<td colspan="5"></td>
		<?php endif ?>
		<td>
			<ul class="sf_admin_td_actions">
				<?php if ($current_user->hasAccountOfType($available_account)): ?>
					<li class="sf_admin_action_edit">
						<?php echo link_to(
					__('Edit'),
					'users/editaccount?id='.$account->getId(),
					array('title'=>__('Edit information about this account'))
					)?>
					</li>
					<?php if ($account->getExists()&&$account->getPasswordIsResettable()): ?>
						<li class="sf_admin_action_passwordreset">
							<?php echo link_to(
						__('Reset password'),
						'passwordreset/confirm?username=' . $current_user->getUsername() . '&account=' . $account->getAccountType() . '&choose=Choose',
						array('title'=>__('Reset the password for this account'))
						)?>
						</li>
					<?php endif ?>
					<?php if ($account->getExists()&&$account->getIsLocked()&&($account->getAccountIsUnlockable())): ?>
						<li class="sf_admin_action_unlock">
							<?php echo link_to(
						__('Unlock account'),
						'users/unlock?username=' . $current_user->getUsername() . '&account=' . $account->getAccountType(),
						array(
              'method' => 'put',
              'confirm' => format_number_choice(__('[0]Are you sure?|[1]Are you sure?'), null, $sf_user->getProfile()->getIsMale()),
              'title'=>__('Unlock this account'))
						)?>
						</li>
					<?php endif ?>
				<?php endif ?>
			</ul>
		</td>
	</tr>
	<?php endforeach ?>
	</tbody>
	</table>
</div>
