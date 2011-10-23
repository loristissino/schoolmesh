<?php echo pack('CCC', 0xEF, 0xBB, 0xBF)  /* BOM */ ?><?php foreach(array(
  'Category',
  'Coordinator',
  'Title',
  'Resource/task',
  'M.U.',
  'Estimation',
  'Approval',
  'Standard cost',
  'Amount') as $column_title): ?><?php echo __($column_title) ?>;<?php endforeach ?><?php echo "\n" ?>
<?php foreach ($projects as $project): ?>
<?php foreach($project->getProjResources() as $resource): ?>
<?php echo Generic::correctString($project->getProjCategory()) ?>;<?php echo Generic::correctString($project->getsfGuardUser()->getProfile()->getFullName()) ?>;<?php echo Generic::correctString($project->getTitle()) ?>;<?php echo Generic::correctString($resource->getDescription()) ?>;<?php echo $resource->getProjResourceType()->getMeasurementUnit() ?>;<?php echo quantityvalue($resource->getQuantityEstimated()) ?>;<?php echo quantityvalue($resource->getQuantityApproved()) ?>;<?php echo quantityvalue($resource->getStandardCost()) ?>;<?php echo quantityvalue($resource->getQuantityMultipliedByCost()) ?><?php echo "\n" ?>
<?php endforeach ?><?php endforeach ?>