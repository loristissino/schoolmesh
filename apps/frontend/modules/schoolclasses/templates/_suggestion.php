<?php use_helper('Javascript') ?>
<?php $s=$suggestion->getStudentIdsForAppointmentAndTerm($appointment_id, $term_id)->getRawValue() ?>
<td><?php echo $suggestion->getContent() ?></td>

<td width="20"><?php echo image_tag('loader.gif', array('style'=>'vertical-align: middle; display: none', 'id'=>'loader_s'. $suggestion->getId())) ?></td>
<?php foreach ($students as $student): ?>
<td>
		<?php echo link_to_remote(in_array($student->getId(), $s)? '▣': '▢', array(
					'update'   => 'suggestion_' . $suggestion->getId(),
					'url'      => url_for('schoolclasses/suggestion?student=' . $student->getId() . '&suggestion=' . $suggestion->getId() .'&appointment=' . $appointment_id .  '&ids=' . $ids),
					'loading'=>'$(\'loader_s'. $suggestion->getId() . '\').show();'),
					array(
					'title'=>$student->getProfile()->getFullName() . ' - ' . 
						(
						in_array($student->getId(), $s)? 
							format_number_choice(__('[0]currently selected|[1]currently selected'), null, $student->getProfile()->getIsMale())
							:
							format_number_choice(__('[0]currently not selected|[1]currently not selected'), null, $student->getProfile()->getIsMale())
						)
					)
				) ?>
		</li>
	</ul>
</td>
<?php endforeach ?>
<td>
	<ul class="sf_admin_td_actions">
		<li class="sf_admin_action_grouptoggle">
		<?php echo link_to_remote('', array(
					'update'   =>'suggestion_' . $suggestion->getId(),
					'url'      => url_for('schoolclasses/suggestion?student=all&suggestion=' . $suggestion->getId() . '&appointment=' . $appointment_id . '&ids=' . $ids),
					'loading'=>'$(\'loader_s'.$suggestion->getId() . '\').show();'),
					array(
					'title' => __('All selected students')
					)
				) ?>
		</li>
	</ul>
</td>
