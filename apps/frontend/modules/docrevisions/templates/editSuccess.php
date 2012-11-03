<?php use_stylesheet('ui-lightness/jquery-ui-1.8.custom.css') ?>
<?php use_javascripts_for_form($form) ?>
<?php use_javascript('jquery-ui-1.8.custom.min.js') ?>
<?php use_javascript('datepicker') ?>
<?php use_javascript('jquery.ui.datepicker-' . sfConfig::get('sf_default_culture') . '.js') ?>  

<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'documents/index' =>__('Documents'),
    'documents/details?id='.$form->getObject()->getDocumentId() => $form->getObject()->getDocument()
  ),
  'current'=>__('Revision # %revision%', array('%revision%'=>$form->getObject()->getRevisionNumber()))
  ))
?>

<?php include_partial('content/flashes'); ?>

<?php include_partial('form', array('form' => $form)) ?>
