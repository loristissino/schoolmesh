<?php use_helper('Javascript') ?>
<?php use_helper('jQuery') ?>
<?php use_helper('Schoolmesh') ?>
<?php use_helper('Form') ?>
<?php use_helper('Object') ?>
<?php use_javascript('jquery.jeditable.mini.js') ?>

<?php slot('title', sprintf('%s -- %s --  %s', $wpmodule->getTitle(), $workplan->__toString(), $owner->getFullName())) ?>
<?php slot('breadcrumbs',
	link_to(__("Plans and Reports"), "@plansandreports") . ' » ' . 
	link_to($workplan, 'plansandreports/fill?id='.$workplan->getId()) . ' » ' . 
	$wpmodule->getTitle()
	)
	
	?>
  
<h1><?php echo __('Module: ') ?>
<?php if ($wpmodule->getTitle()=='---'): ?>
			<?php echo image_tag('notdone', 'title=' . __('this content is required and is currently missing')). ' ' ?>
<?php endif ?>
<span id="moduletitle" class="editText"><?php echo $wpmodule->getTitle() ?></span><?php echo inputinplaceeditortag('#moduletitle', url_for('wpmodule/editInLine?property=Title&id='.$wpmodule->getId()), array('tooltip'=>__('Click here to edit the title'), 'hover'=>'yellow')) ?></h1>


<ul>
<li><?php echo __('Teacher: ') ?><strong><?php echo $owner->getFullName() ?></strong></li>
<li><?php echo __('Workplan / Report: ') ?><strong><?php echo link_to($workplan, 'plansandreports/fill?id='.$workplan->getId()) ?></strong></li>
<li><?php echo __('Period: ') ?>
<?php if ($wpmodule->getPeriod()=='---'): ?>
			<?php echo image_tag('notdone', 'title=' . __('this content is required and is currently missing')). ' ' ?>
<?php endif ?>
<strong><span id="moduleperiod" class="editText"><?php echo $wpmodule->getPeriod() ?></span></strong>
<?php echo inputinplaceeditortag('moduleperiod', 'wpmodule/editInLine?property=Period&id='.$wpmodule->getId(), array('cols'=>'50', 'rows'=>1)) ?></li>
<li><?php echo __('Hours estimated: ') ?>
<strong><span id="modulehours_estimated" class="editText"><?php echo $wpmodule->getHoursEstimated() ?></span></strong>
<?php echo inputinplaceeditortag('modulehours_estimated', 'wpmodule/editInLine?property=HoursEstimated&id='.$wpmodule->getId(), array('cols'=>'5', 'rows'=>1)) ?></li>
</ul>



<table>
<tr>
<?php foreach($item_groups as $item_group): ?>
	<?php if($wpstate>=$item_group->getWpitemType()->getState()): ?>
		<?php include_partial('group_head', array('item_group' => $item_group, 'wpstate' => $wpstate, 'size'=>sizeof($item_groups))) ?>
	<?php endif ?>
<?php endforeach ?>
</tr>
</table>

<?php foreach($item_groups as $item_group): ?>
	<?php if($wpstate>=$item_group->getWpitemType()->getState()): ?>
		<?php include_partial('group_boxes', array('item_group' => $item_group, 'wpstate' => $wpstate)) ?>
	<?php endif ?>
<?php endforeach ?>


<h2><?php echo __('Actions') ?></h2>
			<ul class="sf_admin_td_actions">
				<li class="sf_admin_action_edit">
				<?php echo link_to(__('Edit heading'), 'wpmodule/editheading?id='.$wpmodule->getId()) ?>
				</li><br />
				<li class="sf_admin_action_back">
				<?php echo link_to(sprintf(__('Back to document «%s»'), $workplan), 'plansandreports/fill?id='.$workplan->getId(). '&ref=wpmodule#modules')  ?>
				</li><br />
	</ul>

