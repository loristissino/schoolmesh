<?php use_helper('Javascript') ?>
<?php slot('title', sprintf('%s --  %s', $workplan->__toString(),$workplan->getsfGuardUser()->getProfile()->getFullName() )) ?>
<?php slot('breadcrumbs',
	link_to(__("Plans and Reports"), "@plansandreports") . ' » ' . 
	$workplan
	)
	
	?><h1><?php echo __("Workplan: ") . $workplan ?></h1>

<?php $state=$workplan->getState() ?>
<?php include_partial('basicinfo', array('workplan'=>$workplan,  'steps'=>$steps)) ?>

<?php if ($sf_user->hasFlash('notice')): ?>
  <div class="notice"><?php echo $sf_user->getFlash('notice')?></div>
<?php endif; ?>

<hr />

<a name="info"></a>
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

<a name="wpmodules"></a>
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
<div id="modules" style="display:<?php echo ($sf_user->hasFlash('notice_modules')||$sf_user->hasFlash('error_modules'))? 'visible': 'none' ?>">
<?php include_partial('modules', array('workplan' => $workplan, 'user' => $sf_user)) ?>

	<ul class="sf_admin_actions">
	<li class="sf_admin_action_new">
	<?php echo link_to(
				__('New'),
				'wpmodule/new?id='.$workplan->getId(),
				array('method' => 'post', 'title'=>__('Create a new module')) 
				)?>
	
	</li>
	<li class="sf_admin_action_import">
	<?php echo link_to(
				__('Import'),
				'plansandreports/importmodule?id='.$workplan->getId(),
				array('title'=>'Import a module previously prepared')
				)?>
	
	</li>
	</ul>
</div>
<hr />

<a name="wpaux"></a>
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
<div id="aux" style="display:<?php echo $sf_user->hasFlash('notice_aux')||$sf_user->hasFlash('error_aux')? 'visible': 'none' ?>">
<?php include_partial('aux', array('workplan' => $workplan, 'tools' => $tools)) ?>
</div>



<hr />





<h2><?php echo __("Workflow") ?></h2>

<?php include_partial('workflow', array('workflow_logs' => $workflow_logs)) ?>

<hr />
<h2><?php echo __("Actions") ?></h2>


<?php if ($steps[$state]['owner']['submitAction']!=''): ?>
	<ul class="sf_admin_actions">
	<li class="sf_admin_action_view">
				<?php echo link_to(
				__('Show this plan/report'),
				'plansandreports/view?id='.$workplan->getId(),
				array('title'=>__('Show this plan/report in a single page'))
				)?>
	</li><br />
<?php include_partial('export', array('workplan' => $workplan, 'steps'=>$steps)) ?><br />
<li class="sf_admin_action_help">
				<?php echo link_to(
				__('Help'),
				'@help',
				array('title'=>'Get help on this subject')
				)?>
	</li><br />
	<li class="sf_admin_action_submit">
				<?php echo link_to(
				__($steps[$state]['owner']['submitDisplayedAction']),
				'plansandreports/'. $steps[$state]['owner']['submitAction']. '?id='.$workplan->getId(),
				array('method' => 'put', 'confirm' => format_number_choice(__('[0]Are you sure?|[1]Are you sure?'), null, $user->getProfile()->getIsMale()) . ' ' . __('Workplans and reports submitted cannot be modified anymore...')) 
				)?>
	</li><br />
	</ul>
<?php endif ?>
