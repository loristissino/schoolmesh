<?php if ($workplan->countWpmodules()): ?>
<?php $number=0 ?>
<?php foreach ($workplan->getWpmodules() as $wpmodule): ?>
<h3><?php echo sprintf(__('Module #%d:&nbsp;'), ++$number) ?><?php echo $wpmodule ?></h3>
<p><em><?php echo sprintf(__('Period: %s'), $wpmodule->getPeriod()) ?></em></p>
<div class="module_content">
	<?php foreach ($wpmodule->getWpitemGroups() as $wpitem_group): ?>
		<?php if($wpitem_group->countWpmoduleItems()): ?>

			<h4><?php echo $wpitem_group->getWpitemType()->getTitle() ?></h4>
				<?php if($wpitem_group->countWpmoduleItems()): ?>
					
					<ul>
						<?php foreach($wpitem_group->getWpmoduleItems() as $wpmodule_item): ?>
							<?php if ($is_owner || !$wpmodule_item->getIsEditable()): ?>
							<li>
							<?php echo html_entity_decode($wpmodule_item->getContent()) ?>
							<?php if ($state>=Workflow::IR_DRAFT): ?>
								<em><?php echo sprintf(__('(Evaluation: %d)'), $wpmodule_item->getEvaluation()) ?></em>
							<?php endif ?>
							</li>
							<?php endif ?>
						<?php endforeach ?>
					
					</ul>
					
				<?php endif ?>

		<?php endif ?>
	
	<?php endforeach; ?>
</div>

<?php endforeach; ?>

<?php endif; ?>