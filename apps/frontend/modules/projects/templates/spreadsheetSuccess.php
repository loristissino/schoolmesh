<?php echo pack('CCC', 0xEF, 0xBB, 0xBF)  /* BOM */ ; $sep=chr(9) ?><?php foreach(array(
  'Code',
  'Category',
  'Coordinator',
  'Title',
  'Resource type',
  'Resource/task',
  'M.U.',
  'Estimation',
  'Approval',
  'Standard cost',
  'Amount',
  'Extra',
  'Notes') as $column_title): ?><?php echo __($column_title) ?><?php echo $sep?><?php endforeach ?><?php echo "\n" ?>
<?php foreach ($projects as $project): ?>
<?php foreach($project->getProjResources() as $resource): ?>
<?php echo Generic::correctString($project->getCode()) ?><?php echo $sep?><?php echo Generic::correctString($project->getProjCategory()) ?><?php echo $sep?><?php echo Generic::correctString($project->getsfGuardUser()->getProfile()->getFullName()) ?><?php echo $sep?><?php echo Generic::correctString($project->getTitle()) ?><?php echo $sep?><?php echo Generic::correctString($resource->getProjResourceType()->getDescription()) ?><?php echo $sep?><?php echo Generic::correctString($resource->getDescription()) ?><?php echo $sep?><?php echo $resource->getProjResourceType()->getMeasurementUnit() ?><?php echo $sep?><?php echo quantityvalue($resource->getQuantityEstimated()) ?><?php echo $sep?><?php echo quantityvalue($resource->getQuantityApproved()) ?><?php echo $sep?><?php echo quantityvalue($resource->getStandardCost()) ?><?php echo $sep?><?php echo quantityvalue($resource->getQuantityMultipliedByCost()) ?><?php echo $sep?><?php echo quantityvalue($resource->getAmountFundedExternally()) ?><?php echo $sep?><?php echo $resource->getFinancingNotes() ?><?php echo "\n" ?>
<?php endforeach ?><?php endforeach ?>
