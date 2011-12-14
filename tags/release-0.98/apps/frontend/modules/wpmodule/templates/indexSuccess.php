<h1>Wpmodule List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Shortcut</th>
      <th>User</th>
      <th>Title</th>
      <th>Period</th>
      <th>Workplan</th>
      <th>Is public</th>
      <th>Created at</th>
      <th>Updated at</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($wpmodule_list as $wpmodule): ?>
    <tr>
      <td><a href="<?php echo url_for('wpmodule/show?id='.$wpmodule->getId()) ?>"><?php echo $wpmodule->getId() ?></a></td>
      <td><?php echo $wpmodule->getShortcut() ?></td>
      <td><?php echo $wpmodule->getUserId() ?></td>
      <td><?php echo $wpmodule->getTitle() ?></td>
      <td><?php echo $wpmodule->getPeriod() ?></td>
      <td><?php echo $wpmodule->getWorkplanId() ?></td>
      <td><?php echo $wpmodule->getIsPublic() ?></td>
      <td><?php echo $wpmodule->getCreatedAt() ?></td>
      <td><?php echo $wpmodule->getUpdatedAt() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('wpmodule/new') ?>">New</a>
