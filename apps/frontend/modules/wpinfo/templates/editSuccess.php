<h1>Edit Wpmoduleitem</h1>
<?php use_helper('Javascript') ?>
<?php use_javascript('tiny_mce/tiny_mce.js') ?>
<?php //include_partial('form', array('form' => $form)) ?>

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

