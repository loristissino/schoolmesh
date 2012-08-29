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
    'action_security',
    sfConfig::get('app_authentication_2fa_enabled', false),
		__('Edit security information'),
		'profile/editsecurity',
		array('title'=>__('Edit security information for your SchoolMesh account'))
		)?>
    
  </ul>
