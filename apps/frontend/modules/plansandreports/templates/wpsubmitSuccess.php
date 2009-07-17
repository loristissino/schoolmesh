<?php use_helper('Javascript') ?>
<?php slot('title', sprintf('%s --  %s', $workplan->__toString(),$workplan->getsfGuardUser()->getProfile()->getFullName() )) ?>
<?php slot('breadcrumbs',
	link_to(__("Plans and Reports"), "@plansandreports") . ' » ' . 
	link_to($workplan, 'plansandreports/fill?id='.$workplan->getId()) . ' » ' .
	__('Workplan/report submission')
	)
	
	?><h1><?php echo __('Workplan/report submission') ?></h1>
<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="notice"><?php echo $sf_user->getFlash('notice')?></div>
<?php endif; ?>
<?php if ($sf_user->hasFlash('error')): ?>
  <div class="error"><?php echo $sf_user->getFlash('error')?></div>
<?php endif; ?>
</div>

<?php foreach($checks as $check): ?>
	<p>
		<?php echo image_tag($check->getIsPassed()? 'done':'notdone', 'title=' . ($check->getIsPassed()?__('passed'):__('failed'))); ?>
		<?php echo $check->getMessage() ?>: 
		<strong><?php echo $check->getContent() ?></strong>
		<?php if (!$check->getIsPassed()): ?>
			<?php echo image_tag('fill', 'title='. __('Fill')) ?>
			<?php echo link_to(__('Fill'), $check->getLinkTo()) ?>
		<?php endif ?>
	</p>
<?php endforeach; ?>