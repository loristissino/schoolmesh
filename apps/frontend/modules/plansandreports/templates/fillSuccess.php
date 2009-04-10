<?php use_helper('Javascript') ?>
<h1><?php echo __("Workplan: ") . $workplan ?></h1>

<div id="sf_admin_container">

<h2><?php echo __("Basic information") ?></h2>
<?php $state = $workplan->getState() ?>
<p><?php include_partial('state', array('state' => $state, 'steps' => $steps, 'size'=>'')) ?></p>
<ul>
	<li><?php echo __("Teacher: ") . $workplan->getsfGuardUser()->getProfile()->getFullName() ?></li>
	<li><?php echo __("Class: ") . $workplan->getSchoolclass() ?></li>
	<li><?php echo __("Year: ") . $workplan->getYear() ?></li>
	<li><?php echo __("Current state") ?>: <?php echo $state ?> <em>(<?php echo __($steps[$state]['stateDescription']) ?>)</em></li>
</ul>

	<ul class="sf_admin_actions">
	<li class="sf_admin_action_view">
				<?php echo link_to(
				__('Complete view of this plan/report'),
				'plansandreports/view?id='.$workplan->getId()
				)?>
	</li>
	<li class="sf_admin_action_markdown">
				<?php echo link_to(
				__('Export as plain text (markdown)'),
				'plansandreports/view?id='.$workplan->getId()
				)?>
	</li>
	</ul>
<hr />

<h2><?php echo __('Details, comments, general information') ?></h2>
<!--<div id="sf_admin_container">-->
	<ul class="sf_admin_actions">
	<li class="sf_admin_action_toggle">
<?php echo link_to_function(
  __('Toggle'),
  visual_effect('toggle_blind', 'infos')
) ?>
</li>
</ul>
<!--</div>-->
<div id="infos" style="display:<?php echo $sf_user->hasFlash('notice_info') || $sf_user->hasFlash('error_info')? 'visible': 'none' ?>">
<?php include_partial('infos', array('wpinfos' => $wpinfos, 'state' => $state)) ?>
</div>
<hr />

<h2><?php echo __("Modules") ?></h2>
<!--<div id="sf_admin_container">-->
	<ul class="sf_admin_actions">
	<li class="sf_admin_action_toggle">
<?php echo link_to_function(
  __('Toggle'),
  visual_effect('toggle_blind', 'modules')
) ?>
</li>
</ul>
<!--</div>-->
<div id="modules" style="display:<?php echo $sf_user->hasFlash('notice')? 'visible': 'none' ?>">
<?php include_partial('modules', array('workplan' => $workplan)) ?>

	<ul class="sf_admin_actions">
	<li class="sf_admin_action_new">
	<?php echo link_to(
				__('New'),
				'wpmodule/new?id='.$workplan->getId(),
				array('method' => 'post') 
				)?>
	
	</li>
	</ul>
</div>
<hr />


<h2><?php echo __("Aux") ?></h2>
<!--<div id="sf_admin_container">-->
	<ul class="sf_admin_actions">
	<li class="sf_admin_action_toggle">
<?php echo link_to_function(
  __('Toggle'),
  visual_effect('toggle_blind', 'aux')
) ?>
</li>
</ul>
<!--</div>-->
<div id="aux" style="display:<?php echo $sf_user->hasFlash('notice_aux')? 'visible': 'none' ?>">
<?php include_partial('aux', array('workplan' => $workplan, 'tools' => $tools)) ?>
</div>



<hr />





<h2><?php echo __("Workflow") ?></h2>

<?php include_partial('workflow', array('workflow_logs' => $workflow_logs)) ?>

<?php if ($steps[$state]['owner']['submitAction']!=''): ?>
	<ul class="sf_admin_actions">
	<li class="sf_admin_action_submit">
				<?php echo link_to(
				$steps[$state]['owner']['submitDisplayedAction'],
				'plansandreports/'. $steps[$state]['owner']['submitAction']. '?id='.$workplan->getId(),
				array('method' => 'put', 'confirm' => __('Are you sure? Workplans and reports submitted cannot be modified anymore...')) 
				)?>
	</li>
	</ul>
<?php endif ?>
<hr />

</div>
