<?php include_partial('content/breadcrumps', array(
  'current'=>__("Projects")
  ))
?>

<?php include_partial('content/flashes'); ?>

<div class="sf_admin_list">

<?php if(sizeof($projects)>0): ?>

<table cellspacing="0">
  <thead>
    <tr>
      <th class="sf_admin_text"><?php echo __('Year') ?></th>
      <th class="sf_admin_text"><?php echo __('Title') ?></th>
      <th class="sf_admin_text"><?php echo __('Coordinator') ?></th>
      <th class="sf_admin_text"><?php echo __('State') ?></th>
      <th class="sf_admin_text"><?php echo __('Deadlines') ?></th>
      <th class="sf_admin_text"><?php echo __('Actions') ?></th>
    </tr>
  </thead>
  <tbody>
	<?php $i=0 ?>
    <?php foreach ($projects as $project): ?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
      <?php include_partial('content/td_year', array('year'=>$project->getYear())) ?>
      <td><?php echo $project->getTitle() ?></td>
      <td><?php echo $project->getsfGuardUser()->getProfile()->getFullName() ?></td>
      <td><?php echo $project->getState() ?></td>
      <td>
      <?php if ($project->isViewableBy($sf_user)): ?>
        <?php include_partial('deadlinesicons', array('project'=>$project)) ?>
      <?php endif ?>
      </td>
	  <td><?php include_partial('action', array('project' => $project, 'steps' => $steps)) ?></td>

	</tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php else: ?>
<p><?php echo __('No projects defined.') ?></p>
<?php endif ?>
</div>

<ul class="sf_admin_actions">

  <li class="sf_admin_action_new">
    <?php echo link_to(
		__('New project'),
		'projects/new',
		array('title'=>__('Prepare a new project'))
		)?>
		</li>

</ul>