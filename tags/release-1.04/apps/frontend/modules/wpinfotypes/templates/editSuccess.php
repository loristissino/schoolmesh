<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'appointmenttypes/index' => __('Appointment types'),
    'appointmenttypes/show?id='.$form->getObject()->getAppointmentTypeId() => $form->getObject()->getAppointmentType(),
    '_info' => __('Info'),
    '_wpinfotype' => $form->getObject()
    ),
  'current'=>__('Edit'),
  'title'=>$form->getObject()
  ))
?>

<?php include_partial('form', array('form' => $form)) ?>
