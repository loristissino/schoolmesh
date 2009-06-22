<?php if ($workplan->countWpmodules()): ?>
<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="notice"><?php echo $sf_user->getFlash('notice')?></div>
<?php endif; ?>
<?php if ($sf_user->hasFlash('error')): ?>
  <div class="error"><?php echo $sf_user->getFlash('error')?></div>
<?php endif; ?>

<?php $i=0 ?>
<div class="sf_admin_list">

<table cellspacing="0">
  <thead>
    <tr>
      <th class="sf_admin_text" colspan="3"><?php echo __('Rank') ?></th>
      <th class="sf_admin_text"><?php echo __('Period') ?></th>
      <th class="sf_admin_text"><?php echo __('Title') ?></th>
	  <?php if ($workplan->getState()>Workflow::WP_DRAFT): ?>
		<th class="sf_admin_text"><?php echo __('Evaluations') ?></th>
	  <?php endif ?>  
      <th class="sf_admin_text"><?php echo __('Actions') ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($workplan->getWpmodules() as $wpmodule): ?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
      <td><?php echo $wpmodule->getRank() ?></td>
	  
	<td>
	<?php if($wpmodule->getRank()<$workplan->countWpmodules()): ?>
		<?php include_partial('movedown', array('wpmodule' => $wpmodule)) ?>
	<?php endif ?>
	</td>
	<td><?php if($wpmodule->getRank()>1): ?>
		<?php include_partial('moveup', array('wpmodule' => $wpmodule)) ?>
	<?php endif ?>
	</td>
	
      <td><?php echo $wpmodule->getPeriod() ?></td>
      <td><?php echo $wpmodule ?></td>
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
				'wpmodule/show?id='.$wpmodule->getId(),
				array('method' => 'get') 
				)?>
			</li>
			<?php if($workplan->getState()==Workflow::WP_DRAFT): ?>
			<li class="sf_admin_action_delete">
				<?php echo link_to(
				__('Delete'),
				'wpmodule/delete?id='.$wpmodule->getId(),
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
</div>
<?php endif; ?>