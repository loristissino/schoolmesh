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

<?php include_partial('content/flashes'); ?>

<h2><?php echo __('Available formats for export') ?></h2>
<?php /* FIXME: I should use a different CSS class in order to avoid <br> tags here... */ ?>
<ul class="sf_admin_actions">
	<li class="sf_admin_action_yaml"><?php echo link_to(__("YAML"), 'plansandreports/view?id='.$workplan->getId().'&sf_format=yaml') ?> <?php echo __('(Useful for personal backup)') ?><br /></li>
	<li class="sf_admin_action_openoffice"><?php echo link_to(__("OpenOffice.org document"), 'plansandreports/odt?id='.$workplan->getId()) ?> (old way -- deprecated!!)<br /></li>	
	<li class="sf_admin_action_openoffice"><?php echo link_to(__('OpenOffice.org document'), 'plansandreports/servedoc?id='.$workplan->getId() . '&doctype=odt') ?><br /></li>
<?php if($unoconv_active): ?>
	<li class="sf_admin_action_pdf"><?php echo link_to(__("PDF document"), 'plansandreports/servedoc?id='.$workplan->getId() . '&doctype=pdf')  ?><br /></li>
	<li class="sf_admin_action_word"><?php echo link_to(__("Microsoft Word document"), 'plansandreports/servedoc?id='.$workplan->getId() . '&doctype=doc') ?><br /></li>
	
<?php endif ?>

</ul>

<?php if(!$unoconv_active): ?>
<p>
<?php echo __('The OpenOffice converter is not currently active.') ?> 
<?php echo __('Please try again in a few minutes.') ?>
</p>

<?php endif ?>