<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'documents/index' =>__('Documents'),
    'documents/show?id='.$form->getObject()->getDocumentId() => $form->getObject()->getDocument()
  ),
  'current'=>__('Revision # %revision%', array('%revision%'=>$form->getObject()->getRevisionNumber()))
  ))
?>

<?php include_partial('content/flashes'); ?>

<?php include_partial('form', array('form' => $form)) ?>
