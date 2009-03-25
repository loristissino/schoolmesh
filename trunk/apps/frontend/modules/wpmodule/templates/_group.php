<h3><?php echo $item_group->getWpitemType()->getTitle() ?></h3>
<p><em><?php echo $item_group->getWpitemType()->getDescription() ?></em></p>

<ul>
<?php foreach($item_group->getWpmoduleItems() as $wpmodule_item): ?>
	<li>
	<span id="moduleitem_<?php echo $wpmodule_item->getId()?>" class="editText"><?php echo $wpmodule_item->getContent() ?></span>
	<?php echo input_in_place_editor_tag('moduleitem_'.$wpmodule_item->getId(), 'wpmoduleitem/editInLine?property=Content&id='.$wpmodule_item->getId(), array('cols'=>'50', 'rows'=>1)) ?>
	&nbsp;<?php echo link_to(__('rich text edit'), 'wpmoduleitem/edit?id='.$wpmodule_item->getId()) ?></li>
<?php endforeach ?>
</ul>

<a href="new">new...</a>

<!--

todo: 

   rich text edit
   up / down
   new
   delete

	multiline
	
-->   
