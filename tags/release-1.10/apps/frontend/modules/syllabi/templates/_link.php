<?php use_helper('jQuery') ?>
<?php if ($syllabus_item->getIsSelectable()): ?>
  <?php echo jq_link_to_remote($link,
    array(
      'update' => 'syllabus_' . $syllabus_item->getId(),
            'url'      => url_for('wpmodule/syllabus?id=' . $wpmodule->getId() . '&syllabus=' . $syllabus_item->getId() . '&value=R&partial='.$syllabusview),
            'loading'=>'$(\'#loader_s'. $syllabus_item->getId() . '\').show();'),
            array(
            'title'=>__('Toggle current module contribution to this goal\'s achievement')
              )
            ) ?>
  <?php echo $syllabus_item->getContent() ?>
<?php else: ?>
  <strong><?php echo $syllabus_item->getContent()?></strong>
<?php endif ?>
<?php if($showref):?>
<?php if($syllabus_item->getRef()): ?>
<em> (<?php echo $syllabus_item->getRef() ?>)</em>
<?php echo image_tag('loader.gif', array('style'=>'vertical-align: middle; display: none', 'id'=>'loader_s'. $syllabus_item->getId())) ?>
<?php endif ?>
<?php endif ?>