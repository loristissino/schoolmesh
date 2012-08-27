<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'profile/index' =>__('My profile')
    ),
  'current'=>__('SchoolMesh main account'),
  ))
?>

<?php include_partial('content/flashes'); ?>

<form action="<?php echo url_for('profile/editprofile') ?>" method="post">

  <table>
	<tr>
		<th><label><?php echo __('Username') ?></label></th>
		<td>
			<strong><?php echo $sf_user->getUsername() ?></strong>
		</td>
	</tr>
	<tr>
		<th><label><?php echo __('First name') ?></label></th>
		<td>
			<?php echo $profile->getFirstName() ?>
		</td>
	</tr>
	<tr>
		<th><label><?php echo __('Middle name') ?></label></th>
		<td>
			<?php echo $profile->getMiddleName() ?>
		</td>
	</tr>
	<tr>
		<th><label><?php echo __('Last name') ?></label></th>
		<td>
			<?php echo $profile->getLastName() ?>
		</td>
	</tr>
	<tr>
		<th><label><?php echo __('Birthdate') ?></label></th>
		<td>
			<?php echo $profile->getBirthdate('d/m/Y') ?>
		</td>
	</tr>
	<tr>
		<th><label><?php echo __('Birthplace') ?></label></th>
		<td>
			<?php echo $profile->getBirthplace() ?>
		</td>
	</tr>
    <?php echo $form ?>
	<?php if($profile->getEmail()!=''): ?>
	<tr>
		<th><label><?php echo __('Email status') ?></label></th>
		<td>
			<?php echo __($profile->getEmailStateDescription()) ?>
      <?php if($profile->getEmailState()!=sfGuardUserProfilePeer::EMAIL_VERIFIED and $profile->getEmail()): ?>
        <?php echo link_to(
          __('Send another verification code'),
          'profile/sendverificationcode',
          array(
            /* ideally, we should use post here, but this prevents from using a popup window */
            'popup' => array('popupWindow', 'width=600,height=100,left=250,top=0,scrollbars=yes')
            )
          )
        ?>
      <?php endif ?>
		</td>
	</tr>
	<?php endif ?>
	<?php if(sfConfig::get('app_authentication_2fa_enabled', false)): ?>
	<tr>
		<th><label><?php echo __('2fa') ?></label></th>
		<td>
			<?php if($profile->getInitializationKey()): ?>
        <?php echo __('Two-factor authentication currently enabled.') ?><br />
        <?php echo link_to(__('Get your smartphone configured'), url_for('profile/authenticator')) ?>
      <?php else: ?>
        <?php echo __('Two-factor authentication currently disabled.') ?>
      <?php endif ?>
		</td>
	</tr>
	<?php endif ?>
	<tr>
      <td colspan="2">
         <input type="submit" name="save" value="<?php echo __('Save') ?>">
      </td>
    </tr>
  </table>
  
  <hr />
  
  <h2><?php echo __('Actions') ?></h2>
  <ul class="sf_admin_actions">
    <?php echo li_link_to_if(
    'action_passwordreset',
    true,
		__('Change password'),
		'profile/changepassword',
		array('title'=>__('Change the password for your SchoolMesh account'))
		)?>
    <?php echo li_link_to_if(
    'action_enable2fa',
    sfConfig::get('app_authentication_2fa_enabled', false) && !$sf_user->getProfile()->getInitializationKey(),
		__('Enable two-factor authentication'),
		'profile/enable2fa',
		array('title'=>__('Enable two-factor authentication for your SchoolMesh account'))
		)?>
    <?php echo li_link_to_if(
    'action_disable2fa',
    sfConfig::get('app_authentication_2fa_enabled', false) && $sf_user->getProfile()->getInitializationKey(),
		__('Disable two-factor authentication'),
		'profile/disable2fa',
		array(
      'title'=>__('Disable two-factor authentication for your SchoolMesh account'), 
      'confirm' => format_number_choice(__('[0]Are you sure?|[1]Are you sure?'), null, $sf_user->getProfile()->getIsMale()) . ' ' . __('You will need to reconfigure all your mobile devices if you disable and then re-enable two-factor authentication.'),
      )
		)?>
  </ul>
