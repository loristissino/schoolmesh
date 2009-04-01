<?php if ($workplan->countWpmodules()): ?>

<?php foreach ($workplan->getWpmodules() as $wpmodule): ?>
<h3><?php echo $wpmodule ?></h3>
<p><em><?php echo $wpmodule->getPeriod() ?></em></p>
	<?php foreach ($wpmodule->getWpitemGroups() as $wpitem_group): ?>
		<?php if($wpitem_group->countWpmoduleItems()): ?>

			<h4><?php echo $wpitem_group->getWpitemType()->getTitle() ?></h4>
				<?php if($wpitem_group->countWpmoduleItems()): ?>
					
					<ul>
						<?php foreach($wpitem_group->getWpmoduleItems() as $wpmodule_item): ?>
							<li><?php echo html_entity_decode($wpmodule_item->getContent()) ?></li>
						<?php endforeach ?>
					
					</ul>
					
				<?php endif ?>

		<?php endif ?>
	
	<?php endforeach; ?>


<?php endforeach; ?>

<?php endif; ?>