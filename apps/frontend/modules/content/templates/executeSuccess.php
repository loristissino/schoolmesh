<?php use_helper('Javascript') ?>
<?php use_helper('Form') ?>
<?php use_helper('Object') ?>

<?php slot('title', __('Command execution')) ?>
	
<?php slot('breadcrumbs',
	link_to(__("User management"), 'users/index') . ' » ' .
	__("TO DO")
	)

?><h1><?php echo __("Command execution")?></h1>

<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="notice"><?php echo $sf_user->getFlash('notice')?></div>
<?php endif; ?>
<?php if ($sf_user->hasFlash('error')): ?>
  <div class="error"><?php echo $sf_user->getFlash('error')?></div>
<?php endif; ?>


<pre>
<?php foreach($report as $command): ?>
<span style='color: <?php echo $command['return_var']==0 ? 'green': 'red' ?>'><?php echo $command['command']?></span><?php echo implode("\n", $command['result']->getRawValue()) . "\n" ?>
<?php endforeach ?>
</pre>

