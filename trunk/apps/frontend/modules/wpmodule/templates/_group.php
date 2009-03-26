<h3><?php echo $item_group->getWpitemType()->getTitle() ?></h3>
<p><em><?php echo $item_group->getWpitemType()->getDescription() ?></em></p>


<?php $i=0 ?>
<div class="sf_admin_list">

<table cellspacing="0">
  <thead>
    <tr>
      <th class="sf_admin_text" colspan="3">Rank</th>
      <th class="sf_admin_text">Text</th>
      <th class="sf_admin_text">Actions</th>
    </tr>
  </thead>
  <tbody>
<?php foreach($item_group->getWpmoduleItems() as $wpmodule_item): ?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">

      <td><?php echo $wpmodule_item->getRank() ?></td>
	  
	<td>
	<?php if($wpmodule_item->getRank()< $item_group->countWpmoduleItems()): ?>
		<?php include_partial('movedown', array('wpmoduleitem' => $wpmodule_item)) ?>
	<?php endif ?>
	</td>
	<td><?php if($wpmodule_item->getRank()>1): ?>
		<?php include_partial('moveup', array('wpmoduleitem' => $wpmodule_item)) ?>
	<?php endif ?>
	</td>
      <td><span id="moduleitem_<?php echo $wpmodule_item->getId()?>" class="editText"><?php echo html_entity_decode($wpmodule_item->getContent())?></span>
	<?php echo input_in_place_editor_tag('moduleitem_'.$wpmodule_item->getId(), 'wpmoduleitem/editInLine?property=Content&id='.$wpmodule_item->getId(), array('cols'=>'50', 'rows'=>1)) ?>
	</td>
	<td>
			<ul class="sf_admin_td_actions">
				<li class="sf_admin_action_rich">
					<?php echo link_to(
						__('rich text edit'),
						'wpmoduleitem/edit?id='.$wpmodule_item->getId()) ?>
				</li>
				<li class="sf_admin_action_delete">
					<?php echo link_to(
						__('Delete'),
						'wpmoduleitem/delete?id='.$wpmodule_item->getId(),
						array('method' => 'delete', 'confirm' => __('Are you sure?')) 
					)?>
				</li>
			</ul>
			</td>

   </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php /*
<ul>
<?php foreach($item_group->getWpmoduleItems() as $wpmodule_item): ?>
	<li>
	<span id="moduleitem_<?php echo $wpmodule_item->getId()?>" class="editText"><?php echo $wpmodule_item->getContent() ?></span>
	<?php echo input_in_place_editor_tag('moduleitem_'.$wpmodule_item->getId(), 'wpmoduleitem/editInLine?property=Content&id='.$wpmodule_item->getId(), array('cols'=>'50', 'rows'=>1)) ?>
	&nbsp;<?php echo link_to(__('rich text edit'), 'wpmoduleitem/edit?id='.$wpmodule_item->getId()) ?></li>
<?php endforeach ?>
</ul>
*/ ?>


<a href="new">new...</a>

<!--

todo: 

   rich text edit
   up / down
   new
   delete

	multiline
	
-->   
