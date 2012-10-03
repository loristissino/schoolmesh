<?php if ($wpmodule->getWpmoduleItems()): ?>
<h2><?php echo __("Module Items"); ?></h2>


<?php $lastwptype=''; ?>
<?php $first = true ?>
<?php foreach($wpmodule->getWpmoduleItems() as $wpmoduleitem): ?>

	<?php if ($wpmoduleitem->getWpItemType()!=$lastwptype): ?>
	
	    <?php if (!$first): ?>
			</ol>
			<p>New</p>

		<?php endif; ?>
		<h3><?php echo $wpmoduleitem->getWpItemType() ?></h3>
		<p><em><?php echo $wpmoduleitem->getWpItemType()->getDescription() ?></em></p>
		<ol>
		<?php $first=false ?>
	<?php endif; ?>
	<?php $lastwptype=$wpmoduleitem->getWpItemType(); ?>


	<li><?php echo $wpmoduleitem; ?>
	&nbsp;<a href="<?php echo url_for('wpmoduleitem/show?id='.$wpmoduleitem->getId()) ?>">Edit</a>

	<?php if ($wpmoduleitem->getRank()>1): ?>
		&nbsp;<a href="<?php echo url_for('wpmoduleitem/show?id='.$wpmoduleitem->getId()) ?>">Move Up</a>
	<?php endif; ?>
	
	<?php if ($wpmoduleitem->getRank()<$wpmoduleitem->getMaxRank()): ?>
		&nbsp;<a href="<?php echo url_for('wpmoduleitem/show?id='.$wpmoduleitem->getId()) ?>">Move Down</a>
	<?php endif; ?>
	<?php /*
		<ul>
			<li>docente: <?php echo $wpmoduleitem->getWpmodule()->getSfGuardUser() ?></li>
			<li>piano di lavoro: <?php echo $wpmoduleitem->getWpmoduleId() ?></li>
			<li>item type: <?php echo $wpmoduleitem->getWpitemTypeId() ?></li>
			<li>current rank: <?php echo $wpmoduleitem->getRank() ?></li>
			<li>max rank here: <?php echo $wpmoduleitem->getMaxRank() ?></li>
		</ul>
	*/ ?>
	</li>
	

<?php endforeach; ?>

</ol>
	<p>New</p>

<?php endif; ?>

