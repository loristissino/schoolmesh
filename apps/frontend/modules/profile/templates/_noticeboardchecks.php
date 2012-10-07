		<?php if ($sf_user->getProfile()->getEmailState()==sfGuardUserProfilePeer::EMAIL_UNDEFINED): ?>
			<p class="schoolmesh_profile_notices">
			<?php echo format_number_choice(__('[0]Please, set an email address in your profile.|[1]Please, set an email address in your profile.'), null, $sf_user->getProfile()->getIsMale()) ?>
			<?php echo format_number_choice(__('[0]It will be easier to keep you informed on updates about the use of this application.|[1]It will be easier to keep you informed on updates about the use of this application.'), null, $sf_user->getProfile()->getIsMale()) ?><br />
			<?php echo link_to(
				format_number_choice(__('[0]Just edit your SchoolMesh account information.|[1]Just edit your SchoolMesh account information.'), null, $sf_user->getProfile()->getIsMale()),
				url_for('profile/editprofile')
				)
			?>
			<?php echo __('Thank you.') ?> 
			</p>
		<?php endif ?>
    
		<?php if ($sf_user->getProfile()->getEmailState()==sfGuardUserProfilePeer::EMAIL_UNVERIFIED): ?>
			<p class="schoolmesh_profile_notices">
			<?php echo __('Your email address has not been validated yet.') ?>
			<?php echo link_to(
				__('Check your profile for information.'),
				url_for('profile/editprofile')
				)
			?>
			<?php echo __('Thank you.') ?> 
			</p>
		<?php endif ?>

		<?php if ($sf_user->getProfile()->getEmailState()==sfGuardUserProfilePeer::EMAIL_FAULTY): ?>
			<p class="schoolmesh_profile_notices">
			<?php echo __('Your email address is faulty.') ?>
			<?php echo link_to(
				__('Check your profile for information.'),
				url_for('profile/editprofile')
				)
			?>
			<?php echo __('Thank you.') ?> 
			</p>
		<?php endif ?>
