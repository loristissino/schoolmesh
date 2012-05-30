<?php if($Role->getMin() and $number<$Role->getMin()): ?>
  <?php include_partial('content/dubious', array('text'=>__('Minimun number of assignees unreached'))) ?>
<?php endif ?>
<?php if($Role->getMax() and $number>$Role->getMax()): ?>
  <?php include_partial('content/dubious', array('text'=>__('Maximum number of assignees exceeded'))) ?>
<?php endif ?>
