<?php use_helper('Javascript') ?>
<?php use_helper('Form') ?>

<?php slot('title', __("Workplans and reports' monitoring")) ?>
<?php slot('breadcrumbs',
	link_to(__("Plans and Reports"), "@plansandreports") . ' » ' . 
	__("Monitoring")
	)
	
	?>

<h1><?php echo __("Workplans and reports' monitoring") ?></h1>

<form action="<?php echo url_for('plansandreports/batchapprove') ?>" method="post">

<table cellspacing="0">
  <thead>
    <tr>
	  <th id="sf_admin_list_batch_actions"><input id="sf_admin_list_batch_checkbox" type="checkbox" onclick="checkAll();" /></th>

      <th class="sf_admin_text"><?php echo link_to(__('Class'), 'plansandreports/list?sortby=class') ?></th>
      <th class="sf_admin_text"><?php echo link_to(__('Subject'), url_for('plansandreports/list?sortby=subject')) ?></th>
      <th class="sf_admin_text"><?php echo link_to(__('Teacher'), 'plansandreports/list?sortby=teacher') ?></th>
      <th class="sf_admin_text"><?php echo __('Modules') ?></th>
	  <?php /*<th class="sf_admin_text"><?php echo __('Last action') ?></th> */ ?>
	  <th class="sf_admin_text"><?php echo link_to(__('State'), 'plansandreports/list?sortby=state') ?></th>
      <th class="sf_admin_text"><?php echo __('Actions') ?></th>
    </tr>
  </thead>
  <tbody>
	<?php $i=0 ?>
    <?php foreach ($workplans as $workplan): ?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
	<td>
  <input type="checkbox" name="ids[]" value="<?php echo $workplan-id ?>" class="sf_admin_batch_checkbox" />
</td>

      <td><?php echo $workplan->schoolclass_id ?></td>
      <td><?php echo $workplan->subject ?></td>
      <td><?php echo sprintf('%s %s', $workplan->first_name, $workplan->last_name) ?></td>
	  <td><?php echo $workplan->wpmodules ?></td>
	  <?php /*<?php $lastlog=$workplan->getLastLog() ?>  
	  <td><?php echo $lastlog?$lastlog->getCreatedAt():'' ?></td>*/ ?>
	  <td><?php include_partial('state', array('state' => $workplan->state, 'steps' => $steps, 'size'=>'r')) ?></td>
	  <td><?php /* include_partial('action_monitor', array('workplan' => $workplan, 'steps' => $steps)) */ ?></td>
 	
	</td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php include_partial('checkalljs') ?>
    <ul class="sf_admin_actions">
      <li class="sf_admin_batch_actions_choice">
  <select name="batch_action">

<?php echo options_for_select(array(
  '' => __('Choose an action'),
  'batchApprove' => __('Approve selected documents'),
  'batchReject' => __('Reject selected documents'),
), 0) ?>
  </select>

<?php echo submit_tag(_('Ok')) ?>

</li>
</ul>

</form>