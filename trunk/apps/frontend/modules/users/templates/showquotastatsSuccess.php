<?php use_helper('Javascript') ?>
<?php use_helper('Form') ?>
<?php use_helper('Object') ?>

<?php slot('title', __('Disk quota statistics')) ?>
	
<?php slot('breadcrumbs',
	link_to(__("User management"), 'users/index') . ' » ' .
	__("User list")
	)

?><h1><?php echo __("Disk quota statistics")?></h1>

<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="notice"><?php echo $sf_user->getFlash('notice')?></div>
<?php endif; ?>
<?php if ($sf_user->hasFlash('error')): ?>
  <div class="error"><?php echo $sf_user->getFlash('error')?></div>
<?php endif; ?>

<h2><?php echo __('Blocks usage') ?></h2>

<?php foreach ($userlist as $user): ?>
  <p>
  <?php include_partial('users/blocksquotachart', array('bpp'=>$max_blocks / 800, 'user'=>$user, 'stats'=>$stats)) ?>
  </p>
<?php endforeach ?>

<h2><?php echo __('Files usage') ?></h2>
<?php $fpp=$max_files / 800 // files per pixel ?>
<?php foreach ($userlist as $user): ?>
  <p>
  <?php include_partial('users/filesquotachart', array('fpp'=>$max_files / 800, 'user'=>$user, 'stats'=>$stats)) ?>
  </p>
<?php endforeach ?>

