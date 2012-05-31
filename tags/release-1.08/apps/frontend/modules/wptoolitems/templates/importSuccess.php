<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'appointmenttypes/index' => __('Appointment types'),
    'appointmenttypes/show?id=' . $CurrentType->getAppointmentTypeId() => $CurrentType->getAppointmentType(),
    '_info' => __('Tools and methodologies'),
    'wptooltypes/edit?id=' . $CurrentType->getId() => $CurrentType,
    ),
  'current'=>__('Import'),
  'title'=>__('Import items for «%type%»', array('%type%'=>$CurrentType)),
  ))
?>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th><?php echo __('Description') ?></th>
      <th><?php echo __('Appointment type') ?></th>
      <th><?php echo __('Actions') ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($WptoolItemTypes as $WptoolItemType): ?>
    <tr>
      <td><?php echo $WptoolItemType->getId() ?></td>
      <td><?php echo $WptoolItemType->getDescription() ?></td>
      <td><?php echo $WptoolItemType->getAppointmentType() ?></td>
      <td><?php include_partial('actionimport', array('current'=>$CurrentType, 'candidate'=>$WptoolItemType))?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

