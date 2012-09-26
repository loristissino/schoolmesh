<h1>Wpmoduleitem List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Wpitem group</th>
      <th>Rank</th>
      <th>Content</th>
      <th>Evaluation</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($wpmodule_item_list as $wpmodule_item): ?>
    <tr>
      <td><a href="<?php echo url_for('wpmoduleitem/show?id='.$wpmodule_item->getId()) ?>"><?php echo $wpmodule_item->getId() ?></a></td>
      <td><?php echo $wpmodule_item->getWpitemGroupId() ?></td>
      <td><?php echo $wpmodule_item->getRank() ?></td>
      <td><?php echo $wpmodule_item->getContent() ?></td>
      <td><?php echo $wpmodule_item->getEvaluation() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('wpmoduleitem/new') ?>">New</a>
