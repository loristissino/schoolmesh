<?php use_helper('Javascript') ?>
<?php use_helper('jQuery') ?>
<?php use_helper('Schoolmesh') ?>

<?php $s=$hint->getStudentIdsForAppointmentAndTerm($appointment_id, $term_id)->getRawValue() ?>
<td>

<span id="hinttext_<?php echo $hint->getId()?>" class="editText"><?php echo $hint->getContent()  ?></span>

<?php if($hint->getIsEditable()): ?>
	<?php echo inputinplaceeditortag('#hinttext_'.$hint->getId(), url_for('schoolclasses/editHintInLine?property=Content&id='.$hint->getId()), array('tooltip'=>__('Click here to edit the text'), 'hover'=>'yellow')) ?>
<?php endif ?>

</td>

<td width="20"><?php echo image_tag('loader.gif', array('style'=>'vertical-align: middle; display: none', 'id'=>'loader_h'. $hint->getId())) ?></td>
<?php $count=0 ?>
<?php foreach ($students as $student): ?>
<td>
		<?php $link='▢'; if(in_array($student->getId(), $s)) {$link='▣'; $count++; } ?>
		<?php echo jq_link_to_remote(in_array($student->getId(), $s)? '▣': '▢', array(
					'update'   => 'hint_' . $hint->getId(),
					'url'      => url_for('schoolclasses/hint?student=' . $student->getId() . '&hint=' . $hint->getId() .'&appointment=' . $appointment_id),
					'loading'=>'$(\'loader_h'. $hint->getId() . '\').show();'),
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
		<?php
			switch ($count)
			{
				case(0): $link='▢'; break;
				case(sizeof($students)): $link='▣'; break;
				default: $link='▨';
			}
		?>
		<?php echo jq_link_to_remote($link, array(
					'update'   =>'hint_' . $hint->getId(),
					'url'      => url_for('schoolclasses/hint?student=all&hint=' . $hint->getId() . '&appointment=' . $appointment_id),
					'loading'=>'$(\'loader_h'.$hint->getId() . '\').show();'),
					array(
					'title' => __('Toggle selection for all students')
					)
				) ?>
		</li>
	</ul>
</td>
