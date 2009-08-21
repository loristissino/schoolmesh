<?php use_helper('Javascript') ?>
<?php use_helper('Form') ?>
<?php use_helper('Object') ?>

<?php slot('title', __('Profile')) ?>
<?php slot('breadcrumbs',
	link_to(__('My profile'), url_for('profile')) . ' » ' .
	__('SchoolMesh account')
	)
	
	?><h1><?php echo __('My profile')?></h1>

<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="notice"><?php echo $sf_user->getFlash('notice')?></div>
<?php endif; ?>
<?php if ($sf_user->hasFlash('error')): ?>
  <div class="error"><?php echo $sf_user->getFlash('error')?></div>
<?php endif; ?>

<form action="<?php echo url_for('profile/editprofile') ?>" method="post">

  <table>
	<tr>
		<th><label><?php echo __('Username') ?></label></th>
		<td>
			<strong><?php echo $sf_user->getUsername() ?></strong>
		</td>
	</tr>
	<tr>
		<th><label><?php echo __('First name') ?></label></th>
		<td>
			<?php echo $profile->getFirstName() ?>
		</td>
	</tr>
	<tr>
		<th><label><?php echo __('Middle name') ?></label></th>
		<td>
			<?php echo $profile->getMiddleName() ?>
		</td>
	</tr>
	<tr>
		<th><label><?php echo __('Last name') ?></label></th>
		<td>
			<?php echo $profile->getLastName() ?>
		</td>
	</tr>
	<tr>
		<th><label><?php echo __('Birthdate') ?></label></th>
		<td>
			<?php echo $profile->getBirthdate('d/m/Y') ?>
		</td>
	</tr>
	<tr>
		<th><label><?php echo __('Birthplace') ?></label></th>
		<td>
			<?php echo $profile->getBirthplace() ?>
		</td>
	</tr>
    <?php echo $form ?>
	<tr>
      <td colspan="2">
         <input type="submit" name="save" value="<?php echo __('Save') ?>">
      </td>
    </tr>
  </table>
