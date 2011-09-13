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

<ul class="sf_admin_actions">
	<li class="sf_admin_action_toggle">
<?php echo jq_link_to_function(
  __('Toggle'),
  jq_visual_effect('slideToggle', '#syllabus'), array(__('Hide'))
) ?>
</li>
</ul>

<div id="syllabus" style="display: <?php echo $syllabusview=='tree'? 'visible': 'none' ?>">

<?php include_partial('syllabi/links_' . $syllabusview, array('syllabus'=>$workplan->getSyllabus(), 'wpmodule'=>$wpmodule, 'syllabus_contributions'=>$syllabus_contributions, 'syllabusview'=>$syllabusview)) ?>

<ul class="sf_admin_actions">
<?php if($syllabusview=='table'): ?>
	<li class="sf_admin_action_treeview">
<?php echo link_to(
  __('Tree view'),
  url_for('wpmodule/view?id=' . $wpmodule->getId() . '&syllabusview=tree'),
  array('title'=>__('Show syllabus links in a tree'))
  )
 ?>
</li>
<?php endif ?>
<?php if($syllabusview=='tree'): ?>
	<li class="sf_admin_action_tableview">
<?php echo link_to(
  __('Table view'),
  url_for('wpmodule/view?id=' . $wpmodule->getId() . '&syllabusview=table'),
  array('title'=>__('Show syllabus links in a table'))

  )
 ?>
</li>
<?php endif ?>
</ul>

</div>


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

