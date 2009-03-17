<?php if ($wpmodule->getWpmoduleItems()): ?>
<h2><?php echo __("Module Items"); ?></h2>


<?php $lastwptype=''; ?>
<?php $first = true ?>
<?php foreach($wpmodule->getWpmoduleItems() as $wpmoduleitem): ?>

	<?php if ($wpmoduleitem->getWpItemType()!=$lastwptype): ?>
	    <?php if (!$first): ?>
			</ol>
		<?php endif; ?>
		<h3><?php echo $wpmoduleitem->getWpItemType() ?></h3>
		<p><em><?php echo $wpmoduleitem->getWpItemType()->getDescription() ?></em></p>
		<ol>
		<?php $first=false ?>
	<?php endif; ?>
	<?php $lastwptype=$wpmoduleitem->getWpItemType(); ?>


	<li><?php echo $wpmoduleitem; ?>
	&nbsp;<a href="<?php echo url_for('wpmoduleitem/show?id='.$wpmoduleitem->getId()) ?>">Edit</a>
	&nbsp;<a href="<?php echo url_for('wpmoduleitem/show?id='.$wpmoduleitem->getId()) ?>">Move Up</a>
	&nbsp;<a href="<?php echo url_for('wpmoduleitem/show?id='.$wpmoduleitem->getId()) ?>">Move Down</a>	
	</li>

<?php endforeach; ?>

</ol>

<?php endif; ?>

