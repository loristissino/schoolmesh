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
<?php echo __('If you need the original version, please use the attachments below.') ?> 
</p>
<?php /* FIXME: I should use a different CSS class in order to avoid <br> tags here... */ ?>
<ul class="sf_admin_actions">
	<?php /* we should update this
  <li class="sf_admin_action_yaml"><?php echo link_to(__("YAML"), 'plansandreports/view?id='.$workplan->getId().'&sf_format=yaml') ?> <?php echo __('(Useful for personal backup)') ?><br /></li>
  */ ?>
<?php echo export_action_links($sf_user, 'plansandreports/servedoc?id='.$workplan->getId(), $sf_context) ?>
</ul>

<?php include_partial('content/attachments', array('attachments'=>$attachments, 'description'=>'Documents concerning this appointment.')) ?>
