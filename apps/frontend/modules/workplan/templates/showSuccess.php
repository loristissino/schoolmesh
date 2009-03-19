<h1><?php echo __("Workplan: ") . $workplan ?></h1>

<div id="sf_admin_container">

<h2><?php echo __("General information") ?></h2>
<ul>
	<li><?php echo __("Teacher: ") . $workplan->getsfGuardUser()->getProfile()->getFullName() ?></li>
	<li><?php echo __("Class: ") . $workplan->getSchoolclass() ?></li>
	<li><?php echo __("Year: ") . $workplan->getYear() ?></li>
</ul>

	<ul class="sf_admin_actions">
	<li class="sf_admin_action_list"><a href="<?php echo url_for('workplan/index') ?>">List all my workplans</a></li>
	</ul>

<hr />

<h2><?php echo __("Modules") ?></h2>
<?php include_partial('modules', array('workplan' => $workplan)) ?>

	<ul class="sf_admin_actions">
	<li class="sf_admin_action_new"><a href="new">New</a></li>
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
	<ul class="sf_admin_actions">
	<li>
				<?php echo link_to(
				$submit_actions[$workplan->getStatus()],
				'workplan/wpsubmit?id='.$workplan->getId(),
				array('method' => 'put') 
				)?>
	</li>
	</ul>
<?php endif ?>
<hr />

</div>


<p></p>
