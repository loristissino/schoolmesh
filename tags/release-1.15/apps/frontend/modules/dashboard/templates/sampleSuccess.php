<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'dashboard/index'=>__('Dashboard'),
  ),
  'current'=>__('Sample')
  ))
?>

<?php include_partial('content/flashes'); ?>

<h2>3d histogram (stBar3D)</h2>
<?php stOfc::createChart(500, 250, url_for('@simplechartdata?example=1')); ?>

<h2>Pie (stGraph)</h2>
<?php stOfc::createChart(500, 250, url_for('@simplechartdata?example=2')); ?>

<h2>Line (stGraph)</h2>
<?php stOfc::createChart(500, 250, url_for('@simplechartdata?example=3')); ?>

<h2>Bars (stBarOutline)</h2>
<?php stOfc::createChart(500, 250, url_for('@simplechartdata?example=4')); ?>
