<?php if($activity->getacknowledgedAt()): ?>
  <?php echo image_tag('done', 'title=' . __('This activity has been acknoweledged')). ' ' ?><?php echo $activity->getAcknowledgedAt('d/m/Y') ?>
<?php else: ?>
  <?php echo image_tag('notdone', 'title=' . __('This activity has not been yet acknoweledged')). ' ' ?><?php echo __('Not yet acknowledged') ?>
<?php endif ?>
