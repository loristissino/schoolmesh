<?php if($sf_user->getProfile()->getPrefersRichtext()): ?>
  <?php use_javascript('tiny_mce/tiny_mce.js') ?>
<?php endif ?>
<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    '@plansandreports' => "Plans and Reports",
    'plansandreports/fill?id='.$wp->getId() => $wp,
    'wpmodule/view?id='.$wpmodule->getId() => $wpmodule->getTitle(),
    '_1' => $wpitemType->getTitle()
    ),
  'current'=>__('Item # %itemnumber%', array('%itemnumber%' => $wpmodule_item->getRank())),
  'title'=>$wp . ' -- ' . $wpmodule->getTitle(),
  ))
?>    

<?php include_partial('content/flashes'); ?>

<form action="<?php echo url_for('wpmoduleitem/update?id='.$wpmodule_item->getId()) ?>" method="POST" id="editform">

<?php if($sf_user->getProfile()->getPrefersRichtext()): ?>

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
<?php endif ?>

<textarea name="value" class="mceAdvanced" style="width:100%" rows="2" cols="80">
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
  <?php if($sf_user->hasFlash('quick')): // we have this link only once, so that we do not have to care about saving... ?>
  <br /><li class="sf_admin_action_items">
    <?php echo link_to(
      __('Quick list edit'), 'wpitemgroup/manage?id=' .$wpmodule_item->getWpitemgroup()->getId()
      )
    ?>
    </li>
  <?php endif ?>
</ul>

<?php /*<input type="submit" name="submit" value="<?php echo __("Save") ?>" /> */ ?>
</form>
