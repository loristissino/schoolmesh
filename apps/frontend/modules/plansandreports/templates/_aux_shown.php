<?php foreach($tools as $group): ?>
<h3><?php echo $group['description'] ?></h3>
<?php $count=0; $chosen=''; ?>
	<?php foreach($group['elements'] as $tool_id=>$tool): ?>
		<?php if ($tool['chosen']): ?>
					<?php $chosen.='<li>'. $tool['description'] . '</li>' ?>
					<?php $count++ ?>
				<?php endif ?>
		<?php endforeach ?>
	<?php if ($count>0): ?>
		<ul><?php echo $chosen ?></ul>
	<?php else: ?>
		<p><?php echo __('No choice done.') ?></p>
	<?php endif ?>
<?php endforeach ?>

