<form action="<?php echo url_for('filebrowser/upload') ?>" method="POST" enctype="multipart/form-data">

  <table>
    <?php echo $form ?>
	<tr>
      <td colspan="2">
         <input type="submit" name="save" value="<?php echo __('Upload') ?>">
      </td>
    </tr>
  </table>
</form>

