<?php use_helper('Javascript') ?>
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

<form action="<?php echo url_for('wpmoduleitem/update?id='.$wpmodule_item->getId()) ?>" method="POST">

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
<br />
<input type="submit" name="submit" value="<?php echo __("Save") ?>" /> 
</form>
