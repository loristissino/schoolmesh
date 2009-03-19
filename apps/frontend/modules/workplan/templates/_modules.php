<?php if ($workplan->countWpmodules()): ?>

<?php $i=0 ?>
<div class="sf_admin_list">

<table cellspacing="0">
  <thead>
    <tr>
      <th class="sf_admin_text" colspan="3">Rank</th>
      <th class="sf_admin_text">Period</th>
      <th class="sf_admin_text">Title</th>
      <th class="sf_admin_text">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($workplan->getWpmodules() as $wpmodule): ?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
      <td><?php echo $wpmodule->getRank() ?></td>
	  
	<td>
	<?php if($wpmodule->getRank()<$workplan->countWpmodules()): ?>
		<?php include_partial('movedown', array('wpmodule' => $wpmodule)) ?>
	<?php endif ?>
	</td>
	<td><?php if($wpmodule->getRank()>1): ?>
		<?php include_partial('moveup', array('wpmodule' => $wpmodule)) ?>
	<?php endif ?>
	</td>
	
      <td><?php echo $wpmodule->getPeriod() ?></td>
      <td><?php echo $wpmodule ?></td>
      <td>
		<ul class="sf_admin_td_actions">
			<li class="sf_admin_action_edit">
				<?php echo link_to(
				__('Edit'),
				'wpmodule/edit?id='.$wpmodule->getId(),
				array('method' => 'get') 
				)?>
			</li>
			<li class="sf_admin_action_delete">
				<?php echo link_to(
				__('Delete'),
				'wpmodule/delete?id='.$wpmodule->getId(),
				array('method' => 'delete', 'confirm' => __('Are you sure?')) 
				)?>
			</li>
		</ul>
	  </td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php endif; ?>