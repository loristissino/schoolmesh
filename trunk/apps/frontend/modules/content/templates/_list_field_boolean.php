<?php if ($value): ?>
  <?php echo image_tag('tick', array('alt' => __('True'), 'title' => __('True'))) ?>
<?php else: ?>
  <?php echo image_tag('notchecked', array('alt' => __('False'), 'title' => __('False'))) ?>
<?php endif; ?>
