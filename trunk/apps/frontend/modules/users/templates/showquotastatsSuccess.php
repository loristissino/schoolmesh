<?php use_helper('Javascript') ?>
<?php use_helper('Form') ?>
<?php use_helper('Object') ?>

<?php slot('title', __('Quota statistics')) ?>
	
<?php slot('breadcrumbs',
	link_to(__("User management"), 'users/index') . ' » ' .
	__("User list")
	)

?><h1><?php echo __("Quota statistics")?></h1>

<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="notice"><?php echo $sf_user->getFlash('notice')?></div>
<?php endif; ?>
<?php if ($sf_user->hasFlash('error')): ?>
  <div class="error"><?php echo $sf_user->getFlash('error')?></div>
<?php endif; ?>

<p>Max blocks: <?php echo $max_blocks ?></p>
<p>Max files: <?php echo $max_files ?></p>
<?php foreach ($userlist as $user): ?>
  <p>
  <?php echo $user->getProfile()->getFullName() ?><br />
  <?php echo $stats[$user->getUsername()]['used_blocks'] ?><br />
  <?php $width=round($stats[$user->getUsername()]['used_blocks']/100) ?>
  <?php echo $stats[$user->getUsername()]['used_files'] ?><br />
  <?php echo $stats[$user->getUsername()]['soft_blocks_quota'] ?><br />
  <?php echo $stats[$user->getUsername()]['hard_blocks_quota'] ?><br />
  <?php echo $stats[$user->getUsername()]['soft_files_quota'] ?><br />
  <?php echo $stats[$user->getUsername()]['hard_files_quota'] ?><br />
  </p>
  <p>
  <?php echo image_tag('phpixel.php?color=ff0000', array('size'=>$width.'x20')) ?>
  </p>
<?php endforeach ?>
