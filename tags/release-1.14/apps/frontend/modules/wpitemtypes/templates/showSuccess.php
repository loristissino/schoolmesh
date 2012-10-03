<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $WpitemType->getId() ?></td>
    </tr>
    <tr>
      <th>Title:</th>
      <td><?php echo $WpitemType->getTitle() ?></td>
    </tr>
    <tr>
      <th>Singular:</th>
      <td><?php echo $WpitemType->getSingular() ?></td>
    </tr>
    <tr>
      <th>Description:</th>
      <td><?php echo $WpitemType->getDescription() ?></td>
    </tr>
    <tr>
      <th>Style:</th>
      <td><?php echo $WpitemType->getStyle() ?></td>
    </tr>
    <tr>
      <th>Rank:</th>
      <td><?php echo $WpitemType->getRank() ?></td>
    </tr>
    <tr>
      <th>State min:</th>
      <td><?php echo $WpitemType->getStateMin() ?></td>
    </tr>
    <tr>
      <th>State max:</th>
      <td><?php echo $WpitemType->getStateMax() ?></td>
    </tr>
    <tr>
      <th>Is required:</th>
      <td><?php echo $WpitemType->getIsRequired() ?></td>
    </tr>
    <tr>
      <th>Appointment type:</th>
      <td><?php echo $WpitemType->getAppointmentTypeId() ?></td>
    </tr>
    <tr>
      <th>Code:</th>
      <td><?php echo $WpitemType->getCode() ?></td>
    </tr>
    <tr>
      <th>Evaluation min:</th>
      <td><?php echo $WpitemType->getEvaluationMin() ?></td>
    </tr>
    <tr>
      <th>Evaluation max:</th>
      <td><?php echo $WpitemType->getEvaluationMax() ?></td>
    </tr>
    <tr>
      <th>Evaluation min description:</th>
      <td><?php echo $WpitemType->getEvaluationMinDescription() ?></td>
    </tr>
    <tr>
      <th>Evaluation max description:</th>
      <td><?php echo $WpitemType->getEvaluationMaxDescription() ?></td>
    </tr>
    <tr>
      <th>Grade min:</th>
      <td><?php echo $WpitemType->getGradeMin() ?></td>
    </tr>
    <tr>
      <th>Grade max:</th>
      <td><?php echo $WpitemType->getGradeMax() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('wpitemtypes/edit?id='.$WpitemType->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('wpitemtypes/index') ?>">List</a>
