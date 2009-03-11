<h2>Schoolclass List</h2>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Grade</th>
      <th>Section</th>
      <th>Track</th>
      <th>Description</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($schoolclass_list as $schoolclass): ?>
    <tr>
      <td><a href="<?php echo url_for('schoolclass/edit?id='.$schoolclass->getId()) ?>"><?php echo $schoolclass->getId() ?></a></td>
      <td><?php echo $schoolclass->getGrade() ?></td>
      <td><?php echo $schoolclass->getSection() ?></td>
      <td><?php echo $schoolclass->getTrackId() ?></td>
      <td><?php echo $schoolclass->getDescription() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('schoolclass/new') ?>">New</a>
