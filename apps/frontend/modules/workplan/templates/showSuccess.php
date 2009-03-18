<h1><?php echo __("Workplan: ") . $workplan ?></h1>

<h2><?php echo __("General information") ?></h2>
<ul>
	<li><?php echo __("Teacher: ") . $workplan->getsfGuardUser()->getProfile()->getFullName() ?></li>
	<li><?php echo __("Class: ") . $workplan->getSchoolclass() ?></li>
	<li><?php echo __("Year: ") . $workplan->getYear() ?></li>
</ul>
<hr />

<h2><?php echo __("Workflow") ?></h2>
<ul>
	<li><?php echo __("Current status") ?>: <strong><?php echo $status_descriptions[$workplan->getStatus()] ?></strong></li>
	<li><?php echo __("Last update") ?>: <?php echo $workplan->getUpdatedAt() ?></li>
<?php if($workplan->getStatus()>=1): ?>
	<li><?php echo __("History") ?>: </li>
		<ul>
		<li><?php echo $workplan->getWpsubmittedAt()?>: <?php echo $status_descriptions[1] ?></li>
<?php if($workplan->getStatus()>=2): ?>
		<li><?php echo $workplan->getWpapprovedAt()?>: <?php echo $status_descriptions[2] ?></li>
<?php endif ?>
<?php if($workplan->getStatus()>=3): ?>
		<li><?php echo $workplan->getFrsubmittedAt()?>: <?php echo $status_descriptions[3] ?></li>
<?php endif ?>
<?php if($workplan->getStatus()>=4): ?>
		<li><?php echo $workplan->getFrapprovedAt()?>: <?php echo $status_descriptions[4] ?></li>
<?php endif ?>
	</ul>
<?php endif ?>
</ul>

<?php if ($submit_actions[$workplan->getStatus()]!=''): ?>
	<p><?php echo __("Actions") ?>: <a href="<?php echo url_for('workplan/submit?id='.$workplan->getId()) ?>">
	<?php echo $submit_actions[$workplan->getStatus()] ?></a></p>
<?php endif ?>
<hr />

<h2><?php echo __("Modules") ?></h2>
<?php include_partial('modules', array('workplan' => $workplan)) ?>
<p><a href="">New module</a></p>
<hr />

<p><a href="<?php echo url_for('workplan/index') ?>">List my workplans</a></p>
