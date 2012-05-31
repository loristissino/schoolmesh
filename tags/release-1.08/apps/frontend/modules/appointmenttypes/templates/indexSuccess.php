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
      <td>
        <?php echo get_partial('content/list_field_boolean', array('value' => $AppointmentType->getHasInfo())) ?>
        <?php echo get_partial('warnings_info', array('AppointmentType'=>$AppointmentType, 'WpinfoTypes'=>$AppointmentType->getWpinfoTypes(), 'with_text'=>false)) ?>
      </td>
      <td>
        <?php echo get_partial('content/list_field_boolean', array('value' => $AppointmentType->getHasModules())) ?>
        <?php echo get_partial('warnings_modules', array('AppointmentType'=>$AppointmentType, 'WpitemTypes'=>$AppointmentType->getWpitemTypes(), 'with_text'=>false)) ?>
      </td>
      <td>
        <?php echo get_partial('content/list_field_boolean', array('value' => $AppointmentType->getHasTools())) ?>
        <?php echo get_partial('warnings_tools', array('AppointmentType'=>$AppointmentType, 'WptoolItemTypes'=>$AppointmentType->getWptoolItemTypes(), 'with_text'=>false)) ?>
      </td>
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


