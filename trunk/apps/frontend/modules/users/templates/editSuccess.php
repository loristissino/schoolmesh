<?php use_helper('Javascript') ?>
<?php use_helper('Form') ?>
<?php use_helper('Object') ?>

<?php slot('title', __('User management')) ?>
<?php slot('breadcrumbs',
	link_to(__("User management"), 'users/index') . ' » ' .
	link_to(__("User list"), 'users/list') . ' » ' .
	$current_user
	)
	
	?><h1><?php echo sprintf(__('Edit user %s'), $current_user)?></h1>

<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="notice"><?php echo $sf_user->getFlash('notice')?></div>
<?php endif; ?>
<?php if ($sf_user->hasFlash('error')): ?>
  <div class="error"><?php echo $sf_user->getFlash('error')?></div>
<?php endif; ?>
<?php if ($current_user->getSystemAlerts()!=''): ?>
  <div class="alert"><?php echo $current_user->getSystemAlerts()?></div>
<?php endif; ?>

<form action="<?php echo url_for('users/edit?id='. $current_user->getSfGuardUser()->getId()) ?>" method="POST">

<h2><?php echo __('Basic information') ?></h2>

  <table>
	<tr>
		<th><label><?php echo __('Import code') ?></label></th>
		<td>
			<?php echo $current_user->getImportCode() ?>
		</td>
	</tr>
    <?php echo $userform ?>
	<tr>
      <td colspan="2">
         <input type="submit" name="save" value="<?php echo __('Save') ?>">
      </td>
    </tr>
	<?php if($current_user->getIsDeleted()): ?>
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

<h2><?php echo __('Disk usage') ?></h2>

<?php include_partial('quotas', array('current_user'=>$current_user)) ?>

<h2><?php echo __('Credentials') ?></h2>

<?php include_partial('credentials', array('current_user'=>$current_user)) ?>

<h2><?php echo __('Teams') ?></h2>

<?php include_partial('teams', array('current_user'=>$current_user)) ?>

<h2><?php echo __('Google Apps account') ?></h2>

<?php include_partial('googleapps', array('current_user'=>$current_user)) ?>

<h2><?php echo __('Actions') ?></h2>

	<ul class="sf_admin_actions">
	<li class="sf_admin_action_userchecks">
		<?php echo link_to(__('Run user checks'), url_for('users/runuserchecks?id=' . $current_user->getUserId())) ?>
	</li><br />
	</ul>


