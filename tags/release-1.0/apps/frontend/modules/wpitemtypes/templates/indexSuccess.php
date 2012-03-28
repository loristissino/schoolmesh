<?php include_partial('content/breadcrumps', array(
  'current'=>__('Didactic modules fields types'),
  ))
?>

<table>
  <thead>
    <tr>
      <th><?php echo __('Id') ?></th>
      <th><?php echo __('Title') ?></th>
      <th><?php echo __('Description') ?></th>
      <th><?php echo __('Style') ?></th>
      <th><?php echo __('Rank') ?></th>
      <th><?php echo __('State min') ?></th>
      <th><?php echo __('State max') ?></th>
      <th><?php echo __('Required?') ?></th>
      <th><?php echo __('Appointment type') ?></th>
      <th><?php echo __('Code') ?></th>
      <th><?php echo __('Evaluation min') ?></th>
      <th><?php echo __('Evaluation max') ?></th>
      <th><?php echo __('Grade min') ?></th>
      <th><?php echo __('Grade max') ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($WpitemTypes as $WpitemType): ?>
    <tr>
      <td><a href="<?php echo url_for('wpitemtypes/edit?id='.$WpitemType->getId()) ?>"><?php echo $WpitemType->getId() ?></a></td>
      <td><?php echo $WpitemType->getTitle() ?></td>
      <td><?php echo $WpitemType->getDescription() ?></td>
      <td><?php echo $WpitemType->getStyle() ?></td>
      <td><?php echo $WpitemType->getRank() ?></td>
      <td><?php echo $WpitemType->getStateMin() ?></td>
      <td><?php echo $WpitemType->getStateMax() ?></td>
      <td><?php echo get_partial('content/list_field_boolean', array('value' => $WpitemType->getIsRequired())) ?></td>
      <td><?php echo link_to($WpitemType->getAppointmentType()->getShortCut(), url_for('appointmenttypes/show?id='.$WpitemType->getAppointmentTypeId()))  ?></td>
      <td><?php echo $WpitemType->getCode() ?></td>
      <td><?php echo $WpitemType->getEvaluationMin() ?></td>
      <td><?php echo $WpitemType->getEvaluationMax() ?></td>
      <td><?php echo $WpitemType->getGradeMin() ?></td>
      <td><?php echo $WpitemType->getGradeMax() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<ul class="sf_admin_actions">
    <?php echo li_link_to_if(
    'action_new',
    true,
		__('New didactic module item field type'),
		'wpitemtypes/new',
		array('title'=>__('Create a new didactic module item field type'))
		)?>
</ul>
