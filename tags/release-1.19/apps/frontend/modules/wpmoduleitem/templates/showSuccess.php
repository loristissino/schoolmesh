<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $wpmodule_item->getId() ?></td>
    </tr>
    <tr>
      <th>Wpitem group:</th>
      <td><?php echo $wpmodule_item->getWpitemGroupId() ?></td>
    </tr>
    <tr>
      <th>Rank:</th>
      <td><?php echo $wpmodule_item->getRank() ?></td>
    </tr>
    <tr>
      <th>Content:</th>
      <td><?php echo $wpmodule_item->getContent() ?></td>
    </tr>
    <tr>
      <th>Evaluation:</th>
      <td><?php echo $wpmodule_item->getEvaluation() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('wpmoduleitem/edit?id='.$wpmodule_item->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('wpmoduleitem/index') ?>">List</a>
