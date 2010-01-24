<?php slot('title', __('Projects')) ?>
<?php slot('breadcrumbs',
	__("Projects")
	)
	
	?><h1><?php echo __("Projects")?></h1>

<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="notice"><?php echo $sf_user->getFlash('notice')?></div>
<?php endif; ?>
<?php if ($sf_user->hasFlash('error')): ?>
  <div class="error"><?php echo $sf_user->getFlash('error')?></div>
<?php endif; ?>

<div class="sf_admin_list">

<?php if(sizeof($projects)>0): ?>

<table cellspacing="0">
  <thead>
    <tr>
      <th class="sf_admin_text"><?php echo __('Year') ?></th>
      <th class="sf_admin_text"><?php echo __('Title') ?></th>
      <th class="sf_admin_text"><?php echo __('Coordinator') ?></th>
      <th class="sf_admin_text"><?php echo __('Actions') ?></th>
    </tr>
  </thead>
  <tbody>
	<?php $i=0 ?>
    <?php foreach ($projects as $project): ?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
      <td><?php echo $project->getYear() ?></td>
      <td><?php echo $project->getTitle() ?></td>
      <td><?php echo $project->getsfGuardUser()->getProfile()->getFullName() ?></td>
	  <td><?php include_partial('action', array('project' => $project, 'steps' => $steps)) ?></td>

	</tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php else: ?>
<p><?php echo __('No projects defined') ?></p>
<?php endif ?>
</div>



<hr />

<?php echo link_to(
	__('Get Letters'),
	url_for('projects/letters')
	)
?>


