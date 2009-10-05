<?php slot('breadcrumbs',
	__('My profile')
	)	
	?>
<?php slot('title') ?>
<?php echo sprintf(__('%s\'s profile'), $sf_user->getProfile()->getFullname()) ?>
<?php end_slot() ?>

<h1><?php echo __('%fullname%: my profile', array('%fullname%' => $sf_user->getProfile()->getFullname())) ?></h1>
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
<h2><?php echo __('My appointments') ?></h2>
<ul class="sf_admin_actions">
    <li class="sf_admin_action_items"><?php echo link_to(__('Full view of plans and reports'), '@plansandreports') ?></li>
</ul>
<?php endif ?>

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


<?php if ($sf_user->hasCredential('office') || $sf_user->hasCredential('schoolmasterteam')): ?>
<h2><?php echo __('Office actions') ?></h2>
<ul class="sf_admin_actions">
    <li class="sf_admin_action_items"><?php echo link_to('Manage appointments', 'plansandreports/list') ?></li>
</ul>
<?php endif ?>

<?php if (sizeof($teams)>0): ?>

<h2><?php echo __('Which groups I belong to') ?></h2>
<ul>
<?php for($i=0; $i<sizeof($teams); $i++): ?>
    <li><?php echo $teams[$i]->getTeam()->getDescription(); ?> (<?php echo $profile->getIsMale()? $teams[$i]->getRole()->getMaleDescription(): $teams[$i]->getRole()->getFemaleDescription(); ?>)</li>    
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