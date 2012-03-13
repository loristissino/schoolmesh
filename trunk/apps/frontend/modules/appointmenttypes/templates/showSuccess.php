<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $AppointmentType->getId() ?></td>
    </tr>
    <tr>
      <th>Description:</th>
      <td><?php echo $AppointmentType->getDescription() ?></td>
    </tr>
    <tr>
      <th>Shortcut:</th>
      <td><?php echo $AppointmentType->getShortcut() ?></td>
    </tr>
    <tr>
      <th>Rank:</th>
      <td><?php echo $AppointmentType->getRank() ?></td>
    </tr>
    <tr>
      <th>Is active:</th>
      <td><?php echo $AppointmentType->getIsActive() ?></td>
    </tr>
    <tr>
      <th>Has info:</th>
      <td><?php echo $AppointmentType->getHasInfo() ?></td>
    </tr>
    <tr>
      <th>Has modules:</th>
      <td><?php echo $AppointmentType->getHasModules() ?></td>
    </tr>
    <tr>
      <th>Has tools:</th>
      <td><?php echo $AppointmentType->getHasTools() ?></td>
    </tr>
    <tr>
      <th>Has attachments:</th>
      <td><?php echo $AppointmentType->getHasAttachments() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('appointmenttypes/edit?id='.$AppointmentType->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('appointmenttypes/index') ?>">List</a>
