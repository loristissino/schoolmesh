<?php include_partial('content/breadcrumps', array(
  'current'=>__("Roles")
  ))
?>

<?php include_partial('content/flashes'); ?>

<div class="sf_admin_list">

<table cellspacing="0">
  <thead>
    <tr>
      <th class="sf_admin_text"><?php echo __('Description') ?></th>
      <th class="sf_admin_text"><?php echo __('Quality code') ?></th>
      <th class="sf_admin_text"><?php echo __('Main?') ?></th>
      <th class="sf_admin_text"><?php echo __('Charge letter?') ?></th>
      <th class="sf_admin_text"><?php echo __('Key?') ?></th>
      <th class="sf_admin_text"><?php echo __('Rank') ?></th>
      <th class="sf_admin_text"><?php echo __('Actions') ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($Roles as $Role): ?>
    <tr>
      <td><?php echo $Role->getMaleDescription() ?></td>
      <td><?php echo $Role->getQualityCode() ?></td>
      <td><?php echo get_partial('content/list_field_boolean', array('value' => $Role->getMayBeMainRole())) ?></td>
      <td><?php echo get_partial('content/list_field_boolean', array('value' => $Role->getNeedsChargeLetter())) ?></td>
      <td><?php echo get_partial('content/list_field_boolean', array('value' => $Role->getIsKey())) ?></td>
      <td style="text-align: right"><?php echo $Role->getRank() ?></td>
      <td><?php include_partial('action', array('Role' => $Role)) ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<ul class="sf_admin_actions">
    <?php echo li_link_to_if(
    'action_new',
    true,
		__('New role'),
		'roles/new',
		array('title'=>__('Create a new role'))
		)?>
</ul>
