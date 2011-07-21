<?php slot('title', sprintf('%s --  %s', $workplan->__toString(),$workplan->getsfGuardUser()->getProfile()->getFullName() )) ?>
<?php slot('breadcrumbs',
	link_to(__("Plans and Reports"), "@plansandreports") . ' » ' . 
	link_to($workplan, 'plansandreports/fill?id=' . $workplan->getId()) . ' » ' .
	__('Complete view')
	)
	
	?><h1><?php echo __("Document: ") . $workplan ?></h1><h1>

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