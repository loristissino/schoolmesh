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

<h2>Form</h2>

<form action="<?php echo url_for('users/edit') ?>" method="POST">
  <table>
    <?php echo $form ?>
    <tr>
      <td colspan="2">
         <input type="submit" value="<?php echo __('Save') ?>">
      </td>
    </tr>
  </table>
</form>


<h2><?php echo __('Basic information') ?></h2>

<?php /*

<ul>
<li><?php echo __('First name') ?>: <strong><?php echo $current_user->getProfile()->getFirstName() ?></strong></li>
<li><?php echo __('Middle name') ?>: <strong><?php echo $current_user->getProfile()->getMiddleName() ?></strong></li>
<li><?php echo __('Last name') ?>: <strong><?php echo $current_user->getProfile()->getLastName() ?></strong></li>
</ul>

<h2><?php echo __('Credentials') ?></h2>
<ul>
	<?php foreach($current_user->getAllPermissions() as $permission): ?>
			<li><?php echo $permission ?></li>
		<?php endforeach ?>
</ul>


*/ ?>