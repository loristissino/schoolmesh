<h1><?php echo __('Edit Wpinfo') ?></h1>
<?php use_helper('Javascript') ?>
<?php use_javascript('tiny_mce/tiny_mce.js') ?>
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
<input type="submit" name="submit" value="<?php echo __("Save") ?>" />
</form>

</div>
<?php /*
<form action="<?php echo url_for('wpmoduleitem/update?id='.$form->getObject()->getId()) ?>" method="POST">
          <table>
            <?php echo $form ?>
            <tr>
              <td colspan="2">
                 <input type="submit" />
              </td>
            </tr>
          </table>
</form>
*/ ?>

