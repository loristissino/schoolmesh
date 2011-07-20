<?php use_helper('Javascript') ?>
<?php use_helper('jQuery') ?>
<?php $sits=$wpmodule_item->getStudentsSituationsAsArray($sf_user->getAttribute('ids')->getRawValue(), $term_id)->getRawValue() ?>
<td width="10">&nbsp;</td>
<td><?php echo html_entity_decode($wpmodule_item->getContent()) ?></td>

<td width="20"><?php echo image_tag('loader.gif', array('style'=>'vertical-align: middle; display: none', 'id'=>'loader'. $wpmodule_item->getId())) ?></td>
<?php $count=0 ?>
<?php foreach ($students as $student): ?>
<td>
		<?php $link='▢'; if(in_array($student->getId(), $sits)) {$link='▣'; $count++; } ?>
		<?php echo jq_link_to_remote(in_array($student->getId(), $sits)? '▣': '▢', array(
					'update'   => 'ticks_' . $wpmodule_item->getId(),
					'url'      => url_for('schoolclasses/tickit?student=' . $student->getId() . '&item=' . $wpmodule_item->getId()),
					'loading'=>'$(\'loader'. $wpmodule_item->getId() . '\').show();'),
					array(
					'title'=>$student->getProfile()->getFullName() . ' - ' . 
						(
						$link=='▣' ? 
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
		<?php
			switch ($count)
			{
				case(0): $link='▢'; break;
				case(sizeof($students)): $link='▣'; break;
				default: $link='▨';
			}
		?>
		<?php echo jq_link_to_remote($link, array(
					'update'   =>'ticks_' . $wpmodule_item->getId(),
					'url'      => url_for('schoolclasses/tickit?student=all&item=' . $wpmodule_item->getId() ),
					'loading'=>'$(\'loader'.$wpmodule_item->getId() . '\').show();'),
					array(
					'title' => __('Toggle selection for all students')
					)
				) ?>
		</li>
	</ul>
</td>
