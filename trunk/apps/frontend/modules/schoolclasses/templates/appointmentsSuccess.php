<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    '_schoolclasses' => __('Classes'),
    'schoolclasses/show?id='. $Schoolclass->getId() => $Schoolclass->getId()
    ),
  'current'=>__('Appointments for class %schoolclass%', array('%schoolclass%'=>$Schoolclass->getId()))
  ))
?>

<?php include_partial('content/flashes'); ?>

<?php if($appointment_type_id): ?>
<p>
  <?php echo __('Only appointments of type «%type%» are listed.', array('%type%'=>$AppointmentType)) . ' ' . link_to(__('Show all appointments'), url_for('schoolclasses/appointments?id=' . $Schoolclass->getId())) ?>.
</p>
<?php endif ?>

<table cellspacing="0">
  <thead>
    <tr>
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
      <td><?php echo $Appointment->getAppointmentType() ?></td>
      <td><?php echo $Appointment->getsfGuardUser()->getProfile() ?></td>
      <td><?php echo $Appointment->getSubject() ?></td>
      <td><ul class="sf_admin_td_actions">
      <?php echo li_link_to_if('td_action_filter', !$appointment_type_id, __('Filter'), url_for('schoolclasses/appointments?id='. $Appointment->getSchoolclassId() . '&type='.$Appointment->getAppointmentTypeId()), array('title'=>__('Show only the appointments of this kind'))) ?>
      <?php echo li_link_to_if('td_action_download', $Appointment->hasAttachments(), __('Attachments'), url_for('@attachments?object=Appointment&id='.$Appointment->getId())) ?>
      </ul></td>
    </tr>
    <?php endforeach; ?>
  </tbody>  
</table>
