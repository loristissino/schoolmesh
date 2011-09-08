<?php if (sizeof($resources)>0): ?>

<h3><?php echo __('Resources and schedule') ?></h3>

<ol>
<?php foreach($resources as $resource): ?>

	<li><?php echo $resource->getDescription() ?>
	<ul>
		<li><?php echo __('Resource type') ?>: <strong><?php echo $resource->getProjResourceType() ?></strong></li>
		<li><?php echo __('Charged user') ?>: <strong><?php echo $resource->getChargedUserProfile() ?></strong></li>
    <?php if ($resource->getProjResourceTypeId()): ?>
      <li><?php echo __('Estimation') ?>: <strong><?php echo $resource->getProjResourceType()->getMeasurementUnit() ?>&nbsp;<?php echo $resource->getQuantityEstimated() ?></strong></li>
      <?php if($resource->getQuantityApproved()>0): ?>
      <li><?php echo __('Approved') ?>: <strong><?php echo $resource->getProjResourceType()->getMeasurementUnit() ?>&nbsp;<?php echo $resource->getQuantityApproved() ?></strong></li>
      <?php endif ?>
      <?php if($resource->getTotalQuantityForAcknowledgedActivities()>0): ?>
      <li><?php echo __('Used') ?>: <strong><?php echo $resource->getProjResourceType()->getMeasurementUnit() ?>&nbsp;<?php echo $resource->getTotalQuantityForAcknowledgedActivities() ?></strong></li>
      <?php endif ?>
    <?php endif ?>
	</ul>
  </li>

<?php endforeach ?>
</ol>
<?php else: ?>
<p><?php echo __('No resource defined.') ?></p>
<?php endif ?>

