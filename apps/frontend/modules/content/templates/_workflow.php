<?php if ($wfevents): ?>
<ul>
	<?php foreach($wfevents as $event): ?>
		<li>
			<?php echo  $event->getCreatedAt() ?>: 
			<?php if ($event->getsfGuardUser()): ?>
      <strong><?php echo  $event->getSfGuardUser()->getProfile()->getFullName() 	?></strong><?php else: ?><span style="color: red"><?php echo __('No user specified') ?></span><?php endif ?>: 
			<?php echo  $event->getComment() ?>
		</li>
	<?php endforeach ?>
</ul>
<?php else: ?>
<p><?php echo __('No workflow logs available for this item.') ?>
<?php endif ?>