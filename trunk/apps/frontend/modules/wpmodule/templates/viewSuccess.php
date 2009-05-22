<?php use_helper('Javascript') ?>
<?php slot('title', sprintf('%s -- %s --  %s', $wpmodule->getTitle(), $workplan->__toString(), $owner->getFullName())) ?>
<?php slot('breadcrumbs',
	link_to(__("Plans and Reports"), "@plansandreports") . ' » ' . 
	link_to($workplan, 'plansandreports/fill?id='.$workplan->getId()) . ' » ' . 
	link_to($wpmodule->getTitle(), 'wpmodule/view?id='.$wpmodule->getId())
	)
	
	?>
<h1><?php echo sprintf(__('Module view: %s'), $wpmodule)?></h1>

<div id="sf_admin_container">

<ul>
<li><?php echo __('Teacher: ') ?><strong><?php echo $owner->getFullName() ?></strong></li>
<li><?php echo __('Workplan / Report: ') ?><strong><?php echo link_to($workplan, 'plansandreports/fill?id='.$workplan->getId()) ?></strong></li>
<li><?php echo __('Title: ') ?>
<strong><span id="moduletitle" class="editText"><?php echo $wpmodule->getTitle() ?></span></strong>
<?php echo input_in_place_editor_tag('moduletitle', 'wpmodule/editInLine?property=Title&id='.$wpmodule->getId(), array('cols'=>'50', 'rows'=>1)) ?>
</li>
<li><?php echo __('Period: ') ?>
<strong><span id="moduleperiod" class="editText"><?php echo $wpmodule->getPeriod() ?></span></strong></li>
<?php echo input_in_place_editor_tag('moduleperiod', 'wpmodule/editInLine?property=Period&id='.$wpmodule->getId(), array('cols'=>'50', 'rows'=>1)) ?>
</ul>


<?php foreach($item_groups as $item_group): ?>

	<?php if($wpstate>=$item_group->getWpitemType()->getState()): ?>
		<?php include_partial('group', array('item_group' => $item_group, 'wpstate' => $wpstate)) ?>
	<?php endif ?>
<?php endforeach ?>

<hr />
<h2><?php echo __('Actions') ?></h2>
			<ul class="sf_admin_td_actions">

				<li class="sf_admin_action_back">
				<?php echo link_to(sprintf(__('Back to workplan/report %s'), $workplan), 'plansandreports/fill?id='.$workplan->getId()) ?>
				</li>
			</ul>


</div>