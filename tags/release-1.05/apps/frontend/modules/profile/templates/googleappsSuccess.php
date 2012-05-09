<?php slot('breadcrumbs',
	link_to(__('My profile'), 'profile') . ' » ' .
	__('Google Apps account')
	)	
	?>
<?php slot('title') ?>
<?php echo sprintf(__('%s\'s profile'), $sf_user->getProfile()->getFullname()) ?>
<?php end_slot() ?>

<h1><?php echo sprintf(__('Google Apps account «%s»'),  sfConfig::get('app_config_googleapps_domain'))?></h1>

<p><?php echo image_tag('googleapps_big') ?></p>

<?php if($sf_user->getProfile()->getGoogleappsAccountApprovedAt()): ?>
	<p><?php echo __('Account approved') ?></p>
	<p><?php echo __('You may login with the following credentials:') ?></p>
		<ul>
			<li class="sf_admin_action_googleapps"><strong><?php echo __('URL') ?>: </strong><?php echo link_to(sfConfig::get('app_config_googleapps_url'), sfConfig::get('app_config_googleapps_url'), array(
  'popup' => array('popupWindow', 'width=310,height=400,left=320,top=0'))) ?></li>
			<li><strong><?php echo __('Username') ?>: </strong><?php echo $sf_user->getUsername() ?></li>
			<?php if($sf_user->getProfile()->getGoogleappsAccountTemporaryPassword()): ?>
				<li><strong><?php echo __('Temporary password') ?>: </strong><?php echo $sf_user->getProfile()->getGoogleappsAccountTemporaryPassword() ?></li>
			<?php endif ?>
		</ul>
	
<?php else: ?>
	<p><?php echo __('Account not approved (yet).') ?></p>
	<p><?php echo __('Your school will provide you with information about how to get your account activated.') ?></p>
<?php endif ?>

