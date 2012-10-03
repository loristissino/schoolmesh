<?php $description=$with_description? sprintf(' » %s', $deadline->getDescription()): '' ?>
<?php switch($deadline->getState()):
  case 'completed': ?>
    <?php echo image_tag('done', array('title'=>__('Task completed'). $description)) ?>
    <?php break ?>
  <?php case 'overdue': ?>
    <?php echo image_tag('notdone', array('title'=>__('Overdue'). $description)) ?>
    <?php break ?>
  <?php case 'not yet over': ?>
    <?php echo image_tag('calendar', array('title'=>__('Not yet over'). $description)) ?>
    <?php break ?>
<?php endswitch ?>
