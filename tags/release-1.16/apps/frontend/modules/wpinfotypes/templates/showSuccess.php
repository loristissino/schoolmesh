<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $WpinfoType->getId() ?></td>
    </tr>
    <tr>
      <th>Title:</th>
      <td><?php echo $WpinfoType->getTitle() ?></td>
    </tr>
    <tr>
      <th>Description:</th>
      <td><?php echo $WpinfoType->getDescription() ?></td>
    </tr>
    <tr>
      <th>Rank:</th>
      <td><?php echo $WpinfoType->getRank() ?></td>
    </tr>
    <tr>
      <th>Code:</th>
      <td><?php echo $WpinfoType->getCode() ?></td>
    </tr>
    <tr>
      <th>State min:</th>
      <td><?php echo $WpinfoType->getStateMin() ?></td>
    </tr>
    <tr>
      <th>State max:</th>
      <td><?php echo $WpinfoType->getStateMax() ?></td>
    </tr>
    <tr>
      <th>Template:</th>
      <td><?php echo $WpinfoType->getTemplate() ?></td>
    </tr>
    <tr>
      <th>Example:</th>
      <td><?php echo $WpinfoType->getExample() ?></td>
    </tr>
    <tr>
      <th>Is required:</th>
      <td><?php echo $WpinfoType->getIsRequired() ?></td>
    </tr>
    <tr>
      <th>Is confidential:</th>
      <td><?php echo $WpinfoType->getIsConfidential() ?></td>
    </tr>
    <tr>
      <th>Grade min:</th>
      <td><?php echo $WpinfoType->getGradeMin() ?></td>
    </tr>
    <tr>
      <th>Grade max:</th>
      <td><?php echo $WpinfoType->getGradeMax() ?></td>
    </tr>
    <tr>
      <th>Appointment type:</th>
      <td><?php echo $WpinfoType->getAppointmentTypeId() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('wpinfotypes/edit?id='.$WpinfoType->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('wpinfotypes/index') ?>">List</a>
