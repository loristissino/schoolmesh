<?php foreach($tools as $group): ?>
<h3><?php echo $group['description'] ?></h3>
	<?php if (@sizeof($group['elements'])>0): ?>
	<ul>
	<?php foreach($group['elements'] as $tool): ?>
		<li><?php echo $tool['description'] ?></li>
		<?php endforeach ?>
	</ul>
	<?php else: ?>
		<p><?php echo __('No choice done.') ?></p>
	<?php endif ?>
<?php endforeach ?>

