<?php slot('title', __('User management')) ?>
<?php slot('breadcrumbs',
	link_to(__("User management"), 'users/index') . ' » ' .
	link_to(__("User list"), 'users/list') . ' » ' .
	$current_user
	)
	
	?><h1><?php echo sprintf(__('Edit user %s'), $current_user)?></h1>

<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="notice"><?php echo $sf_user->getFlash('notice')?></div>
<?php endif; ?>
<?php if ($sf_user->hasFlash('error')): ?>
  <div class="error"><?php echo $sf_user->getFlash('error')?></div>
<?php endif; ?>
<?php if ($current_user->getSystemAlerts()!=''): ?>
  <div class="alert"><?php echo $current_user->getSystemAlerts()?></div>
<?php endif; ?>

<form action="<?php echo url_for('users/edit?id='. $current_user->getSfGuardUser()->getId()) ?>" method="post">

<h2><?php echo __('Basic information') ?></h2>

  <table>
	<tr>
		<th><label><?php echo __('Import code') ?></label></th>
		<td>
			<?php echo $current_user->getImportCode() ?>
		</td>
	</tr>
    <?php echo $userform ?>
	<?php if ($current_user->getCurrentSchoolclassId()): ?>
	<tr>
		<th><label><?php echo __('Schoolclass') ?></label></th>
		<td>
			<?php echo $current_user->getCurrentSchoolclassId() ?>
		</td>
	</tr>
	<?php endif ?>
	<tr>
      <td colspan="2">
         <input type="submit" name="save" value="<?php echo __('Save') ?>">
      </td>
    </tr>
	<?php if($current_user->getIsScheduledForDeletion()): ?>
	<tr>
      <td colspan="2">
         <input type="submit" name="undelete" value="<?php echo __('Undelete') ?>">
      </td>
    </tr>
	<?php else: ?>
		<?php if($current_user->getIsDeletable()): ?>
		<tr>
		  <td colspan="2">
			 <input type="submit" name="delete" value="<?php echo __('Delete') ?>">
		  </td>
		</tr>
		<?php endif ?>
	<?php endif ?>
  </table>


<?php if ($current_user->getRole() && $current_user->getRole()->getPosixName()==sfConfig::get('app_config_students_default_posix_group')): ?>
	<h2><?php echo __('Enrolments') ?></h2>
	<?php include_partial('enrolments', array('current_user'=>$current_user)) ?>
<?php endif ?>

<?php if ($current_user->getRole() && $current_user->getRole()->getPosixName()==sfConfig::get('app_config_teachers_default_posix_group')): ?>
	<h2><?php echo __('Appointments') ?></h2>
	<?php include_partial('appointments', array('current_user'=>$current_user)) ?>
<?php endif ?>


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
			<?php echo $current_user->hasAccountOfType($available_account)?__('yes'):__('no') ?>
		</td>
		<?php if($current_user->hasAccountOfType($available_account)): ?>
		<?php $account=$current_user->getAccountByType($available_account) ?>
		<td>
			<?php echo $account->getExists()?__('yes'):__('no') ?>
		</td>
		<td>
			<?php echo $account->getIsLocked()?__('yes'):__('no') ?>
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
	
<h2><?php echo __('Teams') ?></h2>

<?php include_partial('teams', array('current_user'=>$current_user)) ?>

<h2><?php echo __('GuardGroups') ?></h2>

<?php include_partial('guardgroups', array('current_user'=>$current_user)) ?>


<h2><?php echo __('Credentials') ?></h2>

<?php include_partial('credentials', array('current_user'=>$current_user)) ?>


<h2><?php echo __('Actions') ?></h2>

	<ul class="sf_admin_actions">
	<li class="sf_admin_action_userchecks">
		<?php echo link_to(__('Run user checks for %user%', array('%user%'=>$current_user->getUsername())), url_for('users/runuserchecks?id=' . $current_user->getUserId())) ?>
	</li><br />
	</ul>

