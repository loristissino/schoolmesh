<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    '@plansandreports' => "Plans and Reports",
    'plansandreports/fill?id='.$workplan->getId() => $workplan
    ),
  'current'=>__('Complete view'),
  'title'=>$workplan,
  ))
?>    

<?php include_partial('basicinfo', array('workplan' => $workplan, 'steps' =>$steps)) ?>

<h2><?php echo __('General information') ?></h2>

<?php include_partial('infos_shown', array('wpinfos' => $wpinfos, 'state'=>$workplan->getState())) ?>

<h2><?php echo __("Modules") ?></h2>

<?php if ($workplan->getState()>=Workflow::IR_DRAFT): ?>
	<?php include_partial('wpmodule/legenda', array('wpitemTypes' => $wpitemTypes)) ?>
<?php endif ?>

<?php include_partial('modules_shown', array('workplan' => $workplan, 'is_owner' => $is_owner)) ?>

<h2><?php echo __("Aux") ?></h2>

<?php include_partial('aux_shown', array('workplan' => $workplan, 'tools' => $tools)) ?>

<?php if ($is_owner): ?>

<h2><?php echo __("Workflow") ?></h2>

<?php include_partial('workflow', array('workflow_logs' => $workflow_logs)) ?>

<?php endif ?>