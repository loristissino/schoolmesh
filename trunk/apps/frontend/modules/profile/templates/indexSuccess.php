<?php include_partial('content/breadcrumps', array(
  'current'=>__('My profile'),
  'title'=>__('%user%\'s profile', array('%user%'=>$sf_user->getProfile()->getFullname()))
  ))
?>

<?php /*
<?php if (sizeof($appointments)>0): ?>
<h2><?php echo __('What I teach') ?></h2>
<ul class="sf_admin_actions">
<?php foreach ($appointments as $appointment): ?>
    <li class="sf_admin_action_fill"><?php echo link_to(
		$appointment->getSubject()->getDescription() . ' -> '. $appointment->getSchoolclass() . ' (' . $appointment->getYear() . ')',
		url_for('plansandreports/fill?id=' . $appointment->getId())
		)
		?><br />
		</li>
<?php endforeach ?>
</ul>
<?php endif ?>

*/ ?>


<?php if ($sf_user->hasCredential('planning')): ?>
<h2><?php echo __('Appointments and projects') ?></h2>
<ul class="sf_admin_actions">
    <li class="sf_admin_action_items"><?php echo link_to(__('My appointments'), '@plansandreports') ?></li><br />
    <li class="sf_admin_action_items"><?php echo link_to(__('My projects'), 'projects/index') ?></li><br />
    <li class="sf_admin_action_items"><?php echo link_to(__('My activities'), 'projects/activities') ?></li><br />
</ul>
<?php endif ?>

<?php /*
<?php if (sizeof($schoolclasses)>0): ?>
<h2><?php echo __('My classes') ?></h2>
<ul class="sf_admin_actions">
<?php foreach ($schoolclasses as $schoolclass_id => $schoolclass_subjectsnb): ?>
    <li class="sf_admin_action_users"><?php echo link_to(
		$schoolclass_id,
		url_for('schoolclasses/view?id=' . $schoolclass_id)
		)
		?>
		<?php if ($schoolclass_subjectsnb>1): ?>
			(<strong><?php echo format_number_choice('[0]no subjects|[1]one subject|(1,+Inf]%1% subjects', array('%1%'=>$schoolclass_subjectsnb), $schoolclass_subjectsnb) ?></strong>)
		<?php endif ?>
			<br />
		</li>
<?php endforeach ?>
</ul>
<?php endif ?>

*/ ?>

<?php /*
<h2><?php echo __('Activities') ?></h2>
*?>
<?php /* Since we don't really use this, we keep it secret 
<?php if (sizeof($teams)>0): ?>

<h2><?php echo __('Which groups I belong to') ?></h2>
<ul>
<?php for($i=0; $i<sizeof($teams); $i++): ?>
    <li><?php echo $teams[$i]->getTeam()->getDescription(); ?> (<?php echo $profile->getIsMale()? $teams[$i]->getRole()->getMaleDescription(): $teams[$i]->getRole()->getFemaleDescription(); ?>)</li>    
<?php endfor ?>

</ul>
<?php endif ?>

*/ ?>

<?php if ($sf_user->hasCredential('admin')  or $sf_user->hasCredential('schoolmaster') or $sf_user->hasCredential('project')): ?>
<h2><?php echo __('Administration') ?></h2>
<ul class="sf_admin_actions">
<?php if ($sf_user->hasCredential('office') or $sf_user->hasCredential('schoolmaster')): ?>
    <li class="sf_admin_action_items"><?php echo link_to(__('Manage appointments'), 'plansandreports/list') ?></li><br />
<?php endif ?>

<?php if ($sf_user->hasCredential('project') or $sf_user->hasCredential('schoolmaster')): ?>
    <li class="sf_admin_action_items"><?php echo link_to(__('Projects monitoring'), 'projects/monitor') ?></li><br />
<?php endif ?>
	<li class="sf_admin_action_users"><?php echo link_to(__('Users management'), url_for('users')) ?></li><br />
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
<?php if(sizeof($sf_user->getProfile()->getAccounts())>0): ?>
<?php foreach($sf_user->getProfile()->getAccounts() as $account): ?>
<li class="sf_admin_action_<?php echo $account->getAccountType() ?>"><?php echo link_to(__($account->__toString()), url_for(('profile/viewaccount?type='. $account->getAccountType()))) ?></li><br />
<?php endforeach ?>
<?php endif ?>
</ul>


<?php /*
<?php if ($sf_user->getProfile()->getGoogleappsAccountApprovedAt()): ?>
	<li class="sf_admin_action_googleapps"><?php echo link_to(sprintf(__('Use Google Apps account «%s»'), sfConfig::get('app_config_googleapps_domain')), url_for('profile/googleapps')) ?></li><br />
	<?php else: ?>
	<li class="sf_admin_action_googleapps"><?php echo link_to(sprintf(__('Ask for a Google Apps account «%s»'), sfConfig::get('app_config_googleapps_domain')), url_for('profile/googleapps')) ?></li><br />
<?php endif ?>
*/ ?>

