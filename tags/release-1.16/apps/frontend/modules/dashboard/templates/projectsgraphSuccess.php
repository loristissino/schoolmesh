<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'dashboard/index'=>__('Dashboard'),
    'dashboard/projects'=>__('Projects')
  ),
  'current'=>__('Graph')
  ))
?>

<?php include_partial('content/flashes'); ?>

<?php stOfc::createChart(1000, 600, url_for('dashboard/projectschart?type=' . $type)); ?>

<?php include_partial('content/year', array('year'=>$year, 'years'=>$years, 'back'=>'dashboard/projectschart?type=' . $type)) ?>

