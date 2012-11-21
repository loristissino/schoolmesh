<?php include_partial('content/breadcrumps', array(
  'current'=>__("Projects management")
  ))
?>

<?php include_partial('content/flashes'); ?>

<div class="sf_admin_list">

<?php if(sizeof($projects)>0): ?>

<p><?php echo __('This list might include projects that have been submitted and reset to draft.') ?></p>

<form action="<?php echo url_for('projects/batch') ?>" method="get">

<table cellspacing="0">
  <thead>
    <tr>
      <th id="sf_admin_list_batch_actions"><input id="sf_admin_list_batch_checkbox" type="checkbox" onclick="checkAll();" /></th>
      <th class="sf_admin_text"><?php echo __('Year') ?></th>
      <th class="sf_admin_text"><?php echo __('Code') ?> - <?php echo __('Title') ?> - <?php echo __('Category') ?></th>
      <th class="sf_admin_text"><?php echo __('Coordinator') ?></th>
      <th class="sf_admin_text"><?php echo __('State') ?></th>
      <th class="sf_admin_text"><?php echo __('Reference number') ?></th>
      <th class="sf_admin_text" style="width: 100px"><?php echo __('Dates') ?></th>
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
      <td>
        <?php if($project->getCode()): ?>
          <?php echo $project->getCode() ?><br />
        <?php endif ?>
        <strong><?php echo $project->getTitle() ?></strong><br />
        <?php include_partial('category', array('category'=>$project->getProjCategory())) ?>
      </td>
      <td><?php echo $project->getsfGuardUser()->getProfile()->getFullName() ?></td>
      <td<?php if($project->getState()==Workflow::PROJ_FINISHED) echo ' class="workflow_finished"' ?><?php if($project->getState()==Workflow::PROJ_DRAFT) echo ' class="workflow_draft"' ?>><?php include_partial('state', array('project'=>$project)) ?></td>
      <td><?php echo $project->getReferenceNumber() ?></td>
      <td><?php include_partial('dates', array('project'=>$project)) ?></td>
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
  'setconfirmationdate' => __('Set confirmation date'),
  'viewasreport' => __('View as report'),
  'computebudget' => __('Compute budget'),
  'computesynthesiscomplete' => __('Compute data synthesis (complete)'),
  'computesynthesisstaffonly' => __('Compute data synthesis (staff only)'),
  'getstaffsynthesis' => __('Get staff synthetic document'),
  'updatestandardcosts' => __('Update standard costs'),
  'getchargeletters' => __('Get charge letters (coordinators)'),
  'gettaskchargeletters' => __('Get charge letters (singular tasks)'),
  'resettodraft' => __('Reset to draft'),
  'reassign' => __('Reassign'),
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

