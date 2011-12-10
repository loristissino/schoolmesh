<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'teams/index' =>__('Teams'),
    ),
  'current'=>$form->getObject(),
  ))
?>

<?php include_partial('form', array('form' => $form)) ?>
