<?php use_javascript('tiny_mce/tiny_mce.js') ?>
<?php slot('breadcrumbs',
	link_to(__("Plans and Reports"), "@plansandreports") . ' » ' . 
	link_to($wp->__toString(), 'plansandreports/fill?id='.$wp->getId()) . ' » ' . 
	link_to($wpmodule->getTitle(), 'wpmodule/view?id='.$wpmodule->getId()) . ' » ' .
	$wpitemType->getTitle() . ' » ' .
	sprintf(__('Item # %d'), $wpmodule_item->getRank())
	)
	
	?>

<h1><?php echo $wpmodule->getTitle() ?></h1>
<h2><?php echo $wpitemType->getTitle() ?></h2>

<form action="<?php echo url_for('wpmoduleitem/update?id='.$wpmodule_item->getId()) ?>" method="POST" id="editform">

<?php echo javascript_tag("
tinyMCE.init({

mode : \"textareas\",

language: \"it\",

entity_encoding : \"raw\",

theme : \"advanced\",

editor_selector : \"mceAdvanced\"

});
") ?>
<textarea name="value" class="mceAdvanced" style="width:100%">
<?php echo $wpmodule_item->getContent() ?>
</textarea>

<h2><?php echo __('Actions') ?></h2>

<ul class="sf_admin_actions">
	<li class="sf_admin_action_saveandback">
	<a href="<?php echo url_for('wpmodule/view?id='.$wpmodule_item->getWpitemgroup()->getWpmodule()->getId()) ?>" 
		onClick="var f = document.getElementById('editform'); var m = document.createElement('input'); m.setAttribute('type', 'hidden'); m.setAttribute('name', 'save'); m.setAttribute('value', 'save'); f.appendChild(m); f.submit(); return false;"
		title="<?php echo __('Save this content and go back to the module') ?>"
	><?php echo __("Save and go back to the module") ?></a>
	</li>
</ul>

<?php /*<input type="submit" name="submit" value="<?php echo __("Save") ?>" /> */ ?>
</form>
