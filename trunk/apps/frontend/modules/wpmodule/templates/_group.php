<?php use_helper('Form'); ?>
<?php use_helper('Object'); ?>

<hr />
<a name="<?php echo $item_group->getId() ?>"></a>
<h3><?php echo $item_group->getWpitemType()->getTitle() ?></h3>
<p><em><?php echo $item_group->getWpitemType()->getDescription() ?></em></p>
<div id="sf_admin_container">
	<ul class="sf_admin_actions">
	<li class="sf_admin_action_toggle">
<?php echo link_to_function(
  __('Toggle'),
  visual_effect('toggle_blind', 'group'.$item_group->getId())
) ?>
</li>
</ul>
</div>

<div id="group<?php echo $item_group->getId() ?>" style="display:<?php echo ($sf_user->hasFlash('notice'.$item_group->getId())||$sf_user->hasFlash('evaluation'.$item_group->getId()))? 'visible': 'none' ?>">

<?php $i=0 ?>
<?php if ($sf_user->hasFlash('notice'.$item_group->getId())): ?>
  <div class="notice"><?php echo $sf_user->getFlash('notice'.$item_group->getId())?></div>
<?php endif; ?>
<?php if ($sf_user->hasFlash('evaluation'.$item_group->getId())): ?>
  <div class="notice"><?php echo
	format_number_choice(
		'[0]Evaluation completed|[1]Missing one evaluation|[1,+Inf]Missing %1% evaluations',
		array("%1%"=>$sf_user->getFlash('evaluation'.$item_group->getId())),
		$sf_user->getFlash('evaluation'.$item_group->getId())) ?>
	</div>
<?php endif; ?>
<div class="sf_admin_list">

<table cellspacing="0">
  <thead>
    <tr>
      <th class="sf_admin_text" colspan="3">Rank</th>
      <th class="sf_admin_text">Text</th>
	<?php if(($wpstate==30) && ($item_group->getWpitemType()->getEvaluationMax()>=0)): ?>
      <th class="sf_admin_text">Evaluation<br />
	
	<span class="sf_admin_description">
		<?php echo __('min') .': '. $item_group->getWpitemType()->getEvaluationMin() ?> = <em><?php echo $item_group->getWpitemType()->getEvaluationMinDescription() ?></em> <br />
		<?php echo __('max') .': '. $item_group->getWpitemType()->getEvaluationMax() ?> = <em><?php echo $item_group->getWpitemType()->getEvaluationMaxDescription() ?></em> <br />
	</span>
	
	</th>
	<?php endif ?>
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

	<?php if($wpmodule_item->getIsEditable()): ?>
		<?php echo input_in_place_editor_tag('moduleitem_'.$wpmodule_item->getId(), 'wpmoduleitem/editInLine?property=Content&id='.$wpmodule_item->getId(), array('cols'=>'90', 'rows'=>1)) ?>
	<?php endif ?>
	</td>
	<?php if(($wpstate==30) && ($item_group->getWpitemType()->getEvaluationMax()>=0)): ?>
	<td>
		<?php //include_partial('evaluation', array('wpmodule_item' => $wpmodule_item, 'item_group'=>$item_group)) ?>
		<?php include_partial('evaluation2', array(
			'id'=>$wpmodule_item->getId(), 
			'dbvalue'=>$wpmodule_item->getEvaluation(), 
			'textvalue'=>$wpmodule_item->getEvaluationText(), 
			'min'=>$item_group->getWpitemType()->getEvaluationMin(), 
			'max'=>$item_group->getWpitemType()->getEvaluationMax())) ?>
	</td>
	<?php endif ?>

	<td>
			<ul class="sf_admin_td_actions">
	<?php if($wpmodule_item->getIsEditable()): ?>
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
	<?php endif ?>
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


<div id="sf_admin_container">
	<ul class="sf_admin_actions">
	<li class="sf_admin_action_new"><?php echo link_to(__('New'), 'wpmoduleitem/new?id=' .$item_group->getId(), array('method'=>'put')) ?></li>
	</ul>
</div>

</div>
</div>