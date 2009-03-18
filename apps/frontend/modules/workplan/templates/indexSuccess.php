<div id="sf_admin_container">

<h1>Workplan List</h1>

<div class="sf_admin_list">

<table cellspacing="0">
  <thead>
    <tr>
      <th class="sf_admin_text">Year</th>
      <th class="sf_admin_text">Class</th>
      <th class="sf_admin_text">Subject</th>
      <th class="sf_admin_text">Modules</th>
	  <th class="sf_admin_text">Status</th>  
      <th class="sf_admin_text">Action</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($workplan_list as $workplan): ?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
      <td><?php echo $workplan->getYear() ?></td>
      <td><?php echo $workplan->getSchoolclass() ?></td>
      <td><?php echo $workplan->getSubject() ?></td>
	  <td><?php echo $workplan->countWpmodules() ?></td>
	  <td><?php echo $status_descriptions[$workplan->getStatus()] ?></td>
      <td><a href="<?php echo url_for('workplan/show?id='.$workplan->getId()) ?>"><?php echo $view_actions[$workplan->getStatus()] ?></a>
	</td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('workplan/new') ?>">New</a>
