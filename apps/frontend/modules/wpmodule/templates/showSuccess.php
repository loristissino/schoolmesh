<?php slot('title', sprintf('%s --  %s', $wpmodule->getTitle(), $owner->getFullName())) ?>
<?php slot('breadcrumbs',
	link_to(__("Plans and Reports"), "@plansandreports") . ' » ' . 
	__('Workplan module import') . ' » ' .
	$wpmodule->getTitle()
	)
	
	?>
<h1><?php echo __('Module: ') . $wpmodule->getTitle() ?></h1>

<div id="sf_admin_container">

<ul>
<li><?php echo __('Teacher: ') ?><strong><?php echo $owner->getFullName() ?></strong></li>
<?php /*

<li><?php echo __('Workplan / Report: ') ?><strong><?php echo link_to($workplan, 'plansandreports/fill?id='.$workplan->getId()) ?></strong></li>
*/ ?>
<li><?php echo __('Period: ') ?>
<strong><?php echo $wpmodule->getPeriod() ?></strong></li>
</ul>

<?php include_partial('wpmodule_shown', array('wpmodule' => $wpmodule, 'state'=>Workflow::WP_DRAFT)) ?>

</div>