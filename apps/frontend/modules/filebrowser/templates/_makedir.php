<form action="<?php echo url_for('filebrowser/makedir') ?>" method="POST">

  <table>
    <?php echo $form ?>
	<tr>
      <td colspan="2">
         <input type="submit" name="save" value="<?php echo __('Create directory') ?>">
      </td>
    </tr>
  </table>
</form>

