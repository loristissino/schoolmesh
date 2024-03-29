<?php $contributions=$contributions->getRawValue() ?>
<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'schoolclasses/index' => "Classes",
    '_schoolclasses' => $schoolclass->getId()
    ),
  'current'=>__('Syllabus view'),
  'title'=>$schoolclass->getId() . ': '. __('Syllabus view')
  ))
?>    

<?php include_partial('content/flashes'); ?>

<table>
<tr>
<th><?php echo __('Ref.') ?></th><th><?php echo __('Item') ?></th>
<?php foreach($appointments as $appointment): $backcolor=$appointment->getTeamId()?'255-255-191':'255-255-255' ?>
	<th width="10"><?php echo image_tag('vertical.php?text='. urlencode($appointment->getSubject()->getDescription()) .
	'&backcolor='.$backcolor.'&textcolor=0-0-0&ywidth=250',
			array(
				'alt' => $appointment->getSubject()->getDescription(),
				'title' => $appointment->getSubject()->getDescription() . ($appointment->getTeamId()? sprintf(' (%s)', __('this appointment is set only for some of the students')): '') . ' - ' . $appointment->getTeacherNameWithTitle(),
        'size' => '20x250')
				)
			?></th>
<?php endforeach ?>
<th>
<?php echo __('Notes') ?>
</th>
</tr>
<?php foreach($syllabus_items->getRawValue() as $syllabus_item): $p=0; $f=0 ?>
<tr>
<?php include_partial('syllabi/item', array('syllabus_item'=>$syllabus_item)) ?>
<?php foreach($appointments as $appointment): ?>
	<td<?php if($appointment->getTeamId()) echo ' style="background-color: #FFFFBF"' ?>>
  <?php if(array_key_exists($syllabus_item->getId(), $contributions) && array_key_exists($appointment->getId(), $contributions[$syllabus_item->getId()])): ?>
    <?php foreach($contributions[$syllabus_item->getId()][$appointment->getId()] as $contribution): ?>
      <?php if($contribution['contribution']==WpmoduleSyllabusItemPeer::PARTIAL_CONTRIBUTION) $p+=1; else $f+=1 ?>
      <?php include_partial('syllabi/contribution', array('contribution'=>$contribution, 'appointment'=>$appointment)) ?>
    <?php endforeach ?>
  <?php endif ?>
  </td>
<?php endforeach ?>
<td>
<?php if($syllabus_item->getIsSelectable()): ?>
<?php include_partial('syllabi/warnings', array('partial'=>$p, 'focussed'=>$f)) ?>
<?php endif ?>
</td>
<?php endforeach ?>
</tr>

</table>

<h2><?php echo __('Actions') ?></h2>
<ul class="sf_admin_actions">
<li class="sf_admin_action_report"><?php echo link_to(
  __('View as report'),
  'schoolclasses/syllabus?id=' . $appointment->getId() . '&template=syllabusreport'
  )
?></li><br />
<?php echo export_action_links($sf_user, 'schoolclasses/exportsyllabus?id=' . $appointment->getId(), $sf_context) ?>
</ul>
