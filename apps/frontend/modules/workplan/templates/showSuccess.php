<h1>Workplan View</h1>

<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $workplan->getId() ?></td>
    </tr>
    <tr>
      <th>User:</th>
      <td><?php echo $workplan->getsfGuardUser()->getProfile()->getFullName() ?></td>
    </tr>
    <tr>
      <th>Year:</th>
      <td><?php echo $workplan->getYear() ?></td>
    </tr>
    <tr>
      <th>Class:</th>
      <td><?php echo $workplan->getSchoolclass() ?></td>
    </tr>
    <tr>
      <th>Subject:</th>
      <td><?php echo $workplan->getSubject() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $workplan->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $workplan->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>


<?php if ($workplan->getWpmodules()): ?>
<h2><?php echo __("Modules"); ?></h2>
<ol>
<?php foreach($workplan->getWpmodules() as $wpmodule): ?>
<li><?php echo $wpmodule; ?> <a href="<?php echo url_for('wpmodule/show?id='.$wpmodule->getId()) ?>">View</a></li>
<?php endforeach; ?>
</ol>
<?php endif; ?>

<hr />

<?php if (!$workplan->getIsLocked()): ?>
	<a href="<?php echo url_for('workplan/edit?id='.$workplan->getId()) ?>">Edit</a>
	&nbsp;
<?php endif; ?>
<a href="<?php echo url_for('workplan/index') ?>">List</a>
