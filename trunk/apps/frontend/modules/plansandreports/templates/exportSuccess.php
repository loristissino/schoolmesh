<?php if($breadcrumpstype=='plansandreport/appointment/export'): ?>
<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    '@plansandreports' => __('Plans and Reports'),
    'plansandreports/fill?id='.$workplan->getId() => $workplan
    ),
  'current'=>__('Export'),
  'title'=>$workplan,
  ))
?>  
<?php endif ?>
<?php if($breadcrumpstype=='plansandreports/list/appointment/export'): ?>
<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'plansandreports/list' => __('Plans and Reports'),
    '_plansandreports/' => $workplan
    ),
  'current'=>__('Export'),
  'title'=>$workplan,
  ))
?>  
<?php endif ?>



<h2><?php echo __("General information") ?></h2>
<ul>
	<li><?php echo __("Teacher: ") . $workplan->getsfGuardUser()->getProfile()->getFullName() ?></li>
	<li><?php echo __("Class: ") . $workplan->getSchoolclass() ?></li>
	<li><?php echo __("Year: ") . $workplan->getYear() ?></li>
</ul>

<?php include_partial('content/flashes'); ?>

<h2><?php echo __('Export this document using current data') ?></h2>
<?php if($workplan->isExportableBy($sf_user->getProfile()->getUserId()) or $sf_user->hasCredential('backadmin')): ?>
<form action="<?php echo url_for('plansandreports/servedoc?id='.$workplan->getId()) ?>" method="get">
<table>
<?php echo $form ?>
<td colspan="2" style="text-align:right">
  <input type="submit" name="export" value="<?php echo __('Export') ?>">
</td>
</table>
</form>

<p>
<?php echo __('The document is exported using current data, template and settings.') ?> 
<?php echo __('If you need the document originally submitted, please download one of the attachments below.') ?> 
</p>
<?php else: ?>
<p><?php echo __('This document is currently exportable only by the owner.') ?></p>
<?php endif ?>


<?php include_partial('content/attachments', array('attachments'=>$attachments, 'description'=>'Download one of the documents concerning this appointment.')) ?>
