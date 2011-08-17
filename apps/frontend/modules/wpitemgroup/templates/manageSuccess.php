<?php use_javascript('tiny_mce/tiny_mce.js') ?>
  
<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    '@plansandreports' => "Plans and Reports",
    'plansandreports/fill?id='.$wp->getId() => $wp->__toString(),
    'wpmodule/view?id='.$wpmodule->getId() => $wpmodule->getTitle()
    ),
  'current'=>$wpitemType->getTitle(),
  
  ))
?>

<div id="sf_admin_container">
<?php if ($sf_user->hasFlash('error_info')): ?>
  <div class="error"><?php echo $sf_user->getFlash('error_info')?></div>
<?php endif; ?>
<?php if ($sf_user->hasFlash('notice_info')): ?>
  <div class="notice"><?php echo $sf_user->getFlash('notice_info')?></div>
<?php endif; ?>
<p><?php echo __('Here you can manage all the items of this group as a list of paragraphs (this could be useful for copy&paste operations from legacy documents).') ?>
<form action="<?php echo url_for('wpitemgroup/update?id='.$wpitemGroup->getId()) ?>" method="POST" id="editform">

<?php echo javascripttag("
tinyMCE.init({

mode : \"textareas\",

language: \"it\",

entity_encoding : \"raw\",

theme : \"advanced\",

editor_selector : \"mceAdvanced\"

});
") ?>
</script>
<textarea name="value" class="mceAdvanced" style="width:100%" rows="20">
<?php echo $wpitemGroup->getContent() ?>
</textarea>

<h2><?php echo __('Actions') ?></h2>

<ul class="sf_admin_actions">
	<li class="sf_admin_action_saveandback">
	<a href="<?php echo url_for('wpmodule/view?id='.$wpitemGroup->getWpmodule()->getId()) ?>" 
		onClick="var f = document.getElementById('editform'); var m = document.createElement('input'); m.setAttribute('type', 'hidden'); m.setAttribute('name', 'save'); m.setAttribute('value', 'save'); f.appendChild(m); f.submit(); return false;"
		title="<?php echo __('Save these items and go back to the module') ?>"
	><?php echo __("Save and go back to the module") ?></a>
	</li>
</ul>

</form>

</div>