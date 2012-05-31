<div id="sf_admin_container">

<h1>Wpitemtype List</h1>

<div class="sf_admin_list">

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Title</th>
      <th>Description</th>
      <th>Rank</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($wpitem_type_list as $wpitem_type): ?>
    <tr>
      <td><a href="<?php echo url_for('wpitemtype/edit?id='.$wpitem_type->getId()) ?>"><?php echo $wpitem_type->getId() ?></a></td>
      <td><?php echo $wpitem_type->getTitle() ?></td>
      <td><?php echo $wpitem_type->getDescription() ?></td>
      <td><?php echo $wpitem_type->getRank() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('wpitemtype/new') ?>">New</a>
