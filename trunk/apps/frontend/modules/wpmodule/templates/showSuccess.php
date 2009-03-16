<h1>Module View</h1>

<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $wpmodule->getId() ?></td>
    </tr>
    <tr>
      <th>Shortcut:</th>
      <td><?php echo $wpmodule->getShortcut() ?></td>
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

<?php if ($wpmodule->getWpmoduleItems()): ?>
<h2><?php echo __("Module Items"); ?></h2>
<ol>
<?php foreach($wpmodule->getWpmoduleItems() as $wpmoduleitem): ?>
<li><?php echo $wpmoduleitem; ?> (<?php echo $wpmoduleitem->getWpItemType() ?>) <a href="<?php echo url_for('wpmoduleitem/show?id='.$wpmoduleitem->getId()) ?>">View</a></li>
<?php endforeach; ?>
</ol>
<?php endif; ?>


<hr />

<a href="<?php echo url_for('wpmodule/show?id='.$wpmodule->getId()) ?>">View</a>
&nbsp;
<a href="<?php echo url_for('wpmodule/edit?id='.$wpmodule->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('wpmodule/index') ?>">List</a>
