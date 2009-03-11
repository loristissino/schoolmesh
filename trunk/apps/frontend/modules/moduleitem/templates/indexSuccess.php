<h1>Unititem List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Item type</th>
      <th>Unit</th>
      <th>Position</th>
      <th>Content</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($unit_itemList as $unit_item): ?>
    <tr>
      <td><a href="<?php echo url_for('unititem/edit?id='.$unit_item->getId()) ?>"><?php echo $unit_item->getId() ?></a></td>
      <td><?php echo $unit_item->getItemTypeId() ?></td>
      <td><?php echo $unit_item->getUnitId() ?></td>
      <td><?php echo $unit_item->getPosition() ?></td>
      <td><?php echo $unit_item->getContent() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<a href="<?php echo url_for('unititem/create') ?>">Create</a>
