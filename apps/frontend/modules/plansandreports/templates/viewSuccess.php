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

<?php if($workplan->getAppointmentType()->getHasInfo()): ?>
  <h2><?php echo __('General information') ?></h2>
  <?php include_partial('infos_shown', array('wpinfos' => $wpinfos, 'state'=>$workplan->getState())) ?>
<?php endif ?>

<?php if($workplan->getAppointmentType()->getHasModules()): ?>
  <h2><?php echo __("Modules") ?></h2>

  <?php if ($workplan->getState()>=Workflow::IR_DRAFT): ?>
    <?php include_partial('wpmodule/legenda', array('wpitemTypes' => $wpitemTypes)) ?>
  <?php endif ?>

  <?php include_partial('modules_shown', array('workplan' => $workplan, 'is_owner' => $is_owner)) ?>
<?php endif ?>

<?php if($workplan->getAppointmentType()->getHasTools()): ?>
  <h2><?php echo __("Aux") ?></h2>
  <?php include_partial('aux_shown', array('workplan' => $workplan, 'tools' => $tools)) ?>
<?php endif ?>

<?php if ($is_owner): ?>

<h2><?php echo __("Workflow") ?></h2>

<?php include_partial('content/workflow', array('wfevents' => $wfevents)) ?>

<?php endif ?>
