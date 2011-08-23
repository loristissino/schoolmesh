<?php use_helper('jQuery') ?>
<td>
<?php echo $syllabus_item->getRef() ?>
</td>
<?php foreach($workplan->getWpmodules() as $wpmodule): ?>
<td>
<?php if($syllabus_item->getIsSelectable()): ?>
  <?php $syllabus_contributions=$wpmodule->getSyllabusContributionsAsArray()->getRawValue() ?>
  <?php $link='▢'; if(array_key_exists($syllabus_item->getId(), $syllabus_contributions)) $link=$syllabus_contributions[$syllabus_item->getId()]==WpmoduleSyllabusItemPeer::PARTIAL_CONTRIBUTION ? '◪': '▣' ?>
  <?php echo jq_link_to_remote($link,
      array(
        'update' => 'syllabus_' . $syllabus_item->getId(),
        'url'      => url_for('wpmodule/syllabus?id=' . $wpmodule->getId() . '&syllabus=' . $syllabus_item->getId() . '&value=R&partial=workplanlinks'),
        'loading'=>'$(\'#loader_s'. $syllabus_item->getId() . '\').show();'),
          array(
          'title'=>__('Toggle module «%moduletitle%» contribution to this goal\'s achievement', array('%moduletitle%'=>$wpmodule->getTitle()))
            )
          ) ?>
<?php endif ?>
</td>
<?php endforeach ?>
<td>
<div style="margin-left: <?php echo ($syllabus_item->getLevel()-1)*10 ?>px;">
<?php if ($syllabus_item->getIsSelectable()): ?>
  <?php echo $syllabus_item->getContent()?>
  <?php echo image_tag('loader.gif', array('style'=>'vertical-align: middle; display: none', 'id'=>'loader_s'. $syllabus_item->getId())) ?>
<?php else: ?>
  <strong><?php echo $syllabus_item->getContent()?></strong>
<?php endif ?>
</div>
</td>
