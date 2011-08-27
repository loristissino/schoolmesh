<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'projects/index' =>__("Projects")
    ),
  'current'=>__('Activities'),
  ))
?>

<?php include_partial('content/flashes'); ?>

<div class="sf_admin_list">

<?php if(sizeof($activities)>0): ?>

<table cellspacing="0">
  <thead>
    <tr>
      <th class="sf_admin_text"><?php echo __('Project') ?></th>
      <th class="sf_admin_text"><?php echo __('Resource') ?></th>
      <th class="sf_admin_text"><?php echo __('Beginning') ?></th>
      <th class="sf_admin_text"><?php echo __('M.U.') ?></th>
      <th class="sf_admin_text"><?php echo __('Quantity') ?></th>
      <th class="sf_admin_text"><?php echo __('Notes') ?></th>
      <th class="sf_admin_text"><?php echo __('Acknowledgement') ?></th>
    </tr>
  </thead>
  <tbody>
	<?php $i=0 ?>
    <?php foreach ($activities as $activity): ?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
      <td><?php echo $activity->getProjResource()->getSchoolproject() ?></td>
      <td><?php echo $activity->getProjResource() ?></td>
      <td><?php echo $activity->getBeginning('d/m/y h:i') ?></td>
      <td><?php echo $activity->getProjResource()->getProjResourceType()->getMeasurementUnit() ?></td>
      <td style="text-align: right"><?php echo $activity->getQuantity() ?></td>
      <td><?php echo $activity->getNotes() ?></td>
      <td><?php include_partial('projects/acknowledgement', array('activity'=>$activity)) ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php else: ?>
<p><?php echo __('No activity declared.') ?></p>
<?php endif ?>
</div>

<ul class="sf_admin_actions">

  <li class="sf_admin_action_new">
    <?php echo link_to(
		__('New activity'),
		'projects/newactivity',
		array('title'=>__('Declare a new activity'))
		)?>
		</li>

</ul>