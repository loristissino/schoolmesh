<?php use_javascript('jquery.jeditable.mini.js') ?>

<?php slot('title', $schoolclass_id) ?>
<?php slot('breadcrumbs',
	link_to(__('Classes'), 'schoolclasses/index') . ' » ' . 
	$schoolclass_id
	)
	
	?>
	<h1><?php echo __('Observation grid for «%subject%» (class %class%)', array('%subject%'=>$appointment->getSubject()->getDescription(), '%class%'=>$schoolclass_id)) ?></h1>
	<h2><?php echo $term->getDescription() ?></h2>
	

<?php $nb_cols=sizeof($students) +1 ?>

<?php $wpmodule_nb=0 ?>
<?php foreach($appointment->getWpmodules() as $wpmodule): ?>
<table width="100%">
<tr>
	<td colspan="2">
		<h2><?php echo ++$wpmodule_nb ?>. <?php echo $wpmodule->getTitle() ?></h2>
		<p><?php echo $wpmodule->getPeriod() ?></p>
	</td>
	<td></td>

<?php include_partial('students', array('students'=>$students)) ?>

</tr>
<?php foreach($wpmodule->getWpitemGroups() as $wpitem_group): ?>
		<?php if($wpitem_group->getWpItemType()->getEvaluationMin()>0): ?>
		<tr>
	<td colspan="3">
			<h3><?php echo $wpitem_group->getWpItemType()->getTitle() ?></h3>
	</td>
	<td colspan="<?php echo $nb_cols ?>">
</tr>

		<?php foreach($wpitem_group->getWpmoduleItems() as $wpmodule_item): ?>
			<tr id="<?php echo 'ticks_' . $wpmodule_item->getId() ?>">
				<?php include_partial('wpmoduleitem', array('students'=>$students, 'wpmodule_item'=>$wpmodule_item, 'term_id'=>$term_id, 'evaluation_min'=>$wpitem_group->getWpItemType()->getEvaluationMin())) ?>
			</tr>
		<?php endforeach ?>

		<?php endif ?>
	<?php endforeach ?>
</table>
<?php endforeach ?>

<hr />

<table width="100%">
<tr>
	<th colspan="2">
		<h2><?php echo __('Knowledge and skills from the Syllabus') ?></h2>
	</th>
<?php include_partial('students', array('students'=>$students)) ?>

</tr>
<?php foreach($syllabusitems as $syllabusitem): ?>
<tr id="syllabusitem_<?php echo $syllabusitem->getId()?>">
	<?php include_partial('syllabusitem', array('students'=>$students, 'appointment_id'=>$appointment->getId(),'syllabusitem'=>$syllabusitem,  'term_id'=>$term_id)) ?>
</tr>
<?php endforeach ?>
</table>

<hr />

<table width="100%">
<tr>
	<th colspan="2">
		<h2><?php echo __('Suggested modalities for recuperation') ?></h2>
	</th>
<?php include_partial('students', array('students'=>$students)) ?>

</tr>

<?php foreach($suggestions as $suggestion): ?>
<tr id="suggestion_<?php echo $suggestion->getId()?>">
	<?php include_partial('suggestion', array('students'=>$students, 'appointment_id'=>$appointment->getId(),'suggestion'=>$suggestion,  'term_id'=>$term_id)) ?>
</tr>
<?php endforeach ?>

</table>

<hr />
<a name="hints"></a>
<?php if ($sf_user->hasFlash('notice_hints')): ?>
  <div class="notice"><?php echo $sf_user->getFlash('notice_hints')?></div>
<?php endif; ?>
<table width="100%">
<tr>
	<th colspan="2">
		<h2><?php echo __('Hints') ?></h2>
	</th>
<?php include_partial('students', array('students'=>$students)) ?>

</tr>

<?php foreach($hints as $hint): ?>
<tr id="hint_<?php echo $hint->getId()?>">
	<?php include_partial('hint', array('students'=>$students, 'appointment_id'=>$appointment->getId(),'hint'=>$hint, 'term_id'=>$term_id)) ?>
</tr>
<?php endforeach ?>

</table>
<ul class="sf_admin_actions">
	<li class="sf_admin_action_new">
	<?php echo link_to(
		__('New'),
		url_for('schoolclasses/addhint'),
		array('method'=>'POST', 'title'=>__('Add a new hint')) 
	)?>
	</li>
</ul>

<hr />
<h2><?php echo __('Actions') ?></h2>
<ul class="sf_admin_actions">
	<li class="sf_admin_action_export">
	<?php echo link_to(
		__('Get recuperation letters'),
		url_for('schoolclasses/getrecuperationletters?id=' . $schoolclass_id . '&appointment=' . $appointment->getId()),
		array('title'=>__('Get recuperation letters')) 
	)?>
	</li>
</ul>
