<?php include_partial('content/breadcrumps', array(
  'current'=>__('My profile'),
  'title'=>__('%user%\'s profile', array('%user%'=>$sf_user->getProfile()->getFullname()))
  ))
?>

<?php if ($sf_user->hasCredential('wpfr_submission') or $sf_user->hasCredential('proj_coordination') or $sf_user->hasCredential('proj_activity')): ?>
<h2><?php echo __('Appointments and projects') ?></h2>
<ul class="sf_admin_actions">
    <?php if ($sf_user->hasCredential('wpfr_submission')): ?>
      <li class="sf_admin_action_items"><?php echo link_to(__('My appointments'), '@plansandreports') ?></li><br />
    <?php endif ?>
    <?php if ($sf_user->hasCredential('proj_coordination')): ?>
      <li class="sf_admin_action_items"><?php echo link_to(__('My projects'), 'projects/index') ?></li><br />
    <?php endif ?>
    <?php if ($sf_user->hasCredential('proj_activity')): ?>
      <li class="sf_admin_action_items"><?php echo link_to(__('My activities'), 'projects/activities') ?></li><br />
    <?php endif ?>
</ul>
<?php endif ?>


<?php if (
  $sf_user->hasCredential('admin') or 
  $sf_user->hasCredential('proj_monitoring') or 
  $sf_user->hasCredential('wpfr_monitoring')
  ): ?>
<h2><?php echo __('Administration') ?></h2>
<ul class="sf_admin_actions">
<?php if ($sf_user->hasCredential('wpfr_monitoring')): ?>
    <li class="sf_admin_action_items"><?php echo link_to(__('Manage appointments'), 'plansandreports/list') ?></li><br />
<?php endif ?>
<?php if ($sf_user->hasCredential('proj_monitoring')): ?>
    <li class="sf_admin_action_items"><?php echo link_to(__('Projects monitoring'), 'projects/monitor') ?></li><br />
<?php endif ?>
<?php if ($sf_user->hasCredential('proj_adm_ok')): ?>
    <li class="sf_admin_action_items"><?php echo link_to(__('Projects resource types definitions'), '@proj_resource_type') ?></li><br />
<?php endif ?>
<?php if ($sf_user->hasCredential('admin')): ?>
	<li class="sf_admin_action_users"><?php echo link_to(__('Users management'), url_for('users')) ?></li><br />
<?php endif ?>
</ul>
<?php endif ?>



<?php if ($sf_user->hasCredential('filebrowsing')): ?>
<h2><?php echo __('My files') ?></h2>
<ul class="sf_admin_actions">
    <li class="sf_admin_action_items"><?php echo link_to(__('Remote management of files on the server'), url_for('filebrowser/index')) ?></li>
</ul>
<?php endif ?>


<h2><?php echo __('Accounts') ?></h2>

<ul class="sf_admin_actions">
<li class="sf_admin_action_schoolmesh"><strong><?php echo link_to(__('SchoolMesh main account'), url_for('profile/editprofile')) ?></strong></li><br />
<?php if(sizeof($accounts)>0): ?>
<?php foreach($accounts as $account): ?>
<li class="sf_admin_action_<?php echo $account->getAccountType() ?>"><?php echo link_to(__($account->__toString()), url_for(('profile/viewaccount?type='. $account->getAccountType()))) ?></li><br />
<?php endforeach ?>
<?php endif ?>
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

