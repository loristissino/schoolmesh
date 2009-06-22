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
	  <td><?php include_partial('state', array('lastlog' => $lastlog, 'workplan' => $workplan, 'steps' => $steps)) ?></td>
	  <td><?php include_partial('action', array('lastlog' => $lastlog, 'workplan' => $workplan, 'steps' => $steps)) ?></td>
 	
	</td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<div id="sf_admin_container">
	<ul class="sf_admin_actions">
	<li class="sf_admin_action_new"><a href="<?php echo url_for('workplan/new') ?>">New</a></li>
	</ul>
</div>


<script type="text/javascript">
setVarsForm("pageID=profileEdit&userID=20");
</script>


<?php use_javascript('instantedit') ?>


<label>Obiettivi:</label>
<br />
<ul>
	<li><span id="field1" class="editText">obiettivo 1</span></li>
	<li><span id="field2" class="editText">obiettivo 2</span></li>
	<li><span id="field3" class="editText">obiettivo 3</span></li>
	<li><span id="field4" class="editText">obiettivo 4</span></li>
</ul>


