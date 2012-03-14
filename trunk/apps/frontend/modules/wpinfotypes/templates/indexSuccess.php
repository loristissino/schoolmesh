<h1>WpinfoTypes List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Title</th>
      <th>Description</th>
      <th>Rank</th>
      <th>Code</th>
      <th>State min</th>
      <th>State max</th>
      <th>Template</th>
      <th>Example</th>
      <th>Is required</th>
      <th>Is confidential</th>
      <th>Grade min</th>
      <th>Grade max</th>
      <th>Appointment type</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($WpinfoTypes as $WpinfoType): ?>
    <tr>
      <td><a href="<?php echo url_for('wpinfotypes/show?id='.$WpinfoType->getId()) ?>"><?php echo $WpinfoType->getId() ?></a></td>
      <td><?php echo $WpinfoType->getTitle() ?></td>
      <td><?php echo $WpinfoType->getDescription() ?></td>
      <td><?php echo $WpinfoType->getRank() ?></td>
      <td><?php echo $WpinfoType->getCode() ?></td>
      <td><?php echo $WpinfoType->getStateMin() ?></td>
      <td><?php echo $WpinfoType->getStateMax() ?></td>
      <td><?php echo $WpinfoType->getTemplate() ?></td>
      <td><?php echo $WpinfoType->getExample() ?></td>
      <td><?php echo $WpinfoType->getIsRequired() ?></td>
      <td><?php echo $WpinfoType->getIsConfidential() ?></td>
      <td><?php echo $WpinfoType->getGradeMin() ?></td>
      <td><?php echo $WpinfoType->getGradeMax() ?></td>
      <td><?php echo $WpinfoType->getAppointmentTypeId() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('wpinfotypes/new') ?>">New</a>
