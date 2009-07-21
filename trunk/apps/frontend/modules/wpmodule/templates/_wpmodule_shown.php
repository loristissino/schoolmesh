<div class="module_content">
	<?php foreach ($wpmodule->getWpitemGroups() as $wpitem_group): ?>
		<?php if($wpitem_group->countWpmoduleItems()): ?>

			<h4><?php echo $wpitem_group->getWpitemType()->getTitle() ?></h4>
				<?php if($wpitem_group->countWpmoduleItems()): ?>
					
					<ul>
						<?php foreach($wpitem_group->getWpmoduleItems() as $wpmodule_item): ?>
							<?php /* if (!$wpmodule_item->getIsEditable()): */?>
							<li>
							<?php echo html_entity_decode($wpmodule_item->getContent()) ?>
							<?php if (($state>=Workflow::IR_DRAFT) && $wpmodule_item->getEvaluation()>0): ?>
								<em><?php echo sprintf(__('(Evaluation: %d)'), $wpmodule_item->getEvaluation()) ?></em>
							<?php endif ?>
							</li>
							<?php /* endif */ ?>
						<?php endforeach ?>
					</ul>
				<?php endif /* modules present*/ ?>
		<?php endif ?>
	<?php endforeach; ?>
</div>
