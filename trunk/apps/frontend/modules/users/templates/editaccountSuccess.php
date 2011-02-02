<?php
	$raw_account=$sf_data->getRaw('account');
?>
<?php use_helper('Form') ?>
<?php use_helper('Object') ?>

<?php use_stylesheet('ui-lightness/jquery-ui-1.8.custom.css') ?>
<?php use_helper('Javascript') ?>
<?php use_javascripts_for_form($form) ?>
<?php use_javascript('jquery-ui-1.8.custom.min.js') ?>
<?php use_javascript('datepicker') ?>
<?php use_javascript('jquery.ui.datepicker-' . sfConfig::get('sf_default_culture') . '.js') ?>

<?php slot('title', __('User management')) ?>
<?php slot('breadcrumbs',
	link_to(__("User management"), 'users/index') . ' » ' .
	link_to(__("User list"), 'users/list') . ' » ' .
	link_to($profile->getFullName(), 'users/edit?id=' . $profile->getUserId()) . ' » '.
	$account
	)
	
	?><h1><?php echo sprintf(__('Edit %s'), $account)?></h1>

<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="notice"><?php echo $sf_user->getFlash('notice')?></div>
<?php endif; ?>
<?php if ($sf_user->hasFlash('error')): ?>
  <div class="error"><?php echo $sf_user->getFlash('error')?></div>
<?php endif; ?>


<form action="<?php echo url_for('users/editaccount?id='. $account->getId()) ?>" method="post">

  <table>
	<tr>
		<th><label><?php echo __('Last info update') ?></label></th>
		<td>
			<?php echo Generic::datetime($account->getInfoUpdatedAt('U'), $sf_context) ?>
		</td>
	</tr>
	<tr>
		<th><label><?php echo __('Is deletable?') ?></label></th>
		<td>
			<?php echo $account->getIsDeletable()? __('yes'): __('no') ?>
		</td>
	</tr>
	<?php include_partial($account->getAccountType(), array('account'=>$account)) ?>
    <?php echo $form ?>
	<tr>
      <td colspan="2">
         <input type="submit" name="save" value="<?php echo __('Save') ?>">
      </td>
    </tr>
  </table>


<hr />

<h2>Available info</h2>

<pre>
<?php foreach(unserialize($raw_account->getInfo()) as $key=>$value): ?>
<?php echo $key . '=' . $value . "\n"; ?>
<?php endforeach ?>
</pre>

