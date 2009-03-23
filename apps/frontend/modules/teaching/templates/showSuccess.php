<h1><?php echo __("Workplan: ") . $workplan ?></h1>

<div id="sf_admin_container">



<h2><?php echo __("General information") ?></h2>
<?php $state = $workflow_logs[0]->getState() ?>
<p><?php include_partial('state', array('state' => $state, 'steps' => $steps, 'size'=>'')) ?></p>
<ul>
	<li><?php echo __("Teacher: ") . $workplan->getsfGuardUser()->getProfile()->getFullName() ?></li>
	<li><?php echo __("Class: ") . $workplan->getSchoolclass() ?></li>
	<li><?php echo __("Year: ") . $workplan->getYear() ?></li>
	<li><?php echo __("Current status") ?>: <?php echo $state ?> <em>(<?php echo __($steps[$state]['stateDescription']) ?>)</em></li>
</ul>

	<ul class="sf_admin_actions">
	<li class="sf_admin_action_list"><a href="<?php echo url_for('teaching/index') ?>">List all my workplans</a></li>
	</ul>

<hr />

<h2><?php echo __("Modules") ?></h2>
<?php include_partial('modules', array('workplan' => $workplan)) ?>

	<ul class="sf_admin_actions">
	<li class="sf_admin_action_new"><a href="new">New</a></li>
	</ul>

<hr />

<h2><?php echo __("Workflow") ?></h2>

<?php include_partial('workflow', array('workflow_logs' => $workflow_logs)) ?>

<?php if ($steps[$state]['submitAction']!=''): ?>
	<ul class="sf_admin_actions">
	<li>
				<?php echo link_to(
				$steps[$state]['submitAction'],
				'teaching/wpsubmit?id='.$workplan->getId(),
				array('method' => 'put') 
				)?>
	</li>
	</ul>
<?php endif ?>
<hr />

</div>




<!--<table>
  <tbody>
    <tr>
      <th>Id:</th>
      <td><?php echo $workplan->getId() ?></td>
    </tr>
    <tr>
      <th>User:</th>
      <td><?php echo $workplan->getUserId() ?></td>
    </tr>
    <tr>
      <th>Subject:</th>
      <td><?php echo $workplan->getSubjectId() ?></td>
    </tr>
    <tr>
      <th>Schoolclass:</th>
      <td><?php echo $workplan->getSchoolclassId() ?></td>
    </tr>
    <tr>
      <th>Year:</th>
      <td><?php echo $workplan->getYearId() ?></td>
    </tr>
    <tr>
      <th>Created at:</th>
      <td><?php echo $workplan->getCreatedAt() ?></td>
    </tr>
    <tr>
      <th>Updated at:</th>
      <td><?php echo $workplan->getUpdatedAt() ?></td>
    </tr>
    <tr>
      <th>Import code:</th>
      <td><?php echo $workplan->getImportCode() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('teaching/edit?id='.$workplan->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('teaching/index') ?>">List</a>
-->