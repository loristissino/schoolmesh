<?php use_helper('Javascript') ?>
<?php use_helper('jQuery') ?>
<div id="aux_update">
<?php if ($sf_user->hasFlash('error_aux')): ?>
  <div class="error"><?php echo __($sf_user->getFlash('error_aux')) ?></div>
<?php endif; ?>
<table>
<tr>
<?php foreach($tools as $group): ?>
<td>
<?php if ($group['state']==$workplan->getState()): ?>
	<?php if ($sf_user->hasFlash('error_aux'. $group['id'])): ?>
  <div class="error"><?php echo $sf_user->getFlash('error_aux'.$group['id'])?></div>
<?php endif; ?>
	<p>
	<?php if($group['min_selected']==0):?>
		<?php echo image_tag('optional') ?>
	<?php else: ?>
		<?php echo image_tag('fill') ?>
	<?php endif ?>
	
	<em><?php echo format_number_choice(
		'[0]Optional choice|[1]Select at least one item|(1,+Inf]Select at least %1% items', array('%1%' => $group['min_selected']), $group['min_selected']) ?></em></p>

<?php endif ?>
<h4><?php echo $group['description'] ?></h4>
		<?php foreach($group['elements'] as $tool_id=>$tool): ?>
				&nbsp;
				<?php if ($tool['chosen']): ?>
					&nbsp;&nbsp;<strong>
					<?php if ($group['state']==$workplan->getState()): ?>
						<?php echo jq_link_to_remote(
						sprintf(__('▣ %s'), $tool['description']), array(
							'update'=>'aux_update',
							'url' => 'plansandreports/removetool?id='. $workplan->getId() . '&tool='.$tool_id,
							'loading'=>'$(\'loader' . $tool_id . '\').show();',
							)
						) ?>
					<?php else: ?>
						<?php echo sprintf(__('▣ %s'), $tool['description']) ?>
					<?php endif ?>
					</strong>
				<?php else: ?>
					&nbsp;&nbsp;
					<?php if ($group['state']==$workplan->getState()): ?>
						<?php echo jq_link_to_remote(
							sprintf(__('▢ %s'), $tool['description']), array(
								'update'=>'aux_update',
								'url' => 'plansandreports/addtool?id='. $workplan->getId() . '&tool='.$tool_id,
								'loading'=>'$(\'loader' . $tool_id . '\').show();',
								)
							) ?>
						<?php else: ?>
							<?php echo sprintf(__('▢ %s'), $tool['description']) ?>
						<?php endif ?>
				<?php endif ?><?php echo image_tag('loader.gif', array('style'=>'vertical-align: middle; display: none', 'id'=>'loader'.$tool_id)) ?>
				<br />
		<?php endforeach ?>
</td>
<?php endforeach ?>
</tr>
</table>
</div>
