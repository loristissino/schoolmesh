<?php use_helper('Javascript') ?>
<?php use_javascript('tiny_mce/tiny_mce.js') ?>
<?php slot('breadcrumbs',
	link_to(__("Plans and Reports"), "@plansandreports") . ' » ' . 
	link_to($wpinfo->getAppointment()->__toString(), 'plansandreports/fill?id='.$wpinfo->getAppointment()->getId()) . ' » ' . 
	link_to($type->getTitle(), 'wpinfo/edit?id='.$wpinfo->getId())
	)
	
	?>

<h1><?php echo __('Edit Wpinfo') ?></h1>
<h2><?php echo $type->getTitle() ?></h2>
<p><?php echo $type->getDescription() ?></p>
<div id="sf_admin_container">
<?php if ($sf_user->hasFlash('error_info')): ?>
  <div class="error"><?php echo $sf_user->getFlash('error_info')?></div>
<?php endif; ?>
<form action="<?php echo url_for('wpinfo/update?id='.$wpinfo->getId()) ?>" method="POST">

<?php echo javascript_tag("
tinyMCE.init({

mode : \"textareas\",

language: \"it\",

entity_encoding : \"raw\",

theme : \"advanced\",

editor_selector : \"mceAdvanced\"

});
") ?>
</script>
<textarea name="value" class="mceAdvanced" style="width:100%">
<?php echo $wpinfo->getContent() ?>
</textarea>
<br />
<input type="submit" name="save" value="<?php echo __("Save and go back to workplan") ?>" />
<?php if($wpinfo->getNext()): ?>
	<input type="submit" name="continue" value="<?php echo sprintf(__('Save and go to next item (%s)'), $wpinfo->getNext()->getWpinfoType()->getTitle()); ?>" />
<?php endif; ?>
</form>

</div>


<h2><?php echo __('Hints') ?></h2>
<div id="sf_admin_container">
	<ul class="sf_admin_actions">
	<li class="sf_admin_action_toggle">
<?php echo link_to_function(
  __('Toggle'),
  visual_effect('toggle_blind', 'hints')
) ?>
</li>
</ul>
</div>
<div id="hints" style="display:none">
<p><strong><?php echo __('The following sentences were used in other workplans:'); ?></strong></p>
<?php $previous=''; ?>
<?php foreach($hints as $hint): ?>
	<?php if($hint->getContent()!=$previous): ?>
	<blockquote><?php echo html_entity_decode($hint->getContent()); ?></blockquote>
	<?php $previous=$hint->getContent(); ?>
	<?php endif; ?>
	<p>	<?php echo image_tag('source') ?><em>&nbsp;<?php echo sprintf(__('Used in «%s»'), $hint->getAppointment()); ?></em></p>
<?php endforeach; ?>

</div>
