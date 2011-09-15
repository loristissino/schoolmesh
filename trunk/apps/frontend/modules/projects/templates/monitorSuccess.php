<?php include_partial('content/breadcrumps', array(
  'current'=>__("Projects monitoring")
  ))
?>

<?php include_partial('content/flashes'); ?>

<div class="sf_admin_list">

<?php if(sizeof($projects)>0): ?>


<form action="<?php echo url_for('projects/batch') ?>" method="get">

<table cellspacing="0">
  <thead>
    <tr>
      <th id="sf_admin_list_batch_actions"><input id="sf_admin_list_batch_checkbox" type="checkbox" onclick="checkAll();" /></th>
      <th class="sf_admin_text"><?php echo __('Year') ?></th>
      <th class="sf_admin_text"><?php echo __('Title') ?></th>
      <th class="sf_admin_text"><?php echo __('Coordinator') ?></th>
      <th class="sf_admin_text"><?php echo __('State') ?></th>
      <th class="sf_admin_text"><?php echo __('Approval date') ?></th>
      <th class="sf_admin_text"><?php echo __('Financing date') ?></th>
      <th class="sf_admin_text"><?php echo __('Deadlines') ?></th>
      <th class="sf_admin_text"><?php echo __('Actions') ?></th>
    </tr>
  </thead>
  <tbody>
	<?php $i=0 ?>
    <?php foreach ($projects as $project): ?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
    	<td>
      <input type="checkbox" name="ids[]" value="<?php echo $project->getId() ?>" class="sf_admin_batch_checkbox" />
      </td>
      <?php include_partial('content/td_year', array('year'=>$project->getYear())) ?>
      <td><strong><?php echo $project->getTitle() ?></strong></td>
      <td><?php echo $project->getsfGuardUser()->getProfile()->getFullName() ?></td>
      <td><?php include_partial('state', array('project'=>$project)) ?></td>
      <td><?php echo Generic::datetime($project->getApprovalDate('U'), $sf_context) ?></td>
      <td><?php echo Generic::datetime($project->getFinancingDate('U'), $sf_context) ?></td>
      <td>
      <?php if ($project->isViewableBy($sf_user)): ?>
        <?php include_partial('deadlinesicons', array('project'=>$project)) ?>
      <?php endif ?>
      </td>
	  <td><?php include_partial('monitoraction', array('project' => $project, 'steps' => $steps)) ?></td>

	</tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php include_partial('plansandreports/checkalljs') ?>
 <ul class="sf_admin_actions">
      <li class="sf_admin_batch_actions_choice">
  <select name="batch_action">

<?php echo optionsforselect(array(
  0 => __('Choose an action'),
  'setapprovaldate' => __('Set approval date'),
  'setfinancingdate' => __('Set financing date'),
  'viewasreport' => __('View as report'),
  'computebudget' => __('Compute budget'),
  'computesynthesis' => __('Compute data synthesis'),
  'updatestandardcosts' => __('Update standard costs'),
  'resettodraft' => __('Reset to draft'),
  'spreadsheet' => __('Export as spreadsheet'),
), 0) ?>
  </select>

<?php echo submittag(_('Ok')) ?>
</li>



<?php else: ?>
<p><?php echo __('No projects defined.') ?></p>
<?php endif ?>
</div>

<?php include_partial('content/year', array('year'=>$year, 'years'=>$years, 'back'=>'projects/monitor')) ?>

