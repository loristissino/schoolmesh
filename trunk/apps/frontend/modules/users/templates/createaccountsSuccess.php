<?php use_helper('Javascript') ?>
<?php use_helper('Form') ?>
<?php use_helper('Object') ?>

<?php slot('title', __('User checks')) ?>
	
<?php slot('breadcrumbs',
	link_to(__("User management"), 'users/index') . ' » ' .
	__("User checks")
	)

?><h1><?php echo __("User account creation")?></h1>

<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="notice"><?php echo $sf_user->getFlash('notice')?></div>
<?php endif; ?>
<?php if ($sf_user->hasFlash('error')): ?>
  <div class="error"><?php echo $sf_user->getFlash('error')?></div>
<?php endif; ?>

<?php if(isset($checkList)): ?>

<?php include_partial('content/checks', array('checkList'=>$checkList, 'start_closed'=>true)) ?>

<?php endif /* is there a Checklist */?>
