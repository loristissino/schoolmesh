<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'teams/index' =>__('Teams'),
    'teams/show?id='.$form->getObject()->getId() =>$form->getObject(),
    ),
  'current'=>__('Edit'),
  ))
?>

<?php include_partial('form', array('form' => $form)) ?>
