<?php if ($workplan->countWpmodules()): ?>
<?php if ($sf_user->hasFlash('notice_modules')): ?>
  <div class="notice"><?php echo $sf_user->getFlash('notice_modules')?></div>
<?php endif; ?>
<?php if ($sf_user->hasFlash('error_modules')): ?>
  <div class="error"><?php echo $sf_user->getFlash('error_modules')?></div>
<?php endif; ?>

<?php $i=0 ?>
<div class="sf_admin_list">

<table cellspacing="0">
  <thead>
    <tr>
      <th class="sf_admin_text" colspan="3"><?php echo __('Rank') ?></th>
      <th class="sf_admin_text"><?php echo __('Period') ?></th>
      <th class="sf_admin_text"><?php echo __('Title') ?></th>
      <th class="sf_admin_text"><?php echo __('Hours') ?></th>
      <th class="sf_admin_text"><?php echo __('Last update') ?></th>
      <th class="sf_admin_text"><?php echo __('Public?') ?></th>
	  <?php if ($workplan->getState()>Workflow::WP_DRAFT): ?>
		<th class="sf_admin_text"><?php echo __('Evaluation') ?></th>
	  <?php endif ?>  
      <th class="sf_admin_text"><?php echo __('Actions') ?></th>
    </tr>
  </thead>
  <tbody>
	<?php $hours_sum=0 ?>
    <?php foreach ($workplan->getWpmodules() as $wpmodule): ?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
      <td><?php echo $wpmodule->getRank() ?></td>
	  
	<td>
	<?php if($wpmodule->getRank()<$workplan->countWpmodules()): ?>
		<?php include_partial('content/movedown', array('module' => 'wpmodule', 'id'=>$wpmodule->getId())) ?>
	<?php endif ?>
	</td>
	<td><?php if($wpmodule->getRank()>1): ?>
		<?php include_partial('content/moveup', array('module' => 'wpmodule', 'id'=>$wpmodule->getId())) ?>
	<?php endif ?>
	</td>
	
      <td><?php echo $wpmodule->getPeriod() ?></td>
      <td><?php echo $wpmodule ?></td>

	  <td style="text-align: right">
	  <?php if ($wpmodule->getHoursEstimated()>0): ?>
			<?php echo $wpmodule->getHoursEstimated(); $hours_sum+=$wpmodule->getHoursEstimated(); ?>
	  <?php endif ?>
	</td>
      <td><?php  echo Generic::datetime($wpmodule->getUpdatedAt('U'), $sf_context) ?></td>
  <?php include_partial('content/td_public', array('object'=>$wpmodule, 'owner'=>$wpmodule->getOwner())) ?>
  
<?php if ($workplan->getState()>Workflow::WP_DRAFT): ?>
		<td><?php $missing=$wpmodule->getUnevaluated() ?>
		<?php if ($missing>0): ?>
			<?php echo image_tag('notdone') ?>
		<?php else: ?>
			<?php echo image_tag('done') ?>
		<?php endif; ?>
		<?php echo
			format_number_choice('[0]Evaluation completed|[1]Missing one evaluation out of %2%|[1,+Inf]Missing %1% evaluations out of %2%',
		    array('%1%'=>$missing, '%2%'=>$wpmodule->getToBeEvaluated()), $missing) ?></td>
	  <?php endif ?>  
      <td>
		<ul class="sf_admin_td_actions">
			<li class="sf_admin_action_fill">
			<?php /* here I should show edit or show depending on the state */ ?>
				<?php echo link_to(
				__('Fill'),
				'wpmodule/view?id='.$wpmodule->getId(),
				array('title'=>__('Fill this module specifying contents, objectives, skills, competencies, etc.')) 
				)?>
			</li>
      <li class="sf_admin_action_view">
					<?php echo link_to(
				__('View'),
				'wpmodule/show?id=' . $wpmodule->getId(),
				array('title'=>__('Show this module') . ' ' . __('(opens in a new window)'), 'popup' => array('popupWindow', 'width=600,height=300,left=250,top=0,scrollbars=yes'))
				)?>
			</li>

			<?php if($wpmodule->getIsDeletable()): ?>
			<li class="sf_admin_action_delete">
				<?php echo link_to(
				__('Delete'),
				'wpmodule/delete?id='.$wpmodule->getId(),
				array('method' => 'delete', 'confirm' => format_number_choice(__('[0]Are you sure?|[1]Are you sure?'), null, $user->getProfile()->getIsMale()), 'title'=>__('Delete this module'))
				)?>
			</li>
			<?php if($wpmodule->getIsPublic()): ?>
			<li class="sf_admin_action_unpublish">
				<?php echo link_to(
				__('Keep private'),
				'wpmodule/keepprivate?id='.$wpmodule->getId(),
				array('method' => 'put',  'title'=>__('Do not allow other teachers to see and use this module (until the workplan is submitted)'))
				)?>
			</li>
			<?php else: ?>
			<li class="sf_admin_action_publish">
				<?php echo link_to(
				__('Publish'),
				'wpmodule/publish?id='.$wpmodule->getId(),
				array('method' => 'put',  'title'=>__('Allow other teachers to see and use this module'))
				)?>
			</li>
			<?php endif ?>
			<li class="sf_admin_action_unlink">
				<?php echo link_to(
				__('Unlink'),
				'wpmodule/unlink?id='.$wpmodule->getId(),
				array('method' => 'put',  'title'=>__('Remove this module from this workplan, but keep it as avaliable for other ones')) 
				)?>
			</li>
			<?php endif ?>
		</ul>
	  </td>
    </tr>
    <?php endforeach; ?>
	<tr>
		<td colspan="5"></td>
		<td style="text-align: right">
			<?php if ($hours_sum>0): ?>
				<?php echo $hours_sum ?>
			<?php endif ?>
		</td>
		<td colspan="3"></td>
	</tr>
  </tbody>
</table>
</div>
<?php endif; ?>
