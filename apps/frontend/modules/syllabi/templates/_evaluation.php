<?php use_helper('jQuery') ?>
<div id="syllabusitem_evaluation_<?php echo $id ?>">
<?php echo $textvalue ?>

<ul class="sf_admin_td_actions">

<?php for($v=$min; $v<=$max; $v++): ?>
<li class="sf_admin_action_<?php echo ($dbvalue==$v)? 'evaluate_' . (floor(($dbvalue-$min)*9/($max-$min))): 'reset' ?>">
<?php echo jq_link_to_remote($v, array(
            'update'   => 'syllabusitem_evaluation_'.$id,
            'url'      => 'syllabi/evaluate?id='.$id.'&evaluation='.$v,
        )) ?>
</li>
<?php endfor ?>
<?php if ($dbvalue!=null): ?>
<li class="sf_admin_action_unset">
	<?php echo jq_link_to_remote(__('unset'), array(
            'update'   => 'syllabusitem_evaluation_'.$id,
            'url'      => 'syllabi/evaluate?id='.$id.'&evaluation=',
        )) ?>
</li>
<?php endif ?>
</ul>

</div>
