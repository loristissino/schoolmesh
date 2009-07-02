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
<?php if($next_item): ?>
	<input type="submit" name="continue" value="<?php echo sprintf(__('Save and go to next item (%s)'), $next_item->getWpinfoType()->getTitle()); ?>" />
<?php endif; ?>
</form>

<h2><?php echo __('Hints') ?></h2>
	<ul class="sf_admin_actions">
	<li class="sf_admin_action_toggle">
<?php echo link_to_function(
  __('Toggle'),
  visual_effect('toggle_blind', 'hints')
) ?>
</li>
</ul>
<div id="hints" style="display:visible">
<?php if(sizeof($hints)>0): ?>
<p><strong><?php echo __('The following sentences were used in other workplans:'); ?></strong></p>
<?php $previous=''; ?>
<?php foreach($hints as $hint): ?>
	<?php if($hint->getContent()!=$previous): ?>
	<blockquote><?php echo html_entity_decode($hint->getContent()); ?></blockquote>
	<?php $previous=$hint->getContent(); ?>
	<?php endif; ?>
	<p>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo image_tag('source') ?><em>&nbsp;<?php echo sprintf(__('Used in «%s»'), $hint->getAppointment()); ?></em></p>
<?php endforeach; ?>

<?php else: ?>
<p><?php echo __('No hints avaliable for this item.') ?></p>
<?php endif; ?>
</div>

<h2><?php echo __('Example') ?></h2>
	<ul class="sf_admin_actions">
	<li class="sf_admin_action_toggle">
<?php echo link_to_function(
  __('Toggle'),
  visual_effect('toggle_blind', 'example')
) ?>
</li>
</ul>
<div id="example" style="display:none">
<?php if($example): ?>
<p><strong><?php echo __('You can base your text on the following example:'); ?></strong></p>

<blockquote><?php echo html_entity_decode($example); ?></blockquote>
<?php else: ?>
<p><?php echo __('No example avaliable for this item.') ?></p>
<?php endif; ?>
</div>


</div>