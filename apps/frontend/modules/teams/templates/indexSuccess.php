<?php include_partial('content/breadcrumps', array(
  'current'=>__("Teams")
  ))
?>

<?php include_partial('content/flashes'); ?>

<table>
  <thead>
    <tr>
      <th class="sf_admin_text"><?php echo __('Id') ?></th>
      <th class="sf_admin_text"><?php echo __('Description') ?></th>
      <th class="sf_admin_text"><?php echo __('Posix name') ?></th>
      <th class="sf_admin_text"><?php echo __('Quality code') ?></th>
      <th class="sf_admin_text"><?php echo __('Needs folder') ?></th>
      <th class="sf_admin_text"><?php echo __('Needs mailing list') ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($Teams as $Team): ?>
    <tr>
      <td><a href="<?php echo url_for('teams/show?id='.$Team->getId()) ?>"><?php echo $Team->getId() ?></a></td>
      <td><?php echo $Team->getDescription() ?></td>
      <td><?php echo $Team->getPosixName() ?></td>
      <td><?php echo $Team->getQualityCode() ?></td>
      <td><?php echo $Team->getNeedsFolder() ?></td>
      <td><?php echo $Team->getNeedsMailingList() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<ul class="sf_admin_actions">

  <li class="sf_admin_action_new">
    <?php echo link_to(
		__('New team'),
		'teams/new',
		array('title'=>__('Create a new team'))
		)?>
		</li>

</ul>
