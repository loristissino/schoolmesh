<strong>Current value: <span class="evaluation" id="item_evaluation_<?php echo $wpmodule_item->getId() ?>">
	<?php if($wpmodule_item->getEvaluation()===NULL): ?>
		<?php echo __('not set') ?>
	<?php else: ?>
		<?php echo $wpmodule_item->getEvaluation() ?>
	<?php endif ?>
</span></strong>&nbsp;&nbsp;
<ul class="sf_admin_td_actions">

<?php for($v=$item_group->getWpitemType()->getEvaluationMin(); $v<=$item_group->getWpitemType()->getEvaluationMax(); $v++): ?>
<li class="sf_admin_action_evaluate">
<?php echo link_to_remote($v, array(
            'update'   => 'item_evaluation_'.$wpmodule_item->getId(),
            'url'      => 'wpmoduleitem/evaluate?id='.$wpmodule_item->getId().'&evaluation='.$v,
        )) ?>
</li>
<?php endfor ?>
<li class="sf_admin_action_reset">
	<?php echo link_to_remote(__('unset'), array(
            'update'   => 'item_evaluation_'.$wpmodule_item->getId(),
            'url'      => 'wpmoduleitem/evaluate?id='.$wpmodule_item->getId().'&evaluation=',
        )) ?>
</li>
</ul>