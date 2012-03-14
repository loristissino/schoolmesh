<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'wpitemtypes/index' => __('Didactic modules fields types'),
    ),
  'current'=>__('New'),
  'title'=>__('New didactic module field type')
  ))
?>

<?php include_partial('form', array('form' => $form)) ?>
