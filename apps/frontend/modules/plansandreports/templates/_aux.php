<?php use_helper('Javascript') ?>
<div id="aux_update">
<?php if ($sf_user->hasFlash('error_aux')): ?>
  <div class="error"><?php echo $sf_user->getFlash('error_aux')?></div>
<?php endif; ?>
<?php foreach($tools as $group): ?>
<h4><?php echo $group['description'] ?></h4>

<?php /*
<table>
<tr>
<td>
<p>I use:</p>
	<ul>
		<?php foreach($group['elements'] as $tool_id=>$tool): ?>
				<?php if ($tool['chosen']): ?>
					<li class="sf_admin_action_delete">
					<?php echo link_to_remote(
							$tool['description'], array(
								'update'=>'aux_update',
								'url' => 'plansandreports/removetool?id='. $workplan->getId() . '&tool='.$tool_id
								)
							) ?>
					</li>
				<?php endif ?>
		<?php endforeach ?>
	</ul>
</td>
<td>
<p>I don't use:</p>
<ul>
		<?php foreach($group['elements'] as $tool_id=>$tool): ?>
				<?php if (!$tool['chosen']): ?>
					<li class="sf_admin_action_new">
					<?php echo link_to_remote(
						$tool['description'], array(
							'update'=>'aux_update',
							'url' => 'plansandreports/addtool?id='. $workplan->getId() . '&tool='.$tool_id
							)
						) ?>
					</li>
				<?php endif ?>
		<?php endforeach ?>
	</ul>
</td>
</tr>
</table>
 ?>
		<?php foreach($group['elements'] as $tool_id=>$tool): ?>
				&nbsp;&nbsp;&nbsp;&nbsp;
				<?php if ($tool['chosen']): ?>
					<strong>
					<?php echo link_to_remote(
						sprintf(__('Yes: %s'), $tool['description']), array(
							'update'=>'aux_update',
							'url' => 'plansandreports/removetool?id='. $workplan->getId() . '&tool='.$tool_id
							)
						) ?>
					</strong>
				<?php else: ?>
					<?php echo link_to_remote(
						sprintf(__('No: %s'), $tool['description']), array(
							'update'=>'aux_update',
							'url' => 'plansandreports/addtool?id='. $workplan->getId() . '&tool='.$tool_id
							)
						) ?>
				<?php endif ?>
				<br />
		<?php endforeach ?>
*/?>
		<?php foreach($group['elements'] as $tool_id=>$tool): ?>
				<?php if ($tool['chosen']): ?>
					&nbsp;&nbsp;&nbsp;&nbsp;<strong>
					<?php echo link_to_remote(
						sprintf(__('Yes: %s'), $tool['description']), array(
							'update'=>'aux_update',
							'url' => 'plansandreports/removetool?id='. $workplan->getId() . '&tool='.$tool_id
							)
						) ?>
					</strong><br />
				<?php endif ?>
		<?php endforeach ?>
		<?php foreach($group['elements'] as $tool_id=>$tool): ?>
				<?php if (!$tool['chosen']): ?>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<?php echo link_to_remote(
						sprintf(__('No: %s'), $tool['description']), array(
							'update'=>'aux_update',
							'url' => 'plansandreports/addtool?id='. $workplan->getId() . '&tool='.$tool_id
							)
						) ?><br />
				<?php endif ?>
		<?php endforeach ?>

<?php endforeach ?>
</div>
