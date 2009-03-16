<div id="sf_admin_container">

<h1>Workplan List</h1>

<div class="sf_admin_list">

<table cellspacing="0">
  <thead>
    <tr>
      <th class="sf_admin_text">Year</th>
      <th class="sf_admin_text">Class</th>
      <th class="sf_admin_text">Subject</th>
      <th class="sf_admin_text">Actions</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($workplan_list as $workplan): ?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
      <td><?php echo $workplan->getYear() ?></td>
      <td><?php echo $workplan->getSchoolclass() ?></td>
      <td><?php echo $workplan->getSubject() ?></td>
      <td><a href="<?php echo url_for('workplan/show?id='.$workplan->getId()) ?>"><?php echo __("show") ?></a>
	  <?php if (!$workplan->getIsLocked()): ?>
			<a href="<?php echo url_for('workplan/edit?id='.$workplan->getId()) ?>"><?php echo __("edit") ?></a>
	  <?php endif; ?>
	</td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

  <a href="<?php echo url_for('workplan/new') ?>">New</a>
