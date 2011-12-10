<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'teams/index' =>__('Teams'),
    ),
  'current'=>__('New team'),
  ))
?>

<?php include_partial('content/flashes'); ?>

<?php include_partial('form', array('form' => $form)) ?>
