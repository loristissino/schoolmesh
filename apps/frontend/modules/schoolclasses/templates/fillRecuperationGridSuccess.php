<?php use_helper('Javascript') ?>
<?php use_helper('Form') ?>
<?php use_helper('Object') ?>
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
<?php foreach($students as $student): ?>
	<td width="10"><?php echo image_tag(sfConfig::get('app_config_base_url').'/vertical.php?text='. urlencode($student->getProfile()->getFullName(20)) .
	'&backcolor=255-255-255&textcolor=0-0-0',
			array(
				'alt' => $student->getProfile()->getFullName(),
				'title' => $student->getProfile()->getFullName())
				)
			?></td>
<?php endforeach ?>
	<td width="10"><?php echo image_tag(sfConfig::get('app_config_base_url').'/vertical.php?text='. __('All selected students') . '&backcolor=0-0-0&textcolor=255-255-63', 
			array(
				'alt' => __('All students'),
				'title' => __('All students'))
				)
			?>
	</td>

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
				<?php include_partial('wpmoduleitem', array('students'=>$students, 'ids'=>$ids, 'wpmodule_item'=>$wpmodule_item, 'term_id'=>$term_id)) ?>
			</tr>
		<?php endforeach ?>

		<?php endif ?>
	<?php endforeach ?>
</table>
<?php endforeach ?>


<hr>

<table width="100%">
<tr>
	<th colspan="2">
		<h2><?php echo __('Suggestions') ?></h2>
	</th>
<?php foreach($students as $student): ?>
	<td width="10"><?php echo image_tag(sfConfig::get('app_config_base_url').'/vertical.php?text='. urlencode($student->getProfile()->getFullName(20)) .
	'&backcolor=255-255-255&textcolor=0-0-0',
			array(
				'alt' => $student->getProfile()->getFullName(),
				'title' => $student->getProfile()->getFullName())
				)
			?></td>
<?php endforeach ?>
	<td width="10"><?php echo image_tag(sfConfig::get('app_config_base_url').'/vertical.php?text='. __('All selected students') . '&backcolor=0-0-0&textcolor=255-255-63', 
			array(
				'alt' => __('All students'),
				'title' => __('All students'))
				)
			?>
	</td>

</tr>

<?php foreach($suggestions as $suggestion): ?>
<tr id="suggestion_<?php echo $suggestion->getId()?>">
	<?php include_partial('suggestion', array('students'=>$students, 'appointment_id'=>$appointment->getId(),'suggestion'=>$suggestion, 'ids'=>$ids, 'term_id'=>$term_id)) ?>
</tr>
<?php endforeach ?>

</table>

