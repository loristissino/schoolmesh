<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'wpinfotypes/index' => __('Info fields types'),
    ),
  'current'=>__('New'),
  'title'=>__('New info field type')
  ))
?>

<?php include_partial('form', array('form' => $form)) ?>
