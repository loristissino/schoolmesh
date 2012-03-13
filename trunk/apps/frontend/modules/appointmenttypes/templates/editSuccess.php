<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'appointmenttypes/index' => __('Appointment types'),
    ),
  'current'=>__('Edit appointment type')
  ))
?>

<?php include_partial('form', array('form' => $form)) ?>
