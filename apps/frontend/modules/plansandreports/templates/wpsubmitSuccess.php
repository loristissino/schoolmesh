<?php use_helper('Javascript') ?>
<?php slot('title', sprintf('%s --  %s', $workplan->__toString(),$workplan->getsfGuardUser()->getProfile()->getFullName() )) ?>
<?php slot('breadcrumbs',
	link_to(__("Plans and Reports"), "@plansandreports") . ' » ' . 
	link_to($workplan, 'plansandreports/fill?id='.$workplan->getId()) . ' » ' .
	__('Document submission')
	)
	
	?><h1><?php echo __('Document submission') ?></h1>

<?php if ($sf_user->hasFlash('notice')): ?>
<h2><?php echo $sf_user->getFlash('notice')?></h2>
<?php echo image_tag('wpfr_workflow_10', 'title=' . __('Submission successful')) ?>
<p><strong><?php echo __('Congratulations.') ?></strong>
<p><?php echo sprintf(__('The document «%s» was successfully submitted.'), $workplan) ?><br />
<?php echo __('It must now be administratively checked and then approved by the schoolmaster.') ?><br />
<?php echo sprintf(__('A confirm message has been sent to your email address %s'), $sf_user->getProfile()->getEmail()) ?> <em>(<?php echo __('Not implemented yet') ?>)</em></p>

<h2><?php echo __("Workflow") ?></h2>

<?php include_partial('workflow', array('workflow_logs' => $workflow_logs)) ?>

<?php endif ?>

<?php if ($sf_user->hasFlash('error')): ?>
  <div class="error"><?php echo $sf_user->getFlash('error')?></div>
<?php endif; ?>

<?php include_partial('wpactions', array('workplan'=>$workplan, 'steps'=>$steps)) ?>





</div>
<hr />
<?php if(isset($checks)): ?>
<?php foreach($checks as $check): ?>
	<p>
		<?php echo image_tag($check->getIsPassed()? 'done':'notdone', 'title=' . ($check->getIsPassed()?__('passed'):__('failed'))); ?>
		<?php echo $check->getMessage() ?>: 
		<strong><?php echo $check->getContent() ?></strong>
		<?php if (!$check->getIsPassed()): ?>
			<?php echo image_tag('fill', 'title='. __('Fill')) ?>
			<?php echo link_to(__('Fill'), $check->getLinkTo() . '&flash=' .$check->getFlash() . '#' . $check->getFragment()) ?>
		<?php endif ?>
	</p>
<?php endforeach; ?>
<?php endif ?>

