<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'appointmenttypes/index' => __('Appointment types'),
    '_appointmenttypes' => '...',
    '_info' => __('Tools and methodologies'),
    '_wptooltypes' => '...',
    ),
  'current'=>__('New item'),
  ))
?>

<?php include_partial('form', array('form' => $form)) ?>
