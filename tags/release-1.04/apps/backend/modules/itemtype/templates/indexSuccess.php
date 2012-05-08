<h1>Itemtype List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Title</th>
      <th>Description</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($item_typeList as $item_type): ?>
    <tr>
      <td><a href="<?php echo url_for('itemtype/edit?id='.$item_type->getId()) ?>"><?php echo $item_type->getId() ?></a></td>
      <td><?php echo $item_type->getTitle() ?></td>
      <td><?php echo $item_type->getDescription() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<a href="<?php echo url_for('itemtype/create') ?>">Create</a>
