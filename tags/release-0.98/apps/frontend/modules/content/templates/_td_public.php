  <td>
	  <?php if ($object->getIsPublic()): ?>
		<?php echo image_tag('public', 'title=' . __('public')) ?>
	  <?php else: ?>
		<?php if (is_null($owner) || $owner->getIsMale()): ?>
			<?php echo image_tag('male', 'title=' . __('private')) ?>
		<?php else: ?>
			<?php echo image_tag('female', 'title=' . __('private')) ?>
		<?php endif ?>
	  <?php endif ?>
	</td>
