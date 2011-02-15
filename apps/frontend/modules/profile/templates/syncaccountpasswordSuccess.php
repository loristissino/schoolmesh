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


<form action="<?php echo url_for('profile/syncaccountpassword') ?>" method="post">

  <table>
  <tr>
  <td colspan="2">
  <h2><?php echo __('Terms of Service') ?></h2>
  <p><?php echo __('By using this account, you agree to follow the policy defined in the document available online at %url%.', array('%url%'=>link_to(sfConfig::get('app_config_' . $account->getAccountType(). '_policy_url'), sfConfig::get('app_config_' . $account->getAccountType(). '_policy_url'), array('popup'=>array('popupWindow', 'width=600,height=300,left=250,top=0,scrollbars=yes'), 'title'=>__('Terms of Service'). ' ' . __('(opens in a new window)')) ) )) ?>
  </td>
  </tr>
    <?php echo $form ?>
	<tr>
      <td colspan="2">
         <input type="submit" name="save" value="<?php echo __('Synchronize password') ?>">
      </td>
    </tr>
  </table>
