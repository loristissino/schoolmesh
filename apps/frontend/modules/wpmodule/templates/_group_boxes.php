<div id="group<?php echo $item_group->getId() ?>" style="display:<?php echo ($sf_user->hasFlash('notice'.$item_group->getId())||$sf_user->hasFlash('evaluation'.$item_group->getId()) || $sf_user->hasFlash('error'.$item_group->getId()))? 'visible': 'none' ?>">

<?php $i=0 ?>

<a name="<?php echo $item_group->getId() ?>"></a>
<h3><?php echo $item_group->getWpitemType()->getTitle() ?></h3>
<ul class="sf_admin_actions">
	<li class="sf_admin_action_toggle">
<?php echo jq_link_to_function(
  __('Hide'),
  jq_visual_effect('slideToggle', '#group'.$item_group->getId()), array(__('Hide'))
) ?>
</li>
</ul>

<?php if ($sf_user->hasFlash('notice'.$item_group->getId())): ?>
  <div class="notice"><?php echo $sf_user->getFlash('notice'.$item_group->getId())?></div>
<?php endif; ?>
<?php if ($sf_user->hasFlash('error'.$item_group->getId())): ?>
  <div class="error"><?php echo $sf_user->getFlash('error'.$item_group->getId())?></div>
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
      <th class="sf_admin_text" colspan="3"><?php echo __('Rank') ?></th>
      <th class="sf_admin_text"><?php echo $item_group->getWpitemType()->getSingular() ?></th>
	<?php if(($wpstate==Workflow::IR_DRAFT) && ($item_group->getWpitemType()->getEvaluationMax()>=0)): ?>
      <th class="sf_admin_text"><?php include_partial('content/evaluation_th_description', array(
        'min_value'=>$item_group->getWpitemType()->getEvaluationMin(),
        'min_description'=>$item_group->getWpitemType()->getEvaluationMinDescription(),
        'max_value'=>$item_group->getWpitemType()->getEvaluationMax(),
        'max_description'=>$item_group->getWpitemType()->getEvaluationMaxDescription(),
        )) ?>
      </th>
	<?php endif ?>
      <th class="sf_admin_text"><?php echo __('Actions') ?></th>
    </tr>
  </thead>
  <tbody>
<?php foreach($item_group->getWpmoduleItems() as $wpmodule_item): ?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">

      <td><?php echo $wpmodule_item->getRank() ?></td>
	  
	<td>
	<?php if($wpmodule_item->getRank()< $item_group->countWpmoduleItems()): ?>
		<?php include_partial('content/movedown', array('module'=>'wpmoduleitem', 'id' => $wpmodule_item->getId())) ?>
	<?php endif ?>
	</td>
	<td><?php if($wpmodule_item->getRank()>1): ?>
		<?php include_partial('content/moveup', array('module'=>'wpmoduleitem', 'id' => $wpmodule_item->getId())) ?>
	<?php endif ?>
	</td>
      <td><?php if ($wpmodule_item->getContent()=='---'): ?>
			<?php echo image_tag('notdone', 'title=' . __('this content is required and is currently missing')). ' ' ?>
<?php endif ?><span id="moduleitem_<?php echo $wpmodule_item->getId()?>" class="editText"><?php echo html_entity_decode($wpmodule_item->getContent())?></span>

	<?php if($wpmodule_item->getIsEditable() || $sf_user->hasCredential('backadmin')): ?>
		<?php echo inputinplaceeditortag('#moduleitem_'.$wpmodule_item->getId(), url_for('wpmoduleitem/editInLine?property=Content&id='.$wpmodule_item->getId(), false), array('tooltip'=>__('Click here to edit this text'), 'hover'=>'yellow', 'loadurl'=>url_for('wpmoduleitem/getContent?id='.$wpmodule_item->getId()))) ?>
	<?php endif ?>
	</td>
	<?php if(($wpstate==Workflow::IR_DRAFT) && ($item_group->getWpitemType()->getEvaluationMax()>=0)): ?>
	<td>
		<?php include_partial('evaluation', array(
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
						array('method' => 'delete', 'confirm' => format_number_choice(__('[0]Are you sure?|[1]Are you sure?'), null, $sf_user->getProfile()->getIsMale())) 
					)?>
				</li>
	<?php endif ?>
			</ul>
			</td>

   </tr>
    <?php endforeach; ?>
  </tbody>
</table>




<div id="sf_admin_container">
	<ul class="sf_admin_actions">
	<li class="sf_admin_action_new"><?php echo link_to(__('New'), 'wpmoduleitem/new?id=' .$item_group->getId(), array('method'=>'put')) ?></li>
	<?php if($wpstate==Workflow::WP_DRAFT): ?>
		<li class="sf_admin_action_items"><?php echo link_to(__('Quick list edit'), 'wpitemgroup/manage?id=' .$item_group->getId()) ?></li>
	<?php endif ?>
	</ul>
</div>

</div>

<hr />

</div>

