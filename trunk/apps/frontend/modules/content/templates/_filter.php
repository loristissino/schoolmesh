<h3><?php echo __($title) ?></h3>
<?php if(($sf_user->getAttribute('filter')==$type)&&$sf_user->getAttribute('filter_id')>=0): ?>
<?php echo link_to(
	__($link_selectall),
	url_for( 'plansandreports/setfilterlistpreference?filter='. $type),
	array(
		'title'=>__($link_selectall_tooltip)
		)
	)
?>
<?php echo html_entity_decode($separator) ?>
<?php endif ?>
<?php $count=0 ?>
<?php foreach($items as $item): ?>
	<?php if(($sf_user->getAttribute('filter_id')!=$item->getId())): ?>
	<?php echo link_to(
		__($item->__toString()),
		url_for( 'plansandreports/setfilterlistpreference?filter=' . $type . '&id='.$item->getId()),
		array(
			'title'=>__('Show only these documents')
			)
		)
	?>
	<?php else: ?>
		<strong><?php echo __($item->__toString()) ?></strong>
	<?php endif ?>
	<?php if (++$count<sizeof($items)): ?>
		<?php echo html_entity_decode($separator) ?>
	<?php endif ?>
<?php endforeach ?>
