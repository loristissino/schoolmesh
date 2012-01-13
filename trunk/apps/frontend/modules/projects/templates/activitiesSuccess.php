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
      <th class="sf_admin_text"><?php echo __('Resource/task') ?></th>
      <th class="sf_admin_text" style="text-align: center"><?php echo __('Beginning') ?></th>
      <th class="sf_admin_text"><?php echo __('M.U.') ?></th>
      <th class="sf_admin_text"><?php echo __('Quantity') ?></th>
      <th class="sf_admin_text"><?php echo __('Notes') ?></th>
      <th class="sf_admin_text"><?php echo __('Acknowledgement') ?></th>
      <th class="sf_admin_text"><?php echo __('Actions') ?></th>
    </tr>
  </thead>
  <tbody>
	<?php $i=0; $ending=0 ?>
    <?php foreach ($activities as $activity): ?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
      <td><?php echo $activity->getProjResource()->getSchoolproject() ?></td>
      <td><?php echo $activity->getProjResource() ?></td>
      <td>
        <?php if($activity->getPaperLog()): ?>
        <?php echo image_tag(
          'paper',
          array('title'=>__('Logged on paper'), 'size'=>'16x16')
          )
        ?>
      <?php endif ?>
        <?php echo $activity->getBeginning('d/m/y H:i') ?>
        <?php if(!$activity->getPaperLog() && $activity->getBeginning('U')<$ending): ?>
          <?php echo image_tag(
            'dubious',
            array(
              'title'=>__('This activity overlaps the previous one'),
              'size'=>'16x16',
              )
            )
          ?>
        <?php endif ?>
      </td>
      <td><?php echo $mu=$activity->getProjResource()->getProjResourceType()->getMeasurementUnit() ?></td>
      <td style="text-align: right"><?php echo $activity->getQuantity() ?></td>
      <td><?php if(!$activity->getPaperLog()) $ending=$activity->getEnding('U') ?><?php echo $activity->getNotes() ?></td>
      <td><?php include_partial('projects/acknowledgement', array('activity'=>$activity)) ?></td>
      <td>
      <ul class="sf_admin_td_actions">
        <?php if(!$activity->getAcknowledgedAt()): ?>
        <li class="sf_admin_action_edit">
        <?php echo link_to(
            __('Edit'),
            url_for('projects/editactivity?id='. $activity->getId())
            )
             ?></li>
        <li class="sf_admin_action_delete">
        <?php echo link_to(
            __('Delete'),
            url_for('projects/deleteactivity?id='. $activity->getId()),
            array('method'=>'post', 'confirm' => format_number_choice(__('[0]Are you sure?|[1]Are you sure?'), null, $sf_user->getProfile()->getIsMale()))
            )
             ?></li>
        <?php endif ?>
      </ul>
      </td>
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
