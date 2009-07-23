<?php use_helper('Javascript') ?>
<?php slot('title', sprintf('%s --  %s', $workplan->__toString(),$workplan->getsfGuardUser()->getProfile()->getFullName() )) ?>
<?php slot('breadcrumbs',
	link_to(__("Plans and Reports"), "@plansandreports") . ' » ' . 
	link_to($workplan, 'plansandreports/fill?id=' . $workplan->getId()) . ' » ' .
	__('Complete view')
	)
	
	?><h1><?php echo __("Document: ") . $workplan ?></h1><h1>

<h2><?php echo __("General information") ?></h2>
<ul>
	<li><?php echo __("Teacher: ") . $workplan->getsfGuardUser()->getProfile()->getFullName() ?></li>
	<li><?php echo __("Class: ") . $workplan->getSchoolclass() ?></li>
	<li><?php echo __("Year: ") . $workplan->getYear() ?></li>
</ul>

<h2><?php echo __('Details, comments, general information') ?></h2>

<?php include_partial('infos_shown', array('wpinfos' => $wpinfos, 'state'=>$workplan->getState())) ?>

<h2><?php echo __("Modules") ?></h2>

<?php if ($workplan->getState()>Workflow::WP_DRAFT): ?>
	<?php include_partial('wpmodule/legenda', array('wpitemTypes' => $wpitemTypes)) ?>
<?php endif ?>

<?php include_partial('modules_shown', array('workplan' => $workplan, 'is_owner' => $is_owner, 'state'=>$workplan->getState())) ?>

<h2><?php echo __("Aux") ?></h2>

<?php include_partial('aux_shown', array('workplan' => $workplan, 'tools' => $tools)) ?>

<?php if ($is_owner): ?>

<h2><?php echo __("Workflow") ?></h2>

<?php include_partial('workflow', array('workflow_logs' => $workflow_logs)) ?>

<?php endif ?>