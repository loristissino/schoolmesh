<?php include_partial('content/breadcrumps', array(
  'current'=>__("Plans and Reports")
  ))
?>

<?php include_partial('content/flashes'); ?>

<div class="sf_admin_list">

<?php if(sizeof($workplans)>0): ?>

<table cellspacing="0">
  <thead>
    <tr>
      <th class="sf_admin_text"><?php echo __('Year') ?></th>
      <th class="sf_admin_text"><?php echo __('Class') ?></th>
      <th class="sf_admin_text"><?php echo __('Type') ?>/<?php echo __('Subject') ?></th>
      <th class="sf_admin_text"><?php echo __('Modules') ?></th>
      <th class="sf_admin_text"><?php echo __('Hours') ?></th>
      <th class="sf_admin_text"><?php echo __('Syllabus') ?></th>
	  <?php /*<th class="sf_admin_text"><?php echo __('Last action') ?></th> */ ?>
	  <th class="sf_admin_text"><?php echo __('State') ?></th>
      <th class="sf_admin_text"><?php echo __('Actions') ?></th>
    </tr>
  </thead>
  <tbody>
	<?php $i=0 ?>
    <?php foreach ($workplans as $workplan): ?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
      <?php include_partial('content/td_year', array('year'=>$workplan->getYear())) ?>
      <td><?php echo $workplan->getSchoolclass() ?></td>
      <td><?php echo $workplan->getTitle() ?></td>
	  <td><?php if($workplan->getAppointmentType() && $workplan->getAppointmentType()->getHasModules()): ?><?php echo $nb_modules=$workplan->countWpmodules() ?><?php endif ?></td>
	  <td><?php if($workplan->getAppointmentType() && $workplan->getAppointmentType()->getHasModules()): ?><?php echo $workplan->getHours() ?><?php endif ?></td>
	  <td><?php echo $workplan->getSyllabus() ?></td>
	  <?php /*<?php $lastlog=$workplan->getLastLog() ?>  
	  <td><?php echo $lastlog?$lastlog->getCreatedAt():'' ?></td>*/ ?>
	  <td><?php include_partial('state', array('state' => $workplan->getState(), 'steps' => $steps, 'size'=>'r')) ?></td>
	  <td><?php include_partial('action', array('workplan' => $workplan, 'steps' => $steps, 'nb_modules'=>$workplan->getAppointmentType() && $workplan->getAppointmentType()->getHasModules()?$nb_modules: 0)) ?></td>
 	
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>
<?php else: ?>
<p><?php echo __('You don\'t have any appointment set.') ?></p>
<?php endif ?>
</div>
