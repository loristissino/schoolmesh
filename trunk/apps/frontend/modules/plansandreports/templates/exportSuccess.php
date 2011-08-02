<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    '@plansandreports' => "Plans and Reports",
    'plansandreports/fill?id='.$workplan->getId() => $workplan
    ),
  'current'=>__('Export'),
  'title'=>$workplan,
  ))
?>  

<h2><?php echo __("General information") ?></h2>
<ul>
	<li><?php echo __("Teacher: ") . $workplan->getsfGuardUser()->getProfile()->getFullName() ?></li>
	<li><?php echo __("Class: ") . $workplan->getSchoolclass() ?></li>
	<li><?php echo __("Year: ") . $workplan->getYear() ?></li>
</ul>

<?php include_partial('content/flashes'); ?>

<h2><?php echo __('Available formats for export') ?></h2>

<p>
<?php echo __('Data are exported using current template and settings.') ?> 
<?php echo __('If you need the original versione, please use the attachments below.') ?> 
</p>
<?php /* FIXME: I should use a different CSS class in order to avoid <br> tags here... */ ?>
<ul class="sf_admin_actions">
	<li class="sf_admin_action_yaml"><?php echo link_to(__("YAML"), 'plansandreports/view?id='.$workplan->getId().'&sf_format=yaml') ?> <?php echo __('(Useful for personal backup)') ?><br /></li>
	<li class="sf_admin_action_odt"><?php echo link_to(__('OpenOffice.org document'), 'plansandreports/servedoc?id='.$workplan->getId() . '&doctype=odt') ?><br /></li>
<?php if($unoconv_active): ?>
	<li class="sf_admin_action_pdf"><?php echo link_to(__("PDF document"), 'plansandreports/servedoc?id='.$workplan->getId() . '&doctype=pdf')  ?><br /></li>
	<li class="sf_admin_action_doc"><?php echo link_to(__("Microsoft Word document"), 'plansandreports/servedoc?id='.$workplan->getId() . '&doctype=doc') ?><br /></li>
	
<?php endif ?>

</ul>
<?php /*
<h2><?php echo __('Archive as attachment') ?></h2>
<ul class="sf_admin_actions">
	<li class="sf_admin_action_odt"><?php echo link_to(__("OpenOffice.org document"), 'plansandreports/archive?id='.$workplan->getId().'&doctype=odt&complete=false') ?><br /></li>
</ul>

*/ ?>

<?php if(!$unoconv_active): ?>
<p>
<?php echo __('The OpenOffice converter is not currently active.') ?> 
<?php echo __('Please try again in a few minutes.') ?>
</p>

<?php endif ?>

<?php include_partial('content/attachments', array('attachments'=>$attachments, 'description'=>'Documents concerning this appointment.')) ?>