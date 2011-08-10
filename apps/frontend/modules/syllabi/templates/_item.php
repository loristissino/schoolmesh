<td>
<?php echo $syllabus_item->getRef() ?>
</td>
<td>
<div style="margin-left: <?php echo ($syllabus_item->getLevel()-1)*10 ?>px;">
<?php if ($syllabus_item->getIsSelectable()): ?>
  <?php echo $syllabus_item->getContent() ?>
<?php else: ?>
  <strong><?php echo $syllabus_item->getContent()?></strong>
<?php endif ?>
</div>
</td>
