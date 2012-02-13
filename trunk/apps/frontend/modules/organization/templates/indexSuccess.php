<?php include_partial('content/breadcrumps', array(
  'current'=>__("Organization")
  ))
?>

<?php include_partial('content/flashes'); ?>

<div class="sf_admin_list">

<table cellspacing="0">
  <thead>
    <tr>
      <th class="sf_admin_text"><?php echo __('Key role') ?></th>
      <th class="sf_admin_text"><?php echo __('Quality code') ?></th>
      <th class="sf_admin_text"><?php echo __('Name') ?></th>
      <th class="sf_admin_text"><?php echo __('Expiry') ?></th>
      <th class="sf_admin_text"><?php echo __('Team') ?></th>
    </tr>
  </thead>
  <tbody>
	<?php $i=0 ?>
    <?php foreach($list as $item): ?>
      <?php foreach($item['userteam'] as $component): ?>
        <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
          <td><?php echo $item['keyrole']->getMaleDescription() ?></td>
          <td><?php echo $item['keyrole']->getQualityCode() ?></td>
          <td><?php echo $component->getSfGuardUser()->getProfile()->getFullname() ?></td>
          <td style="text-align: right"><?php include_partial('content/expiry', array('date'=>$component->getExpiry('U'))) ?></td>
          <td><?php echo link_to_if($sf_user->hasCredential('teams'), $component->getTeam(), url_for('teams/show?id=' . $component->getTeam()->getId())) ?></td>
        </tr>
      <?php endforeach ?>
    <?php endforeach ?>
  </tbody>
</table>
</div>
