<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'appointmenttypes/index' => __('Appointment types'),
    'appointmenttypes/show?id=' . $WptoolItemType->getAppointmentTypeId() => $WptoolItemType->getAppointmentType(),
    '_info' => __('Tools and methodologies'),
    'wptooltypes/edit?id=' . $WptoolItemType->getId() => $WptoolItemType,
    ),
  'current'=>__('Edit item'),
  'title'=>__('Edit item with id %id%', array('%id%'=>$form->getObject()->getId())),
  ))
?>

<?php include_partial('form', array('form' => $form)) ?>
