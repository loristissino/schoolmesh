<?php slot('breadcrumbs',
	__('My profile')
	)	
	?>
<?php slot('title') ?>
<?php echo sprintf(__('%s\'s profile'), $sf_user->getProfile()->getFullname()) ?>
<?php end_slot() ?>

<h1><?php echo __('%fullname%: my profile', array('%fullname%' => $sf_user->getProfile()->getFullname())) ?></h1>

<?php if (sizeof($appointments)>0): ?>
<h2><?php echo __('What I teach') ?></h2>
<ul>
<?php for($i=0; $i<sizeof($appointments); $i++): ?>
    <li><?php echo $appointments[$i]->getSubject()->getDescription() . ' -> '. $appointments[$i]->getSchoolclass() . ' (' . $appointments[$i]->getYear() . ')'; ?></li>    
<?php endfor ?>
</ul>

<p><?php echo link_to('Plans and reports', '@plansandreports') ?></p>

<?php endif ?>

<?php if (sizeof($teams)>0): ?>

<h2><?php echo __('Which groups I belong to') ?></h2>
<ul>
<?php for($i=0; $i<sizeof($teams); $i++): ?>
    <li><?php echo $teams[$i]->getTeam()->getDescription(); ?> (<?php echo $teams[$i]->getRole()->getDescription(); ?>)</li>    
<?php endfor ?>

</ul>
<?php endif ?>

<h2><?php echo __('Actions') ?></h2>

<ul class="sf_admin_actions">
<?php if ($sf_user->hasCredential('admin')): ?>
	<li class="sf_admin_action_users"><?php echo link_to(__('Manage users'), url_for('users')) ?></li><br />
<?php endif ?>
</ul>

<h2><?php echo __('Accounts') ?></h2>

<p>TODO</p>
<?php /*
<?php if ($sf_user->getProfile()->getGoogleappsAccountApprovedAt()): ?>
	<li class="sf_admin_action_googleapps"><?php echo link_to(sprintf(__('Use Google Apps account «%s»'), sfConfig::get('app_config_googleapps_domain')), url_for('profile/googleapps')) ?></li><br />
	<?php else: ?>
	<li class="sf_admin_action_googleapps"><?php echo link_to(sprintf(__('Ask for a Google Apps account «%s»'), sfConfig::get('app_config_googleapps_domain')), url_for('profile/googleapps')) ?></li><br />
<?php endif ?>
*/ ?>