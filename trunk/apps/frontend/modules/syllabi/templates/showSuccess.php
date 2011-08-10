<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $syllabus->getId() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $syllabus->getName() ?></td>
    </tr>
    <tr>
      <th>Version:</th>
      <td><?php echo $syllabus->getVersion() ?></td>
    </tr>
    <tr>
      <th>Author:</th>
      <td><?php echo $syllabus->getAuthor() ?></td>
    </tr>
    <tr>
      <th>Href:</th>
      <td><?php echo $syllabus->getHref() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<?php include_partial('syllabi/items', array('syllabus'=>$syllabus)) ?>

<a href="<?php echo url_for('syllabi/index') ?>">List</a>
