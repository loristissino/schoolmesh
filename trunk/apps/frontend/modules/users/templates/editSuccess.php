<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'users/index' =>__('Users'),
    'users/list' => __('List/Search'),
    ),
  'current'=>$current_user->getFullname(),
  ))
?>

<?php include_partial('content/flashes'); ?>

<?php include_component('profile', 'gravatar', array('profile'=>$current_user, 'size'=>96)) ?>

<form action="<?php echo url_for('users/edit?id='. $current_user->getSfGuardUser()->getId()) ?>" method="post">

<h2><?php echo __('Basic information') ?></h2>

  <table>
    <?php echo $userform ?>
	<?php if ($current_user->getCurrentSchoolclassId()): ?>
	<tr>
		<th><label><?php echo __('Schoolclass') ?></label></th>
		<td>
			<?php echo $current_user->getCurrentSchoolclassId() ?>
		</td>
	</tr>
	<?php endif ?>
	<tr>
      <td colspan="2">
         <input type="submit" name="save" value="<?php echo __('Save') ?>">
      </td>
    </tr>
	<?php if($current_user->getIsScheduledForDeletion()): ?>
	<tr>
      <td colspan="2">
         <input type="submit" name="undelete" value="<?php echo __('Undelete') ?>">
      </td>
    </tr>
	<?php else: ?>
		<?php if($current_user->getIsDeletable()): ?>
		<tr>
		  <td colspan="2">
			 <input type="submit" name="delete" value="<?php echo __('Delete') ?>">
		  </td>
		</tr>
		<?php endif ?>
	<?php endif ?>
  </table>


<?php if ($current_user->getRole() && $current_user->getRole()->getPosixName()==sfConfig::get('app_config_students_default_posix_group')): ?>
	<?php include_partial('enrolments', array('current_user'=>$current_user)) ?>
<?php endif ?>

<?php if ($current_user->getRole() && $current_user->getRole()->getPosixName()==sfConfig::get('app_config_teachers_default_posix_group')): ?>
	<?php include_partial('appointments', array('current_user'=>$current_user)) ?>
<?php endif ?>

<?php if($sf_user->hasCredential('admin')): ?>
  <?php include_partial('accounts', array('current_user'=>$current_user, 'available_accounts'=>$available_accounts)) ?>
<?php endif ?>
	
<?php if($sf_user->hasCredential('teams')): ?>
  <?php include_partial('teams', array('current_user'=>$current_user)) ?>
<?php endif ?>

<?php if($sf_user->hasCredential('admin')): ?>
  <?php include_partial('guardgroups', array('current_user'=>$current_user)) ?>
<?php endif ?>

<?php if($sf_user->hasCredential('admin')): ?>
  <?php include_partial('credentials', array('current_user'=>$current_user)) ?>
<?php endif ?>


<h2><?php echo __('Actions') ?></h2>

	<ul class="sf_admin_actions">
	<li class="sf_admin_action_userchecks">
		<?php echo link_to(__('Run user checks for %user%', array('%user%'=>$current_user->getUsername())), url_for('users/runuserchecks?id=' . $current_user->getUserId())) ?>
	</li><br />
	<li class="sf_admin_action_log">
		<?php echo link_to(__('View LAN access logs for %user%', array('%user%'=>$current_user->getUsername())), url_for('lanlog/viewbyuser?id=' . $current_user->getUserId())) ?>
	</li><br />
	</ul>

