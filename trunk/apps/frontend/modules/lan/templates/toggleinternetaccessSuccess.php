<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'workstations/index' => __("Workstations"),
    '_workstation' => $Workstation->getName(),
    ),
  'current'=>__('Toggle Internet access')
    )
  )
?>

<?php include_partial('content/flashes'); ?>

<form action="<?php echo url_for('workstations/toggleinternetaccess?id='. $Workstation->getId()) ?>" method="POST">

  <table>
    <?php echo $form ?>
	<tr>
      <td colspan="2">
         <input type="submit" name="save" value="<?php echo __('Save') ?>">
      </td>
    </tr>
  </table>
</form>

