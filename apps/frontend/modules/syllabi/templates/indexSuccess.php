<h1>Syllabi List</h1>

<table>
  <thead>
    <tr>
      <th>Id</th>
      <th>Name</th>
      <th>Version</th>
      <th>Author</th>
      <th>Href</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($syllabi as $syllabus): ?>
    <tr>
      <td><a href="<?php echo url_for('syllabi/show?id='.$syllabus->getId()) ?>"><?php echo $syllabus->getId() ?></a></td>
      <td><?php echo $syllabus->getName() ?></td>
      <td><?php echo $syllabus->getVersion() ?></td>
      <td><?php echo $syllabus->getAuthor() ?></td>
      <td><?php echo $syllabus->getHref() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('syllabi/new') ?>">New</a>
