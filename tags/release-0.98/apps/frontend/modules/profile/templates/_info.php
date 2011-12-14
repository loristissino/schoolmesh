<div class="info">
  <h3><?php echo __("Dashboard") ?></h3>
   <p>
  <?php if(!$sf_user->isAuthenticated()): ?>
        <?php echo __("Soft authentication: ") ?>
        <?php if (isset($softuser)): ?>
            <?php if($softuser->getProfile()->getIsMale()): ?>
                <?php echo __("you were recognized as user <b>%username%</b>  (%fullname%) by means of network logs. <!--male-->", 
                array('%username%'=>$softuser->getUsername(), '%fullname%'=>$softuser->getProfile()->getFullname())) ?>
            <?php else: ?>
                <?php echo __("you were recognized as user <b>%username%</b>  (%fullname%) by means of network logs. <!--female-->", 
                array('%username%'=>$softuser->getUsername(), '%fullname%'=>$softuser->getProfile()->getFullname())) ?>
            <?php endif; ?>
        <?php else: ?>
            <?php echo __('you were not recognized.') ?>
        <?php endif; ?>
        <?php echo link_to(__('You may login'), '@sf_guard_signin') ?>

  <?php else: ?>
    <?php echo __("Normal authentication: ") ?>
        <?php echo __("you logged in as user <b>%username%</b>  (%fullname%).", 
        array('%username%'=>$sf_user->getUsername(), '%fullname%'=>$sf_user->getProfile()->getFullname())) ?>
        <?php if ((is_object($softuser)&&($sf_user->getUsername()!=$softuser))): ?>
            <?php if($sf_user->getProfile()->getIsMale()): ?>
                <?php echo __("It seems you are a guest of %fullname%. <!--male-->", array('%fullname%'=>$softuser->getProfile()->getFullname())) ?>
            <?php else: ?>
                <?php echo __("It seems you are a guest of %fullname%. <!--female-->", array('%fullname%'=>$softuser->getProfile()->getFullname())) ?>
            <?php endif ?>
        <?php endif; ?>
        
        <?php echo link_to(__('You may logout'), '@sf_guard_signout') ?>
        </p>
		
		<?php if ($sf_user->getProfile()->getEmailState()==sfGuardUserProfilePeer::EMAIL_UNDEFINED): ?>
			<p class="schoolmesh_profile_notices">
			<?php echo format_number_choice(__('[0]Please, set an email address in your profile.|[1]Please, set an email address in your profile.'), null, $sf_user->getProfile()->getIsMale()) ?>
			<?php echo format_number_choice(__('[0]It will be easier to keep you informed on updates about the use of this application.|[1]]It will be easier to keep you informed on updates about the use of this application.'), null, $sf_user->getProfile()->getIsMale()) ?><br />
			<?php echo link_to(
				format_number_choice(__('[0]Just edit your SchoolMesh account information.|[1]Just edit your SchoolMesh account information.'), null, $sf_user->getProfile()->getIsMale()),
				url_for('profile/editprofile')
				)
			?>
			<?php echo __('Thank you.') ?> 
			</p>
		<?php endif ?>

		<?php if ($sf_user->getProfile()->getEmailState()==sfGuardUserProfilePeer::EMAIL_WAITINGVALIDATION): ?>
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
    
  <?php endif ?>

</div>
