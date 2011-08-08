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

<pre>
<?php foreach($syllabus->getSyllabusItems() as $syllabus_item): ?>
  <?php echo str_repeat(' ', $syllabus_item->getLevel()*2) ?>
  <?php echo $syllabus_item->getContent() . "\n" ?>
<?php endforeach ?>
</pre>


<a href="<?php echo url_for('syllabi/edit?id='.$syllabus->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('syllabi/index') ?>">List</a>
