<?php use_helper('jQuery') ?>
<?php $link='▢'; if(array_key_exists($syllabus_item->getId(), $syllabus_contributions->getRawValue())) $link=$syllabus_contributions[$syllabus_item->getId()]==WpmoduleSyllabusItemPeer::PARTIAL_CONTRIBUTION ? '◪': '▣' ?>
<?php if($syllabus_item->getLevel()<=$current_level): ?>
</li>
<?php endif ?>
<?php if($syllabus_item->getLevel()<$current_level): ?>
<?php echo str_repeat('</ul>', $current_level-$syllabus_item->getLevel()) ?>
<?php endif ?>
<?php if($syllabus_item->getLevel()>$current_level): ?>
<ul>
<?php endif ?>
<li id="syllabus_<?php echo $syllabus_item->getId() ?>">
<?php include_partial('syllabi/link', array('syllabus_item'=>$syllabus_item, 'wpmodule'=>$wpmodule, 'syllabusview'=>'tree', 'link'=>$link, 'showref'=>true)) ?>
