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

<?php /* FIXME: I should use a different CSS class in order to avoid <br> tags here... */ ?>
<ul class="sf_admin_actions">
	<li class="sf_admin_action_yaml"><?php echo link_to(__("YAML"), 'plansandreports/view?id='.$workplan->getId().'&sf_format=yaml') ?><br /></li>
	<li class="sf_admin_action_openoffice"><?php echo link_to(__("OpenOffice.org Document"), 'plansandreports/odt?id='.$workplan->getId()) ?> (experimental)<br /></li>
	<li class="sf_admin_action_word"><?php echo link_to(__("Microsoft Word Document"), 'plansandreports/doc?id='.$workplan->getId()) ?> (experimental)<br /></li>
	<li class="sf_admin_action_rtf"><?php echo link_to(__("Rich Text Format"), 'plansandreports/view?id='.$workplan->getId().'&sf_format=rtf') ?> (experimental)<br /></li>
	<li class="sf_admin_action_pdf"><?php echo link_to(__("PDF"), 'plansandreports/view?id='.$workplan->getId().'&sf_format=pdf') ?> (experimental)<br /></li>
</ul>
