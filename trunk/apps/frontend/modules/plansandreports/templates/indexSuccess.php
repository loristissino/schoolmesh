<div id="sf_admin_container">

<h1><?php echo __("Workplans and Reports")?></h1>

<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="notice"><?php echo $sf_user->getFlash('notice')?></div>
<?php endif; ?>
<?php if ($sf_user->hasFlash('error')): ?>
  <div class="error"><?php echo $sf_user->getFlash('error')?></div>
<?php endif; ?>
<div class="sf_admin_list">

<table cellspacing="0">
  <thead>
    <tr>
      <th class="sf_admin_text">Year</th>
      <th class="sf_admin_text">Class</th>
      <th class="sf_admin_text">Subject</th>
      <th class="sf_admin_text">Modules</th>
	  <th class="sf_admin_text">Last action</th>
	  <th class="sf_admin_text">State</th>
      <th class="sf_admin_text">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($workplans as $workplan): ?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
      <td><?php echo $workplan->getYear() ?></td>
      <td><?php echo $workplan->getSchoolclass() ?></td>
      <td><?php echo $workplan->getSubject() ?></td>
	  <td><?php echo $workplan->countWpmodules() ?></td>
	  <?php $lastlog=$workplan->getLastLog() ?>  
	  <td><?php echo $lastlog->getCreatedAt() ?></td>
	  <td><?php include_partial('state', array('state' => $workplan->getState(), 'steps' => $steps, 'size'=>'r')) ?></td>
	  <td><?php include_partial('action', array('workplan' => $workplan, 'steps' => $steps)) ?></td>
 	
	</td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

