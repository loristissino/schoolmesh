<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'appointmenttypes/index' => __('Appointment types'),
    'appointmenttypes/show?id=' . $WptoolItemType->getAppointmentTypeId() => $WptoolItemType->getAppointmentType(),
    '_info' => __('Tools and methodologies'),
    'wptooltypes/edit?id=' . $WptoolItemType->getId() => $WptoolItemType,
    ),
  'current'=>__('List'),
  'title'=>__('List of items for «%type%»', array('%type%'=>$WptoolItemType)),
  ))
?>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th><?php echo __('Description') ?></th>
      <th><?php echo __('Rank') ?></th>
      <th><?php echo __('Code') ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($WptoolItems as $WptoolItem): ?>
    <tr>
      <td><a href="<?php echo url_for('wptoolitems/edit?id='.$WptoolItem->getId()) ?>"><?php echo $WptoolItem->getId() ?></a></td>
      <td><?php echo $WptoolItem->getDescription() ?></td>
      <td><?php echo $WptoolItem->getRank() ?></td>
      <td><?php echo $WptoolItem->getCode() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('wptoolitems/new') ?>">New</a>
