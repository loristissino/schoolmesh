<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    '@plansandreports' => "Plans and Reports",
    'plansandreports/fill?id=' . $workplan->getId() => $workplan
    ),
  'current'=>__('Workplan import'),
  'title' =>__('Workplan import')  . ' - ' . $workplan
  ))
?>

<?php include_partial('basicinfo', array('workplan'=>$workplan, 'steps'=>$steps)) ?>

<h3><?php echo __('Import one of your workplans') ?></h3>

<?php if (sizeof($s_workplans)>0): ?>

<div class="sf_admin_list">

<table cellspacing="0">
  <thead>
    <tr>
      <th class="sf_admin_text"><?php echo __('Year') ?></th>
      <th class="sf_admin_text"><?php echo __('Class') ?></th>
      <th class="sf_admin_text"><?php echo __('Subject') ?></th>
      <th class="sf_admin_text"><?php echo __('Modules') ?></th>
	  <th class="sf_admin_text"><?php echo __('State') ?></th>
      <th class="sf_admin_text"><?php echo __('Actions') ?></th>
    </tr>
  </thead>
  <tbody>
	<?php $i=0 ?>
	<?php foreach($s_workplans as $iworkplan): ?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
      <?php include_partial('content/td_year', array('year'=>$iworkplan->getYear())) ?>
      <td><?php echo $iworkplan->getSchoolclass() ?></td>
      <td><?php echo $iworkplan->getSubject() ?></td>
      <td><?php echo $iworkplan->countWpmodules() ?></td>
      <td><?php include_partial('state', array('state' => $iworkplan->getState(), 'steps' => $steps, 'size'=>'r')) ?></td>
      <td><?php include_partial('actionimport', array('iworkplan'=>$iworkplan, 'workplan'=>$workplan, 'user'=>$user))?></td>
	</td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

</div>

<?php else: ?>
	<p><?php echo __('No workplan found.') ?></p>
<?php endif ?>

<h3><?php echo __('Import a workplan of a colleague') ?></h3>

<?php if (sizeof($c_workplans)>0): ?>

<div class="sf_admin_list">

<table cellspacing="0">
  <thead>
    <tr>
      <th class="sf_admin_text"><?php echo __('Year') ?></th>
      <th class="sf_admin_text"><?php echo __('Class') ?></th>
      <th class="sf_admin_text"><?php echo __('Teacher') ?></th>
      <th class="sf_admin_text"><?php echo __('Modules') ?></th>
	  <th class="sf_admin_text"><?php echo __('State') ?></th>
      <th class="sf_admin_text"><?php echo __('Actions') ?></th>
    </tr>
  </thead>
  <tbody>
	<?php $i=0 ?>
	<?php foreach($c_workplans as $iworkplan): ?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
      <?php include_partial('content/td_year', array('year'=>$iworkplan->getYear())) ?>
      <td><?php echo $iworkplan->getSchoolclass() ?></td>
      <td><?php echo $iworkplan->getFullName() ?></td>
	  <td><?php echo $iworkplan->countWpmodules() ?></td>
	  <td><?php include_partial('state', array('state' => $iworkplan->getState(), 'steps' => $steps, 'size'=>'r')) ?></td>
	  <td><?php include_partial('actionimport', array('iworkplan'=>$iworkplan, 'workplan'=>$workplan, 'user'=>$user))?></td>
	</td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

</div>

<?php else: ?>
	<p><?php echo __('No workplan found.') ?></p>
<?php endif ?>

<h3><?php echo __('Import from a file') ?></h3>
<p><?php echo __('Not implemented yet') ?></p>
