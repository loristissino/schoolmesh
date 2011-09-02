<?php $title=__($steps[$workplan->getState()]['stateDescription']) . ': ' . $workplan ?>
<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    '@plansandreports' => "Plans and Reports",
    ),
  'current'=>$workplan,
  'title'=>__('Document submission'),
  ))
?>


<?php include_partial('basicinfo', array('workplan' => $workplan, 'steps' =>$steps)) ?>

<?php if ($sf_user->hasFlash('notice')): ?>
<h2><?php echo __($sf_user->getFlash('notice')) ?></h2>
<p><strong><?php echo __('Congratulations.') ?></strong>
<p><?php echo sprintf(__('The document «%s» was successfully submitted.'), $workplan) ?><br />
<?php echo __('It must now be administratively checked and then approved by the schoolmaster.') ?><br />

<?php if($sf_user->hasFlash('mail_sent_to')): ?>
<?php echo __('A confirmation message has been sent to your address %email%', array('%email%'=>$sf_user->getFlash('mail_sent_to'))) ?>
<?php endif ?>
</p>

<h2><?php echo __("Workflow") ?></h2>

<?php include_partial('content/workflow', array('wfevents' => $workflow_logs)) ?>

<?php endif ?>

<?php if ($sf_user->hasFlash('error')): ?>
  <div class="error"><?php echo $sf_user->getFlash('error')?></div>
<?php endif; ?>

<?php include_partial('wpactions', array('workplan'=>$workplan, 'steps'=>$steps, 'show_fill'=>true)) ?>

</div>
<hr />

<?php if(isset($checkList)): ?>
	<?php include_partial('content/checks', array('checkList'=>$checkList, 'start_closed'=>false)) ?>
<?php endif ?>

