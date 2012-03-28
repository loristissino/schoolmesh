<?php include_partial('content/breadcrumps', array(
  'current'=>__('Appointment types')
  ))
?>

<?php include_partial('content/flashes'); ?>

<div class="sf_admin_list">

<table>
  <thead>
    <tr>
      <th><?php echo __('Description') ?></th>
      <th><?php echo __('Shortcut') ?></th>
      <th><?php echo __('Rank') ?></th>
      <th><?php echo __('Is active') ?></th>
      <th><?php echo __('Info?') ?></th>
      <th><?php echo __('Modules?') ?></th>
      <th><?php echo __('Tools?') ?></th>
      <th><?php echo __('Attachments?') ?></th>
      <th><?php echo __('Actions') ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($AppointmentTypes as $AppointmentType): ?>
    <tr>
      <td><?php echo $AppointmentType->getDescription() ?></td>
      <td><?php echo $AppointmentType->getShortcut() ?></td>
      <td><?php echo $AppointmentType->getRank() ?></td>
      <td><?php echo get_partial('content/list_field_boolean', array('value' => $AppointmentType->getIsActive())) ?></td>
      <td><?php echo get_partial('content/list_field_boolean', array('value' => $AppointmentType->getHasInfo())) ?></td>
      <td><?php echo get_partial('content/list_field_boolean', array('value' => $AppointmentType->getHasModules())) ?></td>
      <td><?php echo get_partial('content/list_field_boolean', array('value' => $AppointmentType->getHasTools())) ?></td>
      <td><?php echo get_partial('content/list_field_boolean', array('value' => $AppointmentType->getHasAttachments())) ?></td>
      <td><?php include_partial('action', array('AppointmentType' => $AppointmentType)) ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

</div>

<ul class="sf_admin_actions">
    <?php echo li_link_to_if(
    'action_new',
    true,
		__('New appointment type'),
		'appointmenttypes/new',
		array('title'=>__('Create a new appointment type'))
		)?>
</ul>


