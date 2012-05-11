<?php include_partial('content/breadcrumps', array(
  'current'=>__('Tools and methodologies'),
  ))
?>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th><?php echo __('Description') ?></th>
      <th><?php echo __('Rank') ?></th>
      <th><?php echo __('Appointment type') ?></th>
      <th><?php echo __('State min') ?></th>
      <th><?php echo __('State max') ?></th>
      <th><?php echo __('Min selected') ?></th>
      <th><?php echo __('Max selected') ?></th>
      <th><?php echo __('Grade min') ?></th>
      <th><?php echo __('Grade max') ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($WptoolItemTypes as $WptoolItemType): ?>
    <tr>
      <td><a href="<?php echo url_for('wptooltypes/edit?id='.$WptoolItemType->getId()) ?>"><?php echo $WptoolItemType->getId() ?></a></td>
      <td><?php echo $WptoolItemType->getDescription() ?></td>
      <td><?php echo $WptoolItemType->getRank() ?></td>
      <td><?php echo link_to($WptoolItemType->getAppointmentType()->getShortCut(), url_for('appointmenttypes/show?id='.$WptoolItemType->getAppointmentTypeId()))  ?></td>
      <td><?php echo $WptoolItemType->getStateMin() ?></td>
      <td><?php echo $WptoolItemType->getStateMax() ?></td>
      <td><?php echo $WptoolItemType->getMinSelected() ?></td>
      <td><?php echo $WptoolItemType->getMaxSelected() ?></td>
      <td><?php echo $WptoolItemType->getGradeMin() ?></td>
      <td><?php echo $WptoolItemType->getGradeMax() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<ul class="sf_admin_actions">
    <?php echo li_link_to_if(
    'action_new',
    true,
		__('New group of tools/methodologies'),
		'wptooltypes/new',
		array('title'=>__('Create a new group of tools/methodologies'))
		)?>
</ul>
