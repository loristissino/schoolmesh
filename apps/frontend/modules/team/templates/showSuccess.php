<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $workgroup->getId() ?></td>
    </tr>
    <tr>
      <th>Name:</th>
      <td><?php echo $workgroup->getName() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('workgroup/edit?id='.$workgroup->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('workgroup/index') ?>">List</a>
