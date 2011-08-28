<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'projects/monitor' =>__("Projects monitoring")
    ),
  'current'=>__('Projects report')
  ))
?>

<?php include_partial('content/flashes'); ?>

<div class="sf_admin_list">

<?php if(sizeof($projects)>0): ?>

<?php foreach ($projects as $project): ?>
<h2><?php echo $project->getTitle() ?></h2>
<blockquote>
<?php //!-- I know, we should use a styleshed div here... ! ?>
<h3><?php echo __('Basic information') ?></h3>
	<p>
	<?php echo __('Coordinator') ?>: <strong><?php echo $project->getsfGuardUser()->getProfile()->getFullName() ?></strong><br />
	<?php echo __('Category') ?>: <strong><?php echo $project->getProjCategory() ?></strong><br />
  <?php if($project->getApprovalDate()):?>
  <?php echo __('Approval') ?>: <strong><?php echo $project->getApprovalDate('d/m/Y') ?> (<?php echo $project->getApprovalNotes() ?>)</strong><br />
  <?php endif ?>
  <?php if($project->getFinancingDate()):?>
  <?php echo __('Financing') ?>: <strong><?php echo $project->getFinancingDate('d/m/Y') ?> (<?php echo $project->getFinancingNotes() ?>)</strong><br />
  <?php endif ?>
	</p>
<?php include_component('projects', 'deadlines', array('project'=>$project)) ?>
<?php include_component('projects', 'resources', array('project'=>$project)) ?>
</blockquote>
<?php endforeach ?>

<?php else: ?>
<p><?php echo __('No projects defined.') ?></p>
<?php endif ?>
</div>

<?php // include_partial('content/year', array('year'=>$year, 'years'=>$years, 'back'=>'projects/index')) ?>
