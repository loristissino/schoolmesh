<?php use_helper('jQuery') ?>
<div id="item_evaluation_<?php echo $id ?>">
<!-- <strong>Current value: <?php echo $textvalue ?>
</span></strong>&nbsp;&nbsp;-->
<ul class="sf_admin_td_actions">

<?php for($v=$min; $v<=$max; $v++): ?>
<li class="sf_admin_action_<?php echo ($dbvalue==$v)? 'evaluate_' . (floor(($dbvalue-$min)*9/($max-$min))): 'reset' ?>">
<?php echo jq_link_to_remote($v, array(
            'update'   => 'item_evaluation_'.$id,
            'url'      => 'wpmoduleitem/evaluate?id='.$id.'&evaluation='.$v,
        )) ?>
</li>
<?php endfor ?>
<?php if ($dbvalue!=null): ?>
<li class="sf_admin_action_unset">
	<?php echo jq_link_to_remote(__('unset'), array(
            'update'   => 'item_evaluation_'.$id,
            'url'      => 'wpmoduleitem/evaluate?id='.$id.'&evaluation=',
        )) ?>
</li>
<?php endif ?>
</ul>
</div>
