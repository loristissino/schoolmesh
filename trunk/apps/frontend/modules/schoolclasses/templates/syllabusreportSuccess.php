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

<table>
<tr>
<th><?php echo __('Ref.') ?></th><th><?php echo __('Item') ?></th>
<th>
<?php echo __('Notes') ?>
</th>
</tr>
<?php foreach($syllabus_items->getRawValue() as $syllabus_item): $p=0; $f=0 ?>
<tr>
<td>
<?php echo $syllabus_item->getRef() ?>
</td>
<td>
<?php include_partial('syllabi/itemdiv', array('syllabus_item'=>$syllabus_item)) ?>
<div style="margin-left: <?php echo ($syllabus_item->getLevel()-1)*10 +10 ?>px;">
<?php foreach($appointments as $appointment): ?>
  <?php if(array_key_exists($syllabus_item->getId(), $contributions) && array_key_exists($appointment->getId(), $contributions[$syllabus_item->getId()])): ?>
    <?php foreach($contributions[$syllabus_item->getId()][$appointment->getId()] as $contribution): ?>
      <?php if($contribution['contribution']==WpmoduleSyllabusItemPeer::PARTIAL_CONTRIBUTION) $p+=1; else $f+=1 ?>
      <?php include_partial('syllabi/contributionreport', array(
        'subject'=>$contribution['subject'],
        'title' =>$contribution['title'],
        'contribution'=>$contribution['contribution'],
        'appointment'=>$appointment,
        ))
      ?>
    <?php endforeach ?>
  <?php endif ?>
<?php endforeach ?>
</div>
</td>
<td>
<?php if($syllabus_item->getIsSelectable()): ?>
<?php include_partial('syllabi/warnings', array('partial'=>$p, 'focussed'=>$f)) ?>
<?php endif ?>
</td>
<?php endforeach ?>
</tr>

</table>

<h2><?php echo __('Legend') ?></h2>
<p>
<strong>▣</strong>: <?php echo __('focussed contribution') ?><br />
<strong>◪</strong>: <?php echo __('partial contribution') ?><br />
<strong>*</strong>: <?php echo __('this appointment is set only for some of the students') ?><br />
</p>

<h2><?php echo __('Actions') ?></h2>
<ul class="sf_admin_actions">
<li class="sf_admin_action_report"><?php echo link_to(
  __('View as table'),
  'schoolclasses/syllabus?id=' . $appointment->getId()
  )
?></li><br />
<?php echo export_action_links($sf_user, 'schoolclasses/exportsyllabus?id=' . $appointment->getId(), $sf_context) ?>
</ul>
