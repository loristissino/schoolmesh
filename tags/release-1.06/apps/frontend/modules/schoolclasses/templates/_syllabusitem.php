<?php use_helper('jQuery') ?>
<?php use_helper('Schoolmesh') ?>

<?php $s=$syllabusitem->getStudentIdsForAppointmentAndTerm($appointment_id, $term_id)->getRawValue() ?>
<td>

<span id="syllabusitemtext_<?php echo $syllabusitem->getId()?>"><?php echo $syllabusitem->getContent() ?> (<em><?php echo $syllabusitem->getRef() ?></em>)</span>
</td>

<td width="20"><?php echo image_tag('loader.gif', array('style'=>'vertical-align: middle; display: none', 'id'=>'loader_i'. $syllabusitem->getId())) ?></td>
<?php $count=0 ?>
<?php foreach ($students as $student): ?>
<td>
		<?php $link='▢'; if(in_array($student->getUserId(), $s)) {$link='▣'; $count++; } ?>
		<?php echo jq_link_to_remote(in_array($student->getUserId(), $s)? '▣': '▢', array(
					'update'   => 'syllabusitem_' . $syllabusitem->getId(),
					'url'      => url_for('schoolclasses/syllabusitem?student=' . $student->getUserId() . '&syllabusitem=' . $syllabusitem->getId() .'&appointment=' . $appointment_id),
					'loading'=>'$(\'loader_i'. $syllabusitem->getId() . '\').show();'),
					array(
					'title'=>$student->getFullName() . ' - ' . 
						(
						in_array($student->getId(), $s)? 
							format_number_choice(__('[0]currently selected|[1]currently selected'), null, $student->getIsMale())
							:
							format_number_choice(__('[0]currently not selected|[1]currently not selected'), null, $student->getIsMale())
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
		<?php
			switch ($count)
			{
				case(0): $link='▢'; break;
				case(sizeof($students)): $link='▣'; break;
				default: $link='▨';
			}
		?>
		<?php echo jq_link_to_remote($link, array(
					'update'   =>'syllabusitem_' . $syllabusitem->getId(),
					'url'      => url_for('schoolclasses/syllabusitem?student=all&syllabusitem=' . $syllabusitem->getId() . '&appointment=' . $appointment_id),
					'loading'=>'$(\'loader_h'.$syllabusitem->getId() . '\').show();'),
					array(
					'title' => __('Toggle selection for all students')
					)
				) ?>
		</li>
	</ul>
</td>
