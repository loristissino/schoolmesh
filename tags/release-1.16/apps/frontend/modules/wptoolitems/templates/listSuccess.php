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
      <th><?php echo __('Actions') ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($WptoolItems as $WptoolItem): ?>
    <tr>
      <td><a href="<?php echo url_for('wptoolitems/edit?id='.$WptoolItem->getId()) ?>"><?php echo $WptoolItem->getId() ?></a></td>
      <td><?php echo $WptoolItem->getDescription() ?></td>
      <td><?php echo $WptoolItem->getRank() ?></td>
      <td><?php echo $WptoolItem->getCode() ?></td>
      <td><?php include_partial('actionitem', array('wptool_item'=>$WptoolItem)) ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<ul class="sf_admin_actions">
    <?php echo li_link_to_if(
    'action_new',
    true,
		__('New item'),
		'wptoolitems/new?type='.$WptoolItemType->getId(),
		array('title'=>__('Create a new item for this type'))
		)?>
    <?php echo li_link_to_if(
    'action_import',
    true,
		__('Import items'),
		'wptoolitems/import?type='.$WptoolItemType->getId(),
		array('title'=>__('Import items for this type from another group'))
		)?>
</ul>
