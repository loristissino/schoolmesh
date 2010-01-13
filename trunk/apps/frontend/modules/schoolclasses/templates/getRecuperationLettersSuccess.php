<?php use_helper('Javascript') ?>
<?php use_helper('Form') ?>
<?php use_helper('Object') ?>
<?php slot('title', $schoolclass_id) ?>
<?php slot('breadcrumbs',
	link_to(__('Classes'), 'schoolclasses/index') . ' » ' . 
	$schoolclass_id
	)
	
	?>
	<h1><?php echo __('Recuperation letters for «%subject%» (class %class%)', array('%subject%'=>$appointment->getSubject()->getDescription(), '%class%'=>$schoolclass_id)) ?></h1>
	<h2><?php echo $term->getDescription() ?></h2>

<?php 
	$formats=array(
	'odt'=>__('OpenOffice.org document'),
	'pdf'=>__('PDF document'),
	'doc'=>__('Microsoft Word document'),
	);
	$baseurl=
		'schoolclasses/getRecuperationLetters?id=' . $schoolclass_id
		. '&appointment=' . $appointment->getId()
		. '&doctype=';
?>

<ul class="sf_admin_actions">

<?php foreach($formats as $fname=>$fdescription): ?>
	<li class="sf_admin_action_<?php echo $fname ?>">
	<?php echo link_to($fdescription, url_for($baseurl . $fname)) ?>
	<br />
	</li>
<?php endforeach ?>
</ul>

