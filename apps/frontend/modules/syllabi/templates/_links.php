<table>
<tr><th><?php echo __('Contribution') ?></th><th><?php echo __('Item') ?></th></tr>
<?php foreach($syllabus->getSyllabusItems() as $syllabus_item): ?>
<tr>
<td>
  <?php if ($syllabus_item->getIsSelectable()): ?>
    <?php echo '[*]' ?>
  <?php endif ?>
</td>
<td>
<div style="margin-left: <?php echo $syllabus_item->getLevel()*10 ?>px;">
<?php if ($syllabus_item->getIsSelectable()): ?>
  <?php echo $syllabus_item->getContent() . "\n" ?>
<?php else: ?>
  <strong><?php echo $syllabus_item->getContent() . "\n" ?></strong>
<?php endif ?>
</div>
</td>
</tr>
<?php endforeach ?>
</table>