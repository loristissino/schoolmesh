<?php use_helper('jQuery') ?>
<?php use_javascript('jquery.jeditable.mini.js') ?>

<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    '@plansandreports' => "Plans and Reports",
    'plansandreports/fill?id='.$workplan->getId() => $workplan
    ),
  'current'=>$wpmodule->getTitle(),
  'title'=>$workplan . ' -- ' . $wpmodule->getTitle(),
  ))
?>    

<h1><?php echo __('Module: ') ?>
<?php if ($wpmodule->getTitle()=='---'): ?>
			<?php echo image_tag('notdone', 'title=' . __('this content is required and is currently missing')). ' ' ?>
<?php endif ?>
<span id="moduletitle" class="editText"><?php echo $wpmodule->getTitle() ?></span>
<?php echo inputinplaceeditortag('#moduletitle', url_for('wpmodule/editInLine?property=Title&id='.$wpmodule->getId()), array('tooltip'=>__('Click here to edit the title'), 'hover'=>'yellow', 'width'=>'600')) ?>
</h1>

<ul>
<li><?php echo __('Teacher: ') ?><strong><?php echo $owner->getFullName() ?></strong></li>
<li><?php echo __('Workplan / Report: ') ?><strong><?php echo link_to($workplan, 'plansandreports/fill?id='.$workplan->getId()) ?></strong></li>
<li><?php echo __('Period: ') ?>
<?php if ($wpmodule->getPeriod()=='---'): ?>
			<?php echo image_tag('notdone', 'title=' . __('this content is required and is currently missing')). ' ' ?>
<?php endif ?>
<strong><span id="moduleperiod" class="editText"><?php echo $wpmodule->getPeriod() ?></span></strong>
<?php echo inputinplaceeditortag('#moduleperiod', url_for('wpmodule/editInLine?property=Period&id='.$wpmodule->getId()),array('tooltip'=>__('Click here to edit the period'), 'hover'=>'yellow')) ?></li>
<li><?php echo __('Hours estimated: ') ?>
<strong><span id="modulehours_estimated" class="editText"><?php echo $wpmodule->getHoursEstimated() ?></span></strong><?php echo inputinplaceeditortag('#modulehours_estimated', url_for('wpmodule/editInLine?property=HoursEstimated&id='.$wpmodule->getId()), array('tooltip'=>__('Click here to edit the estimation of the hours needed'), 'hover'=>'yellow', 'width'=>'100')) ?></li>
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

<?php if($workplan->getSyllabus()->getIsActive()): ?>
<h2><?php echo __('Syllabus links') ?></h2>
<?php include_partial('syllabi/links', array('syllabus'=>$workplan->getSyllabus(), 'wpmodule'=>$wpmodule, 'syllabus_contributions'=>$syllabus_contributions)) ?>
<?php endif ?>


<h2><?php echo __('Actions') ?></h2>
			<ul class="sf_admin_td_actions">
				<li class="sf_admin_action_edit">
				<?php echo link_to(__('Edit heading'), 'wpmodule/editheading?id='.$wpmodule->getId()) ?>
				</li><br />
				<li class="sf_admin_action_back">
				<?php echo link_to(sprintf(__('Back to document «%s»'), $workplan), 'plansandreports/fill?id='.$workplan->getId(). '&ref=wpmodule#modules')  ?>
				</li><br />
	</ul>

