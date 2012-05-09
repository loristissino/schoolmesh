<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'appointmenttypes/index' => __('Appointment types'),
    ),
  'current'=>__('Appointment type «%description%»', array('%description%'=>$AppointmentType))
  ))
?>

<table>
  <tbody>
    <tr>
      <th><?php echo __('Id') ?>:</th>
      <td colspan="2"><?php echo $AppointmentType->getId() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Description') ?>:</th>
      <td colspan="2"><?php echo $AppointmentType->getDescription() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Shortcut') ?>:</th>
      <td colspan="2"><?php echo $AppointmentType->getShortcut() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Rank') ?>:</th>
      <td colspan="2"><?php echo $AppointmentType->getRank() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Is active') ?></th>
      <td colspan="2"><?php echo get_partial('content/list_field_boolean', array('value' => $AppointmentType->getIsActive())) ?></td>
    </tr>
    <tr>
      <th><a href="#info"><?php echo __('Info?') ?></a></th>
      <td>
        <?php echo get_partial('content/list_field_boolean', array('value' => $AppointmentType->getHasInfo())) ?>
      </td>
      <td>
        <?php echo get_partial('warnings_info', array('AppointmentType'=>$AppointmentType, 'WpinfoTypes'=>$WpinfoTypes, 'with_text'=>true)) ?>
      </td>
    </tr>
    <tr>
      <th><a href="#modules"><?php echo __('Modules?') ?></a></th>
      <td><?php echo get_partial('content/list_field_boolean', array('value' => $AppointmentType->getHasModules())) ?></td>
      <td>
        <?php echo get_partial('warnings_modules', array('AppointmentType'=>$AppointmentType, 'WpitemTypes'=>$WpitemTypes, 'with_text'=>true)) ?>
      </td>
    </tr>
    <tr>
      <th><a href="#tools"><?php echo __('Tools?') ?></a></th>
      <td><?php echo get_partial('content/list_field_boolean', array('value' => $AppointmentType->getHasTools())) ?></td>
      <td>
        <?php echo get_partial('warnings_tools', array('AppointmentType'=>$AppointmentType, 'WptoolItemTypes'=>$WptoolItemTypes, 'with_text'=>true)) ?>
      </td>
    </tr>
    <tr>
      <th><?php echo __('Attachments?') ?></th>
      <td><?php echo get_partial('content/list_field_boolean', array('value' => $AppointmentType->getHasAttachments())) ?></td>
      <td></td>
    </tr>
  </tbody>
</table>

<hr />

<ul class="sf_admin_actions">
  <?php echo li_link_to_if(
    'action_edit',
    true,
    __('Edit'),
    url_for('appointmenttypes/edit?id=' . $AppointmentType->getId()),
    array('title'=>__('Edit this appointment type'))
  )?>
  <?php echo li_link_to_if(
    'action_new',
    $AppointmentType->getHasInfo(),
		__('New info field type'),
		'wpinfotypes/new?appointmenttype='. $AppointmentType->getId(),
		array('title'=>__('Create a new info field type'))
		)?>
  <?php echo li_link_to_if(
    'action_new',
    $AppointmentType->getHasModules(),
		__('New didactic module item field type'),
		'wpitemtypes/new?appointmenttype='. $AppointmentType->getId(),
		array('title'=>__('Create a new didactic module item field type'))
		)?>
  <?php echo li_link_to_if(
    'action_new',
    $AppointmentType->getHasTools(),
		__('New group of tools/methodologies'),
		'wptooltypes/new?appointmenttype='. $AppointmentType->getId(),
		array('title'=>__('Create a new group of tools/methodologies'))
		)?>

</ul>

<?php if(sizeof($WpinfoTypes)): ?>
<hr />
<h2 id="info"><?php echo __('General information') ?></h2>

<?php foreach($WpinfoTypes as $WpinfoType): ?>
  <?php include_partial('wpinfotypes/information', array('WpinfoType'=>$WpinfoType)) ?>
<?php endforeach ?>

<?php endif ?>

<?php if(sizeof($WpitemTypes)): ?>
<hr />

<h2 id="modules"><?php echo __('Modules') ?></h2>

<?php foreach($WpitemTypes as $WpitemType): ?>
  <?php include_partial('wpitemtypes/information', array('WpitemType'=>$WpitemType)) ?>
<?php endforeach ?>

<?php endif ?>

<?php if(sizeof($WptoolItemTypes)): ?>
<hr />

<h2 id="tools"><?php echo __('Tools and methodologies') ?></h2>

<?php foreach($WptoolItemTypes as $WptoolItemType): ?>
  <?php include_partial('wptooltypes/information', array('WptoolItemType'=>$WptoolItemType)) ?>
<?php endforeach ?>

<?php endif ?>
