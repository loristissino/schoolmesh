<h1>Unit List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Shortcut</th>
      <th>User</th>
      <th>Title</th>
      <th>Period</th>
      <th>Is public</th>
      <th>Locked</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($unitList as $unit): ?>
    <tr>
      <td><a href="<?php echo url_for('unit/edit?id='.$unit->getId()) ?>"><?php echo $unit->getId() ?></a></td>
      <td><?php echo $unit->getShortcut() ?></td>
      <td><?php echo $unit->getUserId() ?></td>
      <td><?php echo $unit->getTitle() ?></td>
      <td><?php echo $unit->getPeriod() ?></td>
      <td><?php echo $unit->getIsPublic() ?></td>
      <td><?php echo $unit->getLocked() ?></td>
      <td><?php echo $unit->getCreatedAt() ?></td>
      <td><?php echo $unit->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<a href="<?php echo url_for('unit/create') ?>">Create</a>
