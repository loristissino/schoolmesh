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

<?php if($account->getAccountType()=='posix'): ?>
<h2><?php echo __('Blocks usage') ?></h2>
<?php include_partial('users/quotachart', array(
  'bpp'=>$stats[$sf_user->getUsername()]['info_hard_blocks_quota']/800,
  'chart'=>'blocks',
  'user'=>$sf_user,
  'stats'=>$stats,
  'quota_warning'=>sfConfig::get('app_config_posix_quotawarning', .75),
  'personal_profile'=>true,
  )
)?>
<h2><?php echo __('Files usage') ?></h2>
<?php include_partial('users/quotachart', array(
  'bpp'=>$stats[$sf_user->getUsername()]['info_hard_files_quota']/800,
  'chart'=>'files',
  'user'=>$sf_user,
  'stats'=>$stats,
  'quota_warning'=>sfConfig::get('app_config_posix_quotawarning', .75),
  'personal_profile'=>true,
  )
)?>
<?php endif ?>


<h2><?php echo __('Actions') ?></h2>
<ul class="sf_admin_actions">
<?php /*
<?php if($account->getPasswordIsResettable()): ?>
	<li class="sf_admin_action_passwordreset"><?php echo link_to(__('Change password'), url_for('profile/changeaccountpassword?type='.$account->getAccountType())) ?></li><br />
<?php endif ?>
*/ ?>

<?php if($account->getPasswordIsSynchronizable()): ?>
	<li class="sf_admin_action_passwordreset"><?php echo link_to(
    ($account->getAccountSetting('accept_terms_date')!=''? __('Synchronize password'): __('Activate account')),
 url_for('profile/syncaccountpassword?type='.$account->getAccountType())) ?></li><br />
<?php endif ?>

<?php if($account->getLoginUrl()): ?>
	<li class='sf_admin_action_<?php echo $account->getAccountType() ?>'><?php echo link_to(
    __('Go to login page'). ' '. __('(opens in a new window)'),
    $account->getLoginUrl(),
    array('popup'=>true)
    )?></li><br />
<?php endif ?>

