<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'content/index' =>__("Home")
    ),
  'current'=>__('Setup checks'),
  ))
?>

<?php include_partial('content/flashes'); ?>

<?php include_partial('content/checks', array('checkList'=>$checkList, 'start_closed'=>false, 'show_successes'=>true)) ?>