<?php use_helper('jQuery') ?>
<?php $link='▢'; if(array_key_exists($syllabus_item->getId(), $syllabus_contributions->getRawValue())) $link=$syllabus_contributions[$syllabus_item->getId()]==WpmoduleSyllabusItemPeer::PARTIAL_CONTRIBUTION ? '◪': '▣' ?>
<td>
<?php echo $syllabus_item->getRef() ?>
</td>
<td>
<div style="margin-left: <?php echo ($syllabus_item->getLevel()-1)*20 ?>px;">
<?php include_partial('syllabi/link', array('syllabus_item'=>$syllabus_item, 'wpmodule'=>$wpmodule, 'syllabusview'=>'table', 'link'=>$link, 'showref'=>false)) ?>
</div>
</td>
<td>
  <span style="color: #72aff6">
  <?php if ($syllabus_item->getIsSelectable()): ?>
    <?php if($link=='▢'): ?>
      <?php echo $link ?>
    <?php else: ?>
      <?php echo jq_link_to_remote('▢',
         array(
            'update'   => 'syllabus_' . $syllabus_item->getId(),
            'url'      => url_for('wpmodule/syllabus?id=' . $wpmodule->getId() . '&syllabus=' . $syllabus_item->getId() . '&value=0&partial=table'),
            'loading'=>'$(\'#loader_s'. $syllabus_item->getId() . '\').show();'),
            array(
            'title'=>__('Unset current module contribution to this goal\'s achievement')
              )
            ) ?>
    <?php endif ?>
    <?php if($link=='◪'): ?>
      <?php echo $link ?>
    <?php else: ?>
      <?php echo jq_link_to_remote('◪',
         array(
            'update'   => 'syllabus_' . $syllabus_item->getId(),
            'url'      => url_for('wpmodule/syllabus?id=' . $wpmodule->getId() . '&syllabus=' . $syllabus_item->getId() . '&value='. WpmoduleSyllabusItemPeer::PARTIAL_CONTRIBUTION . '&partial=table'),
            'loading'=>'$(\'#loader_s'. $syllabus_item->getId() . '\').show();'),
            array(
            'title'=>__('Set current module partial contribution to this goal\'s achievement')
              )
            ) ?>
    <?php endif ?>
    <?php if($link=='▣'): ?>
      <?php echo $link ?>
    <?php else: ?>
      <?php echo jq_link_to_remote('▣',
         array(
            'update'   => 'syllabus_' . $syllabus_item->getId(),
            'url'      => url_for('wpmodule/syllabus?id=' . $wpmodule->getId() . '&syllabus=' . $syllabus_item->getId() . '&value='. WpmoduleSyllabusItemPeer::FOCUSSED_CONTRIBUTION . '&partial=table'),
            'loading'=>'$(\'#loader_s'. $syllabus_item->getId() . '\').show();'),
            array(
            'title'=>__('Set current module focussed contribution to this goal\'s achievement')
              )
            ) ?>
    <?php endif ?>
    <?php echo image_tag('loader.gif', array('style'=>'vertical-align: middle; display: none', 'id'=>'loader_s'. $syllabus_item->getId())) ?>
  <?php endif ?>
  </span>
</td>