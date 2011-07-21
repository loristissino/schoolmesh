<?php slot('title', __('User management')) ?>
<?php slot('breadcrumbs', 'TODO'
	)
	
	?><h1><?php echo __('Add event')?></h1>

<?php include_partial('content/flashes'); ?>

<form action="<?php echo url_for('plansandreports/addwpevent?appointment='. $appointment->getId()) ?>" method="post">

  <table>
    <?php echo $form ?>
	<tr>
      <td colspan="2">
         <input type="submit" name="save" value="<?php echo __('Save') ?>">
      </td>
    </tr>
  </table>
  
</form>

