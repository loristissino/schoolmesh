<?php if (sizeof($deadlines)>0): ?>

<h3><?php echo __('Deadlines') ?></h3>

<ol>
<?php foreach($deadlines as $deadline): ?>

	<li><?php echo $deadline->getDescription() ?></li>
	<ul>
		<li><?php echo __('Original deadline') ?>: <strong><?php echo Generic::datetime($deadline->getOriginalDeadlineDate('U'), $sf_context->getRawValue()) ?></strong></li>
		<?php if ($deadline->getCurrentDeadlineDate()!=$deadline->getOriginalDeadlineDate()): ?>
			<li><?php echo __('Current deadline') ?>: <strong><?php echo Generic::datetime($deadline->getCurrentDeadlineDate('U'), $sf_context->getRawValue()) ?></strong></li>
		<?php endif ?>
		<li><?php echo __('State') ?>: <span class="deadline_<?php echo Generic::slugify($deadline->getState())?>"><?php echo __($deadline->getState()) ?></span></li>
		<?php if ($deadline->getNotes()): ?>
			<li><?php echo __('Notes') ?>: «<?php echo $deadline->getNotes() ?>»</li>
		<?php endif ?>
		</li>
		
	</ul>

<?php endforeach ?>
</ol>
<?php else: ?>
<p><?php echo __('No deadline defined.') ?></p>
<?php endif ?>

