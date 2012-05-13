<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    '_schoolclasses' => __('Classes'),
    'schoolclasses/view?id='. $Schoolclass->getId() => $Schoolclass->getId()
    ),
  'current'=>__('Appointments for class %schoolclass%', array('%schoolclass%'=>$Schoolclass->getId()))
  ))
?>

<?php include_partial('content/flashes'); ?>

<?php if($appointment_type_id): ?>
  <p>
    <?php echo __('Only appointments of type «%type%» are listed.', array('%type%'=>$AppointmentType)) . ' ' . link_to(__('List all appointments'), url_for('schoolclasses/appointments?id=' . $Schoolclass->getId())) ?>.
  </p>
	<form action="<?php echo url_for('schoolclasses/servedoc?id=' . $Schoolclass->getId(). '&type=' . $AppointmentType->getId()) ?>" method="get">
  <?php include_partial('plansandreports/checkalljs') ?>
<?php endif ?>

<table cellspacing="0">
  <thead>
    <tr>
      <?php if($appointment_type_id): ?>
        <th id="sf_admin_list_batch_actions"><input id="sf_admin_list_batch_checkbox" type="checkbox" onclick="checkAll();" /></th>
      <?php endif ?>
      <th class="sf_admin_text"><?php echo __('Type') ?></th>
      <th class="sf_admin_text"><?php echo __('Teacher') ?></th>
      <th class="sf_admin_text"><?php echo __('Subject') ?></th>
      <th class="sf_admin_text"><?php echo __('Actions') ?></th>
    </tr>
  </thead>
  <tbody>
	<?php $i=0 ?>
    <?php foreach ($Appointments as $Appointment): ?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
      <?php if($appointment_type_id): ?>
        <td>
        <input type="checkbox" name="info[ids][]" value="<?php echo $Appointment->getId() ?>" class="sf_admin_batch_checkbox" />
        </td>
      <?php endif ?>
      <td><?php echo $Appointment->getAppointmentType() ?></td>
      <td><?php echo $Appointment->getsfGuardUser()->getProfile() ?></td>
      <td><?php echo $Appointment->getSubject() ?></td>
      <td><ul class="sf_admin_td_actions">
      <?php echo li_link_to_if('td_action_filter', !$appointment_type_id, __('Filter'), url_for('schoolclasses/appointments?id='. $Appointment->getSchoolclassId() . '&type='.$Appointment->getAppointmentTypeId()), array('title'=>__('List only the appointments of type «%type%»', array('%type%'=>$Appointment->getAppointmentType())))) ?>
      <?php echo li_link_to_if('td_action_download', $Appointment->hasAttachments(), __('Attachments'), url_for('@attachments?object=Appointment&id='.$Appointment->getId())) ?>
      </ul></td>
    </tr>
    <?php endforeach; ?>
  </tbody>  
</table>

<?php if($appointment_type_id): ?>
<table>
<?php echo $form ?>
  <tr>
    <td colspan="2"><input type="submit" name="save" value="<?php echo __('Export') ?>"></td>
  </tr>
</table>
<?php endif ?>
