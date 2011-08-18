<?php if($contribution==WpmoduleSyllabusItemPeer::FOCUSSED_CONTRIBUTION): ?>
  ▣&nbsp;<?php echo $subject ?>: <strong><?php echo $title ?></strong><br />
<?php endif ?>
<?php if($contribution==WpmoduleSyllabusItemPeer::PARTIAL_CONTRIBUTION): ?>
  ◪&nbsp;<?php echo $subject ?>: <em><?php echo $title ?></em><br />
<?php endif ?>

