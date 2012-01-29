<?php include_partial('content/breadcrumps', array(
  'current'=>__("Teams")
  ))
?>

<?php include_partial('content/flashes'); ?>

<?php if($sf_user->hasCredential('teams')): ?>
  <?php echo __('This is the full list of teams.') ?>
<?php else: ?>
  <?php echo __('In this list you can see all public teams and the ones you belong to.') ?>
<?php endif ?>

<table>
  <thead>
    <tr>
      <th class="sf_admin_text"><?php echo __('Description') ?></th>
      <th class="sf_admin_text"><?php echo __('Posix name') ?></th>
      <th class="sf_admin_text"><?php echo __('Quality code') ?></th>
      <th class="sf_admin_text"><?php echo __('Needs folder') ?></th>
      <th class="sf_admin_text"><?php echo __('Needs mailing list') ?></th>
      <th class="sf_admin_text"><?php echo __('Public?') ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($Teams as $Team): ?>
    <tr>
      <td><?php echo link_to($Team->getDescription(), url_for('teams/show?id='.$Team->getId())) ?></td>
      <td><?php echo $Team->getPosixName() ?></td>
      <td><?php echo $Team->getQualityCode() ?></td>
      <td style="text-align: center"><?php echo $Team->getNeedsFolder()? __('Yes'): __('No') ?></td>
      <td style="text-align: center"><?php echo $Team->getNeedsMailingList()? __('Yes'): __('No') ?></td>
      <td style="text-align: center"><?php echo $Team->getIsPublic()? __('Yes'): __('No') ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<ul class="sf_admin_actions">

    <?php echo li_link_to_if(
    'action_new',
    $sf_user->hasCredential('teams'),
		__('New team'),
		'teams/new',
		array('title'=>__('Create a new team'))
		)?>

</ul>
