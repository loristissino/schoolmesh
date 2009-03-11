<h1>Person List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($personList as $person): ?>
    <tr>
      <td><a href="<?php echo url_for('person/edit?id='.$person->getId()) ?>"><?php echo $person->getId() ?></a></td>
      <td><?php echo $person->getName() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<a href="<?php echo url_for('person/create') ?>">Create</a>
