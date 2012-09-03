<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'appointmenttypes/index' => __('Appointment types'),
    'appointmenttypes/show?id='.$form->getObject()->getAppointmentTypeId() => $form->getObject()->getAppointmentType(),
    '_info' => __('Tools and methodologies'),
    '_wptooltype' => $form->getObject()
    ),
  'current'=>__('Edit'),
  'title'=>$form->getObject()
  ))
?>

<?php include_partial('form', array('form' => $form)) ?>
