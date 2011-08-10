<table>
<tr><th><?php echo __('Ref.')?></th><th><?php echo __('Item') ?></th></tr>
<?php foreach($syllabus->getSyllabusItems() as $syllabus_item): ?>
  <tr id="syllabus_<?php echo $syllabus_item->getId() ?>">
  <?php include_partial('syllabi/item', array('syllabus'=>$syllabus, 'syllabus_item'=>$syllabus_item)) ?>
  </tr>
<?php endforeach ?>
</table>