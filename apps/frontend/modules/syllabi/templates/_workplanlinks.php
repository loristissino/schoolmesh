<?php use_helper('jQuery') ?>
<td>
<?php echo $syllabus_item->getRef() ?>
</td>
<?php $ids=array(); foreach($wpmodules as $wpmodule): $ids[]=$wpmodule->getId() ?>
<td>
<?php if($syllabus_item->getIsSelectable()): ?>
  <?php $syllabus_contributions=$syllabus_contributions_cache[$wpmodule->getId()]->getRawValue() ?>
  <?php $link='▢'; if(array_key_exists($syllabus_item->getId(), $syllabus_contributions)) $link=$syllabus_contributions[$syllabus_item->getId()]==WpmoduleSyllabusItemPeer::PARTIAL_CONTRIBUTION ? '◪': '▣' ?>
  <?php if($workplan->getState()==Workflow::WP_DRAFT): ?>
  <?php echo jq_link_to_remote($link,
      array(
        'update' => 'syllabus_' . $syllabus_item->getId(),
        'url'      => url_for('wpmodule/syllabus?id=' . $wpmodule->getId() . '&syllabus=' . $syllabus_item->getId() . '&value=R&partial=workplanlinks'),
        'loading'=>'$(\'#loader_s'. $syllabus_item->getId() . '\').show();'),
          array(
          'title'=>__('Toggle module «%moduletitle%» contribution to this goal\'s achievement', array('%moduletitle%'=>$wpmodule->getTitle()))
            )
          ) ?>
  <?php else: ?>
    <?php echo $link ?>
  <?php endif ?>
<?php endif ?>
</td>
<?php endforeach ?>
<td>
<?php if($syllabus_item->getIsSelectable() and $workplan->getState()==Workflow::WP_DRAFT): ?>
  <?php echo jq_link_to_remote('◌',
      array(
        'update' => 'syllabus_' . $syllabus_item->getId(),
        'url'      => url_for('wpmodule/syllabus?ids=' . Generic::b64_serialize($ids) . '&syllabus=' . $syllabus_item->getId() . '&value=R&partial=workplanlinks'),
        'loading'=>'$(\'#loader_s'. $syllabus_item->getId() . '\').show();'),
          array(
          'title'=>__('Change all modules contribution to this goal\'s achievement', array('%moduletitle%'=>$wpmodule->getTitle()))
            )
          ) ?>
<?php endif ?>
</td>
<td>
<div style="margin-left: <?php echo ($syllabus_item->getLevel()-1)*10 ?>px;">
<?php if ($syllabus_item->getIsSelectable()): ?>
  <?php echo $syllabus_item->getContent()?>
  <?php echo image_tag('loader.gif', array('style'=>'vertical-align: middle; display: none', 'id'=>'loader_s'. $syllabus_item->getId())) ?>
<?php else: ?>
  <strong><?php echo $syllabus_item->getContent()?></strong>
<?php endif ?>
<?php if($workplan->getState()==Workflow::IR_DRAFT): ?>
  <td>
    <?php if($syllabus_item->getIsSelectable()): ?>
      <?php $id=$syllabus_item->getFirstValidId($ids) ?>
      <?php include_partial('syllabi/evaluation', array(
			'id'=>$id,
			'dbvalue'=>$syllabus_item->getEvaluationForItem($id),  
			'textvalue'=>'',//$syllabus_item->getEvaluationForItem($id),
			'min'=>1, //$item_group->getWpitemType()->getEvaluationMin(), 
			'max'=>4, //$item_group->getWpitemType()->getEvaluationMax())
      )) ?>
    <?php endif ?>
  </td>
<?php endif ?>
</div>
</td>
