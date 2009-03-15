<div id="sf_admin_container">

<h1>Workplan List</h1>

<div class="sf_admin_list">

<table cellspacing="0">
  <thead>
    <tr>
      <th>Id</th>
      <th>Year</th>
      <th>Schoolclass</th>
      <th>Subject</th>
      <th>Is locked</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($workplan_list as $workplan): ?>
    <tr>
      <td><a href="<?php echo url_for('workplan/edit?id='.$workplan->getId()) ?>"><?php echo $workplan->getId() ?></a></td>
      <td><?php echo $workplan->getYear() ?></td>
      <td><?php echo $workplan->getSchoolclassId() ?></td>
      <td><?php echo $workplan->getSubject() ?></td>
      <td><?php echo $workplan->getIsLocked() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('workplan/new') ?>">New</a>
