<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'dashboard/index'=>__('Dashboard'),
  ),
  'current'=>__('Projects')
  ))
?>

<?php include_partial('content/flashes'); ?>

<h2><?php echo __('State of the projects') ?></h2>
<?php stOfc::createChart(500, 250, url_for('dashboard/projectschart?type=bystate')); ?>

<hr />
<h2><?php echo __('Budget') ?></h2>
<p>
<?php echo __('The following charts depict the budget requested for each project.') ?>  
<?php echo __('Please note that the some of the projects might have not been approved / confirmed at this time.') ?>
</p>
<?php stOfc::createChart(1000, 600, url_for('dashboard/projectschart?type=totalbudget')); ?>

<hr />

<?php stOfc::createChart(1000, 600, url_for('dashboard/projectschart?type=internalbudget')); ?>

<hr />

<?php stOfc::createChart(1000, 600, url_for('dashboard/projectschart?type=externalbudget')); ?>

