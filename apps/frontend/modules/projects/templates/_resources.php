<?php if (sizeof($resources)>0): ?>

<h3><?php echo __('Tasks, resources, schedule') ?></h3>

<ol>
<?php foreach($resources as $resource): ?>

	<li><?php echo $resource->getDescription() ?>
	<ul>
		<li><?php echo __('Resource type') ?>: <strong><?php echo $resource->getProjResourceType() ?></strong></li>
		<li><?php echo __('Charged user') ?>: <?php if($resource->getChargedUserId()): ?><strong><?php echo $resource->getChargedUserProfile() ?></strong><?php else: ?><em><?php echo __('no specific user charged with for this resource') ?></em><?php endif ?></li>
    <?php if ($resource->getProjResourceTypeId()): ?>
      <li><?php echo __('Estimation') ?>: <strong><?php echo quantityvalue($resource->getQuantityEstimated(), $resource->getProjResourceType()->getMeasurementUnit()) ?></strong></li>
      <?php if($project->getState()>Workflow::PROJ_SUBMITTED): ?>
      <li><?php echo __('Approved') ?>: <strong><?php echo quantityvalue($resource->getQuantityApproved(), $resource->getProjResourceType()->getMeasurementUnit()) ?></strong></li>
      <?php endif ?>
      <?php if($resource->getTotalQuantityForAcknowledgedActivities()>0): ?>
      <li><?php echo __('Used') ?>: <strong><?php echo quantityvalue($resource->getTotalQuantityForAcknowledgedActivities(), $resource->getProjResourceType()->getMeasurementUnit()) ?></strong><br/ >
      <?php include_component('projects', 'resourceactivities', array('resource'=>$resource, 'mu'=>$resource->getProjResourceType()->getMeasurementUnit())) ?>
      </li>
      <?php endif ?>
    <?php endif ?>
	</ul>
  </li>

<?php endforeach ?>
</ol>
<?php else: ?>
<p><?php echo __('No resource defined.') ?></p>
<?php endif ?>

