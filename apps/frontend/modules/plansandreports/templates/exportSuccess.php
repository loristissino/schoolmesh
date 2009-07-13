<?php slot('title', sprintf('%s --  %s', $workplan->__toString(),$workplan->getsfGuardUser()->getProfile()->getFullName() )) ?>
<?php slot('breadcrumbs',
	link_to(__("Plans and Reports"), "@plansandreports") . ' » ' . 
	link_to($workplan, 'plansandreports/fill?id='.$workplan->getId()) . ' » ' .
	__('Export')
	)
	
	?><h1><?php echo __("Workplan: ") . $workplan ?></h1>

<h2><?php echo __("General information") ?></h2>
<ul>
	<li><?php echo __("Teacher: ") . $workplan->getsfGuardUser()->getProfile()->getFullName() ?></li>
	<li><?php echo __("Class: ") . $workplan->getSchoolclass() ?></li>
	<li><?php echo __("Year: ") . $workplan->getYear() ?></li>
</ul>

<h2><?php echo __('Available formats for export') ?></h2>

<ul>
	<li><?php echo link_to(__("YAML"), 'plansandreports/view?id='.$workplan->getId().'&sf_format=yaml') ?></li>
	<li><?php echo link_to(__("ODT"), 'plansandreports/odt?id='.$workplan->getId()) ?> (experimental)</li>
	<li><?php echo link_to(__("DOC"), 'plansandreports/doc?id='.$workplan->getId()) ?> (experimental)</li>
	<li><?php echo link_to(__("RTF"), 'plansandreports/view?id='.$workplan->getId().'&sf_format=rtf') ?> (experimental)</li>
	<li><?php echo link_to(__("PDF"), 'plansandreports/view?id='.$workplan->getId().'&sf_format=pdf') ?> (experimental)</li>
</ul>
