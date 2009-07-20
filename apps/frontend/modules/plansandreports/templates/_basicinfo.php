<h2><?php echo __("Basic information") ?></h2>
<?php $state = $workplan->getState() ?>
<p><?php include_partial('state', array('state' => $state, 'steps' => $steps, 'size'=>'')) ?></p>
<ul>
	<li><?php echo __("Teacher: ") . $workplan->getsfGuardUser()->getProfile()->getFullName() ?></li>
	<li><?php echo __("Class: ") . $workplan->getSchoolclass() ?></li>
	<li><?php echo __("Year: ") . $workplan->getYear() ?></li>
	<li><?php echo __("Current state") ?>: <?php echo $state ?> <em>(<?php echo __($steps[$state]['stateDescription']) ?>)</em></li>
</ul>
