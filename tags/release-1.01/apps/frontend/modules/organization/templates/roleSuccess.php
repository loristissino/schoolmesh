<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    '@organization'=>__('Organization'),
  ),
  'current'=>__('Functional role «%role%»', array('%role%'=>$role->getMaleDescription()))
  ))
?>

<?php include_partial('content/flashes'); ?>

<div class="sf_admin_list">

<?php if($userteam): ?>

<table cellspacing="0">
  <thead>
    <tr>
      <th class="sf_admin_text"><?php echo __('Role') ?></th>
      <th class="sf_admin_text"><?php echo __('Quality code') ?></th>
      <th class="sf_admin_text"><?php echo __('Charged user') ?></th>
      <th class="sf_admin_text"><?php echo __('Expiry') ?></th>
      <th class="sf_admin_text"><?php echo __('Team') ?></th>
    </tr>
  </thead>
  <tbody>
	<?php $i=0 ?>
  <?php foreach($userteam as $component): ?>
    <?php include_partial('tr_userteam', array('role'=>$role, 'component'=>$component)) ?>
  <?php endforeach ?>
  </tbody>
</table>

<?php else: ?>

<p><?php echo __('No one in charge') ?></p>

<?php endif ?>

</div>