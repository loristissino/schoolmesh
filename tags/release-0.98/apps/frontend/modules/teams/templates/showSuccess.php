<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $Team->getId() ?></td>
    </tr>
    <tr>
      <th>Description:</th>
      <td><?php echo $Team->getDescription() ?></td>
    </tr>
    <tr>
      <th>Posix name:</th>
      <td><?php echo $Team->getPosixName() ?></td>
    </tr>
    <tr>
      <th>Quality code:</th>
      <td><?php echo $Team->getQualityCode() ?></td>
    </tr>
    <tr>
      <th>Needs folder:</th>
      <td><?php echo $Team->getNeedsFolder() ?></td>
    </tr>
    <tr>
      <th>Needs mailing list:</th>
      <td><?php echo $Team->getNeedsMailingList() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('teams/edit?id='.$Team->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('teams/index') ?>">List</a>
