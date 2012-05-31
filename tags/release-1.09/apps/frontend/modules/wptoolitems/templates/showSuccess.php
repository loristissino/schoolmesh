<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $WptoolItem->getId() ?></td>
    </tr>
    <tr>
      <th>Description:</th>
      <td><?php echo $WptoolItem->getDescription() ?></td>
    </tr>
    <tr>
      <th>Rank:</th>
      <td><?php echo $WptoolItem->getRank() ?></td>
    </tr>
    <tr>
      <th>Code:</th>
      <td><?php echo $WptoolItem->getCode() ?></td>
    </tr>
    <tr>
      <th>Wptool item type:</th>
      <td><?php echo $WptoolItem->getWptoolItemTypeId() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('wptoolitems/edit?id='.$WptoolItem->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('wptoolitems/index') ?>">List</a>
