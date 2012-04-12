<?php if($breadcrumpstype=='projects/monitoring/viewasreport'): ?>
<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'projects/monitor' =>__("Projects management")
    ),
  'current'=>__('Projects report')
  ))
?>
<?php endif ?>
<?php if($breadcrumpstype=='projects/monitoring/project/view'): ?>
<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'projects/monitor' =>__("Projects management"),
    '_project' => __('Project «%title%»', array('%title%'=>$projects[0]))
    ),
  'current'=>__('Project view')
  ))
?>
<?php endif ?>
<?php if($breadcrumpstype=='projects/project/view'): ?>
<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'projects/index' =>__("My projects")
    ),
  'current'=>__('Project «%title%»', array('%title%'=>$projects[0]))
  ))
?>
<?php endif ?>

<?php include_partial('content/flashes'); ?>

<div class="sf_admin_list">

<?php if(sizeof($projects)>0): ?>

<?php foreach ($projects as $project): ?>
<h2><?php echo $project->getTitle() ?></h2>
<blockquote>
<?php //!-- I know, we should use a styleshed div here... ! ?>
<h3><?php echo __('Basic information') ?></h3>
	<p>
	<strong><?php echo __('Coordinator') ?>:</strong> <?php echo $project->getsfGuardUser()->getProfile()->getFullName() ?><br />
	<strong><?php echo __('Category') ?>:</strong> <?php echo $project->getProjCategory() ?><br />
	<strong><?php echo __('Description') ?>:</strong>  <?php echo nl2br($project->getDescription()) ?><br />
	<strong><?php echo __('Addressees') ?>:</strong>  <?php echo nl2br($project->getAddressees()) ?><br />
	<strong><?php echo __('Purposes') ?>:</strong><br /><?php echo nl2br($project->getPurposes()) ?><br />
	<strong><?php echo __('Goals') ?>:</strong><br /><?php echo nl2br($project->getGoals()) ?><br />
  
  <?php if($project->getApprovalDate()):?>
  <strong><?php echo __('Approval date') ?>:</strong> <?php echo $project->getApprovalDate('d/m/Y') ?> (<?php echo $project->getApprovalNotes() ?>)<br />
  <?php endif ?>
  <?php if($project->getFinancingDate()):?>
  <strong><?php echo __('Financing date') ?>:</strong> <?php echo $project->getFinancingDate('d/m/Y') ?> (<?php echo $project->getFinancingNotes() ?>)<br />
  <?php endif ?>
	</p>
<?php include_component('projects', 'resources', array('project'=>$project)) ?>
<?php include_component('projects', 'upshots', array('project'=>$project)) ?>
<?php include_component('projects', 'deadlines', array('project'=>$project)) ?>
<?php include_component('projects', 'workflow', array('project'=>$project)) ?>
</blockquote>
<?php endforeach ?>

<?php else: ?>
<p><?php echo __('No projects defined.') ?></p>
<?php endif ?>
</div>

<?php // include_partial('content/year', array('year'=>$year, 'years'=>$years, 'back'=>'projects/index')) ?>
