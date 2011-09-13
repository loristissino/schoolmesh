<table>
<tr><th><?php echo __('Ref.') ?></th><th><?php echo __('Item') ?></th><th><?php echo __('Contribution') ?></th></tr>
<?php foreach($syllabus->getSyllabusItems() as $syllabus_item): ?>
  <tr id="syllabus_<?php echo $syllabus_item->getId() ?>">
  <?php include_partial('syllabi/link_table', array('syllabus'=>$syllabus, 'syllabus_item'=>$syllabus_item, 'syllabus_contributions'=>$syllabus_contributions, 'wpmodule'=>$wpmodule, 'syllabusview'=>$syllabusview)) ?>
  </tr>
<?php endforeach ?>
</table>