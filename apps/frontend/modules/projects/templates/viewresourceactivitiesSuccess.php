<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'projects/index' => __("Projects"),
    'projects/edit?id=' . $project->getId() => $project,
    '_resource' => $resource
    ),
  'current'=>__('Activities view'),
  'title' => __('Project «%project%»', array('%project%'=>$project->getTitle()))
  ))
?>

<?php include_partial('content/flashes'); ?>

<h2><?php echo __('Activities within the resource «%resource%»', array('%resource%'=>$resource->__toString())) ?></h2>

<?php if(sizeof($activities)>0): ?>

<table cellspacing="0">
  <thead>
    <tr>
      <th class="sf_admin_text"><?php echo __('User') ?></th>
      <th class="sf_admin_text"><?php echo __('Beginning') ?></th>
      <th class="sf_admin_text"><?php echo __('M.U.') ?></th>
      <th class="sf_admin_text"><?php echo __('Quantity') ?></th>
      <th class="sf_admin_text"><?php echo __('Notes') ?></th>
      <th class="sf_admin_text"><?php echo __('Acknowledgement') ?></th>
      <th class="sf_admin_text"><?php echo __('Actions') ?></th>
    </tr>
  </thead>
  <tbody>
	<?php $i=0; $total=0 ?>
    <?php foreach ($activities as $activity): ?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
      <td>
      <?php echo $activity->getPerformerProfile()->getFullname() ?>
      </td>
      <td>
      <?php echo $activity->getBeginning('d/m/Y h:i') ?>
      </td>
      <td>
      <?php echo $mu=$resource->getProjResourceType()->getMeasurementUnit() ?>
      </td>
      <td style="text-align: right">
      <?php echo $activity->getQuantity() ?>
      <?php if($activity->getAcknowledgedAt()) $total+=$activity->getQuantity() ?>
      </td>
      <td>
      <?php echo $activity->getNotes() ?>
      </td>
      <td>
      <?php echo $activity->getAcknowledgedAt('d/m/Y') ?>
      </td>
      <td>
      <ul class="sf_admin_td_actions">
        <?php if(!$activity->getAcknowledgedAt()): ?>
        <li class="sf_admin_action_approve">
        <?php echo link_to(
            __('Acknowledge'),
            url_for('projects/acknowledgeactivity?id='. $activity->getId()),
            array(
              'method' => 'post', 
              'title'=>__('Acknowledge the performing of this activity'),
              'confirm' => format_number_choice(__('[0]Are you sure?|[1]Are you sure?'), null, $sf_user->getProfile()->getIsMale())
              ) 

            )
             ?></li>
        <?php endif ?>
          
      </ul>
      </td>
    </tr>
    <?php endforeach; ?>
    <tr>
    <th colspan="2"><?php echo __('Total quantity acknowledged') ?></th>
    <td style="font-weight: bold"><?php echo $mu ?></td>
    <td style="text-align: right; font-weight: bold"><?php printf('%01.2f', $total) ?></td>
    <td colspan="3"></td>
    </tr>
  </tbody>
</table>
<?php else: ?>
<p><?php echo __('No activities defined.') ?></p>
<?php endif ?>
