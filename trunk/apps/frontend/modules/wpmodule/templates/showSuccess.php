<h1>Module View</h1>

Ok, I should show the module...

<h2>The module</h2>
<pre>
	<?php print_r($wpmodule) ?>
</pre>
<h2>The workplan</h2>
<pre>
	<?php print_r($workplan) ?>
</pre>
<h2>Mine</h2>
<pre>
	<?php print_r($mine) ?>
</pre>

<?php /*

<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $wpmodule->getId() ?></td>
    </tr>
    <tr>
      <th>User:</th>
      <td><?php echo $wpmodule->getUserId() ?></td>
    </tr>
    <tr>
      <th>Title:</th>
      <td><?php echo $wpmodule->getTitle() ?></td>
    </tr>
    <tr>
      <th>Period:</th>
      <td><?php echo $wpmodule->getPeriod() ?></td>
    </tr>
    <tr>
      <th>Workplan:</th>
      <td><?php echo $wpmodule->getWorkplan() ?></td>
    </tr>
    <tr>
      <th>Is public:</th>
      <td><?php echo $wpmodule->getIsPublic() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $wpmodule->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $wpmodule->getUpdatedAt() ?></td>
    </tr>
  </tbody>
</table>

<?php include_partial('wpmoduleitems', array('wpmodule' => $wpmodule)) ?>

<hr />

<a href="<?php echo url_for('wpmodule/show?id='.$wpmodule->getId()) ?>">View</a>
&nbsp;
<a href="<?php echo url_for('wpmodule/edit?id='.$wpmodule->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('wpmodule/index') ?>">List</a>


*/ ?>