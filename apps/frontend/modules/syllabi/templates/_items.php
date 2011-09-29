<?php /*
<table>
<tr><th><?php echo __('Ref.')?></th><th><?php echo __('Item') ?></th></tr>
<?php foreach($syllabus->getSyllabusItems() as $syllabus_item): ?>
  <tr id="syllabus_<?php echo $syllabus_item->getId() ?>">
  <?php include_partial('syllabi/item', array('syllabus'=>$syllabus, 'syllabus_item'=>$syllabus_item)) ?>
  </tr>
<?php endforeach ?>
</table>
*/ ?>
<?php foreach($syllabus->getSyllabusItems() as $syllabus_item): ?>
  <p id="syllabus_<?php echo $syllabus_item->getRef() ?>">
    <?php echo str_repeat('&nbsp;', ($syllabus_item->getLevel()-1)*2) ?>
      <?php if($syllabus_item->getRef()): ?>
      <em><?php echo $syllabus_item->getRef() ?></em> - 
      <?php endif ?>
    <?php if(!$syllabus_item->getIsSelectable()): ?><strong><?php endif ?>
    <?php echo $syllabus_item->getContent() ?>
    <?php if(!$syllabus_item->getIsSelectable()): ?></strong><?php endif ?>
  </p>
<?php endforeach ?>
