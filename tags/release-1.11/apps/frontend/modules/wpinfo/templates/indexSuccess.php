<h1>Wpinfo List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Appointment</th>
      <th>Wpinfo type</th>
      <th>Content</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($wpinfo_list as $wpinfo): ?>
    <tr>
      <td><a href="<?php echo url_for('wpinfo/edit?id='.$wpinfo->getId()) ?>"><?php echo $wpinfo->getId() ?></a></td>
      <td><?php echo $wpinfo->getAppointmentId() ?></td>
      <td><?php echo $wpinfo->getWpinfoTypeId() ?></td>
      <td><?php echo $wpinfo->getContent() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('wpinfo/new') ?>">New</a>
