<?php use_helper('Javascript') ?>
<td width="20">&nbsp;</td>
<td><?php echo html_entity_decode($wpmodule_item->getContent()) ?></td>

<?php foreach ($students as $student): ?>
<td>
	<ul class="sf_admin_td_actions">
		<li class="sf_admin_action_<?php echo (false)? 'flag_red': 'flag_gray' ?>">
		<?php echo link_to_remote('', array(
					'update'   => 'ticks_' . $wpmodule_item->getId(),
					'url'      => url_for('schoolclasses/tickit?student=' . $student->getId() . '&item=' . $wpmodule_item->getId() . '&ids=' . $ids),
					'loading'=>'$(\'loader'.$student->getId() . '_' . $wpmodule_item->getId() . '\').show();'),
					array(
					'title'=>$student->getProfile()->getFullName()
					)
				) ?>
		<?php echo image_tag('loader.gif', array('style'=>'vertical-align: middle; display: none', 'id'=>'loader'.$student->getId() . '_' . $wpmodule_item->getId())) ?>
		</li>
	</ul>
</td>
<?php endforeach ?>
<td>
	<ul class="sf_admin_td_actions">
		<li class="sf_admin_action_<?php echo (true)? 'flag_red': 'reset' ?>">
		<?php echo link_to_remote('', array(
					'update'   =>'ticks_' . $wpmodule_item->getId(),
					'url'      => 'schoolclasses/tickit'),
					array(
					'title' => 'All selected students'
					)
				) ?>
		</li>
	</ul>
</td>
