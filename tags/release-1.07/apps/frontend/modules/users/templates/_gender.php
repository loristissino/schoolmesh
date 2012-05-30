<?php if ($gender=='M'): ?>
	<?php echo image_tag('male', 'title=' . __('male')) ?>
<?php elseif($gender=='F'): ?>
	<?php echo image_tag('female', 'title=' . __('female')) ?>
<?php else: ?>
	<?php echo image_tag('notdone', 'title=' . __('not defined')) ?>
<?php endif ?>
