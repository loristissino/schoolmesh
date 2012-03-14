<?php include_partial('content/breadcrumps', array(
  'current'=>__('My profile'),
  'title'=>__('%user%\'s profile', array('%user%'=>$sf_user->getProfile()->getFullname()))
  ))
?>

<?php include_partial('content/flashes'); ?>

<?php if ($sf_user->hasCredential('wpfr_submission') or $sf_user->hasCredential('proj_coordination') or $sf_user->hasCredential('proj_activity')): ?>
<h2><?php echo __('Appointments and projects') ?></h2>
<ul class="sf_admin_actions">
  <?php echo li_link_to_if('action_items', $sf_user->hasCredential('wpfr_submission'), __('My appointments'), '@plansandreports') ?>
  <?php echo li_link_to_if('action_items', $sf_user->hasCredential('proj_coordination'), __('My projects'), 'projects/index') ?>
  <?php echo li_link_to_if('action_items', $sf_user->hasCredential('proj_activity'), __('My activities'), 'projects/activities') ?>
</ul>
<?php endif ?>


<?php if (
  $sf_user->hasCredential('admin') or 
  $sf_user->hasCredential('proj_monitoring') or 
  $sf_user->hasCredential('wpfr_monitoring')
  ): ?>
<h2><?php echo __('Administration') ?></h2>
<ul class="sf_admin_actions">
  <?php echo li_link_to_if('action_items', $sf_user->hasCredential('wpfr_monitoring'), __('Appointments management'), 'plansandreports/list') ?>
  <?php echo li_link_to_if('action_items', $sf_user->hasCredential('proj_monitoring'), __('Projects management'), 'projects/monitor') ?>
  <?php echo li_link_to_if('action_items', $sf_user->hasCredential('proj_adm_ok'), __('Projects resource types definitions'), '@proj_resource_type') ?>
	<?php echo li_link_to_if('action_users', $sf_user->hasCredential('admin'), __('Users management'), url_for('users')) ?>
	<?php echo li_link_to_if('action_users', $sf_user->hasCredential('teams'), __('Teams management'), url_for('teams/index')) ?>
	<?php echo li_link_to_if('action_items', $sf_user->hasCredential('backadmin'), __('Appointment types'), url_for('appointmenttypes/index')) ?>
</ul>
<?php endif ?>


<?php if ($sf_user->hasCredential('internet') or $sf_user->hasCredential('filebrowsing')): ?>
<h2><?php echo __('Local Area Network') ?></h2>
<ul class="sf_admin_actions">
  <?php echo li_link_to_if('action_internetaccesson', $sf_user->hasCredential('internet'), __('Web access management'), url_for('lan/index')) ?>
  <?php echo li_link_to_if('action_items', $sf_user->hasCredential('filebrowsing'),__('Remote management of files on the server'), url_for('filebrowser/index'))  ?>
</ul>
<?php endif ?>

<h2><?php echo __('Accounts and teams') ?></h2>

<ul class="sf_admin_actions">
<?php echo li_link_to_if('action_schoolmesh highlighted', true, __('SchoolMesh main account'), url_for('profile/editprofile')) ?>
<?php if(sizeof($accounts)>0): ?>
  <?php foreach($accounts as $account): ?>
  <li class="sf_admin_action_<?php echo $account->getAccountType() ?>"><?php echo link_to(__($account->__toString()), url_for(('profile/viewaccount?type='. $account->getAccountType()))) ?></li><br />
  <?php endforeach ?>
<?php endif ?>
<?php echo li_link_to_if('action_users', sizeof($teams)>0, __('My teams'), url_for(('profile/teams')), array('title'=>__('Teams I belong to'))) ?>

</ul>



<?php /* better to keep this secret for users... */ /* 
<h2><?php echo __('Credentials') ?></h2>

<pre>
<?php foreach($sf_user->getProfile()->getWebpermissions() as $permission): ?>
<?php echo $permission . "\n"?>
<?php endforeach ?>
</pre>
*/ ?>

<?php /*
<?php if ($sf_user->getProfile()->getGoogleappsAccountApprovedAt()): ?>
	<li class="sf_admin_action_googleapps"><?php echo link_to(sprintf(__('Use Google Apps account «%s»'), sfConfig::get('app_config_googleapps_domain')), url_for('profile/googleapps')) ?></li><br />
	<?php else: ?>
	<li class="sf_admin_action_googleapps"><?php echo link_to(sprintf(__('Ask for a Google Apps account «%s»'), sfConfig::get('app_config_googleapps_domain')), url_for('profile/googleapps')) ?></li><br />
<?php endif ?>
*/ ?>

