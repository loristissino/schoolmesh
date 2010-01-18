<?php use_helper('Javascript') ?>
<?php use_helper('Form') ?>
<?php use_helper('Object') ?>

<?php slot('title', __('Profile')) ?>
<?php slot('breadcrumbs',
	link_to(__('My profile'), url_for('profile')) . ' » ' .
	$account
	)
	
	?><h1><?php echo $account ?></h1>

<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="notice"><?php echo $sf_user->getFlash('notice')?></div>
<?php endif; ?>
<?php if ($sf_user->hasFlash('error')): ?>
  <div class="error"><?php echo $sf_user->getFlash('error')?></div>
<?php endif; ?>

  <table>
<?php foreach($info as $key=>$value): ?>  
	<tr>
		<th><label><?php echo __($key) ?></label></th>
		<td>
			<?php echo $value ?>
		</td>
	</tr>
<?php endforeach ?>
  </table>

<?php if($account->getPasswordIsResettable()): ?>
<h2><?php echo __('Actions') ?></h2>
<ul class="sf_admin_actions">
	<li class="sf_admin_action_passwordreset"><?php echo link_to(__('Change password'), url_for('profile/changeaccountpassword?type='.$account->getAccountType())) ?></li><br />
</ul>
<?php endif ?>