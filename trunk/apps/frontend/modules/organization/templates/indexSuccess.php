<?php include_partial('content/breadcrumps', array(
  'current'=>__("Organization")
  ))
?>

<?php include_partial('content/flashes'); ?>

<h2><?php echo __('Organizational chart') ?></h2>

<p><?php echo __('TO DO') ?></p>

<h2><?php echo __('Key roles index') ?></h2>

<?php foreach($list as $item): ?>
<h3><?php echo $item['keyrole']->getMaleDescription() ?></h3>

<?php if(sizeof($item['userteam'])>0): ?>

<div class="sf_admin_list">
<table cellspacing="0">
  <thead>
    <tr>
      <th class="sf_admin_text"><?php echo __('Quality code') ?></th>
      <th class="sf_admin_text"><?php echo __('Name') ?></th>
      <th class="sf_admin_text"><?php echo __('Expiry') ?></th>
    </tr>
  </thead>
  <tbody>
	<?php $i=0 ?>
    <?php foreach($item['userteam'] as $component): ?>
      <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
        <td><?php echo $item['keyrole']->getQualityCode() ?></td>
        <td><?php echo $component->getSfGuardUser()->getProfile()->getFullname() ?></td>
        <td><?php echo $component->getExpiry() ?></td>
      </tr>
  <?php endforeach ?>
  </tbody>
</table>
</div>
<?php else: ?>
<p><?php echo __('No info available') ?></p>
<?php endif ?>

<?php endforeach ?>
