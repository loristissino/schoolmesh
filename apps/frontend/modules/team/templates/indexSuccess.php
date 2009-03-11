<h1>Workgroup List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($workgroupList as $workgroup): ?>
    <tr>
      <td><a href="<?php echo url_for('workgroup/show?id='.$workgroup->getId()) ?>"><?php echo $workgroup->getId() ?></a></td>
      <td><?php echo $workgroup->getName() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<a href="<?php echo url_for('workgroup/create') ?>">Create</a>
