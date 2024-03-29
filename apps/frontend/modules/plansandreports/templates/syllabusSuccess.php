<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    '@plansandreports' => "Plans and Reports",
    'plansandreports/fill?id='.$workplan->getId() => $workplan
    ),
  'current'=>__('Syllabus view'),
  'title'=>$workplan,
  ))
?>    

<table>
<tr>
<th><?php echo __('Ref.') ?></th>
<?php foreach($wpmodules as $wpmodule): ?>
	<th width="10"><?php echo link_to(
    image_tag('vertical.php?text='. urlencode($wpmodule->getTitle()) .
    '&backcolor=255-255-255&textcolor=0-0-0&ywidth=250',
        array(
          'alt' => $wpmodule->getTitle(),
          'title' => $wpmodule->getTitle(),
          'size' => '20x250')
          ),
        'wpmodule/view?id=' . $wpmodule->getId()
        )
			?></th>
<?php endforeach ?>
	<th width="10"><?php echo image_tag('vertical.php?text='. __('All modules') .
	'&backcolor=0-0-0&textcolor=255-255-63&ywidth=250',
			array(
				'alt' => __('All modules'),
				'title' => __('All modules of this workplan'),
        'size' => '20x250')
				)
			?></th>
<th><?php echo __('Item') ?></th>
<?php if($workplan->getState()==Workflow::IR_DRAFT): ?>
  <th style="width:200px"><?php include_partial('content/evaluation_th_description', array(
        'min_value'=>$workplan->getSyllabus()->getEvaluationMin(),
        'min_description'=>$workplan->getSyllabus()->getEvaluationMinDescription(),
        'max_value'=>$workplan->getSyllabus()->getEvaluationMax(),
        'max_description'=>$workplan->getSyllabus()->getEvaluationMaxDescription(),
        )) ?></th>
<?php endif ?>
</tr>
<?php foreach($syllabus->getSyllabusItems() as $syllabus_item): ?>
  <?php $wpsi=$syllabus_item->getEvaluatableForAppointment($workplan->getId()) ?>
  <?php if($workplan->getState()==Workflow::WP_DRAFT or !$syllabus_item->getIsSelectable() or ($wpsi and $wpsi->getEvaluation()!=-1)): ?>
    <tr id="syllabus_<?php echo $syllabus_item->getId() ?>">
    <?php include_partial('syllabi/workplanlinks', array('syllabus'=>$syllabus, 'workplan'=>$workplan, 'syllabus_item'=>$syllabus_item, 'wpmodules'=>$wpmodules, 'syllabus_contributions_cache'=>$syllabus_contributions, 'wpsi'=>$wpsi)) ?>
    </tr>
  <?php endif ?>
<?php endforeach ?>

</table>
