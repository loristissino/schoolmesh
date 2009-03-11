<h2><?php echo __('Appointment List') ?></h2>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>User</th>
      <th>Subject</th>
      <th>Schoolclass</th>
      <th>Year</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($appointment_list as $appointment): ?>
    <tr>
      <td><a href="<?php echo url_for('appointment/edit?id='.$appointment->getId()) ?>"><?php echo $appointment->getId() ?></a></td>
      <td><?php echo $appointment->getsfGuardUser()->getProfile()->getFullName() ?></td>
      <td><?php echo $appointment->getSubject() ?></td>
      <td><?php echo $appointment->getSchoolclassId() ?></td>
      <td><?php echo $appointment->getYearId() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('appointment/new') ?>">New</a>
