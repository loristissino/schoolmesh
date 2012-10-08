<?php include_partial('content/breadcrumps', array(
  'breadcrumps' => array(
    'roles/index' => __("Roles"),
    ),
  'current'=>__("Edit role «%description%»", array('%description%'=>$form->getObject()->getMaleDescription()))
  ))
?>

<?php include_partial('content/flashes'); ?>

<?php include_partial('form', array('form' => $form)) ?>
