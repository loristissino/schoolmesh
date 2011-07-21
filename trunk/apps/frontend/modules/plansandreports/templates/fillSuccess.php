<?php use_helper('jQuery') ?>

<?php slot('title', sprintf('%s --  %s', $workplan->__toString(),$workplan->getsfGuardUser()->getProfile()->getFullName() )) ?>
<?php slot('breadcrumbs',
	link_to(__("Plans and Reports"), "@plansandreports") . ' » ' . 
	$workplan
	)
	
	?>
	<?php $state=$workplan->getState() ?>
	<h1><?php echo __($steps[$state]['stateDescription']) . ': ' . $workplan ?></h1>


<?php include_partial('basicinfo', array('workplan'=>$workplan,  'steps'=>$steps)) ?>

<?php include_partial('content/flashes'); ?>

<hr />

<a name="info"></a>
<h2><?php echo __('General information') ?></h2>
<!--<div id="sf_admin_container">-->
	<ul class="sf_admin_actions">
	<li class="sf_admin_action_toggle">
<?php echo jq_link_to_function(
  __('Toggle'),
  jq_visual_effect('slideToggle', '#infos')
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
<?php echo jq_link_to_function(
  __('Toggle'),
  jq_visual_effect('slideToggle', '#modules')
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
	<ul class="sf_admin_actions">
	<li class="sf_admin_action_toggle">
<?php echo jq_link_to_function(
  __('Toggle'),
  jq_visual_effect('slideToggle', '#aux')
) ?>
</li>
</ul>

<div id="aux" style="display:<?php echo $sf_user->hasFlash('notice_aux')||strpos($sf_user->getAttributeHolder()->serialize(), 'error_aux')? 'visible': 'none' ?>">
<?php include_partial('aux', array('workplan' => $workplan, 'tools' => $tools)) ?>
</div>

<hr />


<h2><?php echo __("Workflow") ?></h2>

<?php include_partial('workflow', array('workflow_logs' => $workflow_logs)) ?>

<hr />
<?php if ($steps[$state]['owner']['submitAction']!=''): ?>
	<?php include_partial('wpactions', array('workplan'=>$workplan, 'steps'=>$steps)) ?>
<?php endif ?>
