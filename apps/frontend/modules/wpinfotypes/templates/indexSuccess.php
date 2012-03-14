<?php include_partial('content/breadcrumps', array(
  'current'=>__('Info fields types'),
  ))
?>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th><?php echo __('Title') ?></th>
      <th><?php echo __('Description') ?></th>
      <th><?php echo __('Rank') ?></th>
      <th><?php echo __('Code') ?></th>
      <th><?php echo __('State min') ?></th>
      <th><?php echo __('State max') ?></th>
      <th><?php echo __('Template') ?></th>
      <th><?php echo __('Example') ?></th>
      <th><?php echo __('Required?') ?></th>
      <th><?php echo __('Confidential?') ?></th>
      <th><?php echo __('Grade min') ?></th>
      <th><?php echo __('Grade max') ?></th>
      <th><?php echo __('Appointment type') ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($WpinfoTypes as $WpinfoType): ?>
    <tr>
      <td><a href="<?php echo url_for('wpinfotypes/edit?id='.$WpinfoType->getId()) ?>"><?php echo $WpinfoType->getId() ?></a></td>
      <td><?php echo $WpinfoType->getTitle() ?></td>
      <td><?php echo $WpinfoType->getDescription() ?></td>
      <td><?php echo $WpinfoType->getRank() ?></td>
      <td><?php echo $WpinfoType->getCode() ?></td>
      <td><?php echo $WpinfoType->getStateMin() ?></td>
      <td><?php echo $WpinfoType->getStateMax() ?></td>
      <td><?php echo $WpinfoType->getTemplate() ?></td>
      <td><?php echo $WpinfoType->getExample() ?></td>
      <td><?php echo get_partial('content/list_field_boolean', array('value' => $WpinfoType->getIsRequired())) ?></td>
      <td><?php echo get_partial('content/list_field_boolean', array('value' => $WpinfoType->getIsConfidential())) ?></td>
      <td><?php echo $WpinfoType->getGradeMin() ?></td>
      <td><?php echo $WpinfoType->getGradeMax() ?></td>
      <td><?php echo link_to($WpinfoType->getAppointmentType()->getShortCut(), url_for('appointmenttypes/show?id='.$WpinfoType->getAppointmentTypeId()))  ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<ul class="sf_admin_actions">
    <?php echo li_link_to_if(
    'action_new',
    true,
		__('New info field type'),
		'wpinfotypes/new',
		array('title'=>__('Create a new info field type'))
		)?>
</ul>
