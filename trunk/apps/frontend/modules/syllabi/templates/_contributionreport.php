<?php if($contribution==WpmoduleSyllabusItemPeer::FOCUSSED_CONTRIBUTION): ?>
  <abbr title="<?php echo __('focussed contribution') ?>">▣</abbr>&nbsp;<?php echo $subject ?><?php if($appointment->getTeamId()):?><abbr title="<?php echo __('this appointment is set only for some of the students') ?>">*</abbr><?php endif?>: <strong><?php echo $title ?></strong><br />
<?php endif ?>
<?php if($contribution==WpmoduleSyllabusItemPeer::PARTIAL_CONTRIBUTION): ?>
  <abbr title="<?php echo __('partial contribution') ?>">◪</abbr>&nbsp;<?php echo $subject ?><?php if($appointment->getTeamId()):?><abbr title="<?php echo __('this appointment is set only for some of the students') ?>">*</abbr><?php endif?>: <em><?php echo $title ?></em><br />
<?php endif ?>

