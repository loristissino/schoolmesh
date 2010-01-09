<?php use_helper('Javascript') ?>
<?php $sits=$wpmodule_item->getStudentsSituationsAsArray(Generic::b64_unserialize($ids), $term_id)->getRawValue() ?>
<td width="10">&nbsp;</td>
<td><?php echo html_entity_decode($wpmodule_item->getContent()) ?></td>

<td width="20"><?php echo image_tag('loader.gif', array('style'=>'vertical-align: middle; display: none', 'id'=>'loader'. $wpmodule_item->getId())) ?></td>
<?php foreach ($students as $student): ?>
<td>
		<?php echo link_to_remote(in_array($student->getId(), $sits)? '▣': '▢', array(
					'update'   => 'ticks_' . $wpmodule_item->getId(),
					'url'      => url_for('schoolclasses/tickit?student=' . $student->getId() . '&item=' . $wpmodule_item->getId() . '&ids=' . $ids),
					'loading'=>'$(\'loader'. $wpmodule_item->getId() . '\').show();'),
					array(
					'title'=>$student->getProfile()->getFullName() . ' - ' . 
						(
						in_array($student->getId(), $sits)? 
							format_number_choice(__('[0]currently selected|[1]currently selected'), null, $student->getProfile()->getIsMale())
							:
							format_number_choice(__('[0]currently not selected|[1]currently not selected'), null, $student->getProfile()->getIsMale())
						)
					)
				) ?>
</td>
<?php endforeach ?>
<td>
	<ul class="sf_admin_td_actions">
		<li class="sf_admin_action_grouptoggle">
		<?php echo link_to_remote('', array(
					'update'   =>'ticks_' . $wpmodule_item->getId(),
					'url'      => url_for('schoolclasses/tickit?student=all&item=' . $wpmodule_item->getId() . '&ids=' . $ids),
					'loading'=>'$(\'loader'.$wpmodule_item->getId() . '\').show();'),
					array(
					'title' => __('All selected students')
					)
				) ?>
		</li>
	</ul>
</td>
