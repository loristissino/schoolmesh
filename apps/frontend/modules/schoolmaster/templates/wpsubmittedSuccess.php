<h1>Schoolmaster's Panel</h1>

<div id="sf_admin_container">

<h2>List of workplans submitted</h2>

<div class="sf_admin_list">

<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="notice"><?php echo $sf_user->getFlash('notice')?></div>
<?php endif; ?>
<?php if ($sf_user->hasFlash('error')): ?>
  <div class="error"><?php echo $sf_user->getFlash('error')?></div>
<?php endif; ?>

<table cellspacing="0">

  <thead>
    <tr>
      <th class="sf_admin_text">Teacher</th>
      <th class="sf_admin_text">Workplan</th>
      <th class="sf_admin_text">Actions</th>
    </tr>
  </thead>
  <tbody>
  <?php $i=0; ?>

    <?php foreach ($workplans as $workplan): ?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
      <td><?php echo $workplan->getFullName() ?></td>
	  <td><?php echo $workplan ?></td>
	  <?php include_partial('list_td_actions', array('appointment' => $workplan, 'steps' => $steps)) ?>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

</div>
