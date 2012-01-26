<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'profile'=>__('My profile')
    ),
  'current'=>__('My teams'),
  ))
?>

<?php include_partial('content/flashes'); ?>

<table>
  <thead>
    <tr>
      <th class="sf_admin_text"><?php echo __('Description') ?></th>
      <th class="sf_admin_text"><?php echo __('Posix name') ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($Teams as $Team): ?>
    <tr>
      <td><?php echo link_to($Team->getTeam()->getDescription(), url_for('teams/show?id='.$Team->getTeam()->getId())) ?></td>
      <td><?php echo $Team->getTeam()->getPosixName() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
