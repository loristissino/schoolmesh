<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'lan/index' => __("Local Area Network"),
    '_subnet' => $currentsubnet->getName(),
    ),
  'current'=>__('Schedule web access'),
  'title'=>__('Web access scheduling for subnet «%name%»', array('%name%'=>$currentsubnet->getName())),
    )
  )
?>

<?php include_partial('content/flashes'); ?>

<p><?php echo __('You are scheduling web access for the following workstations:') ?></p>
<?php include_partial('workstations', array('Workstations'=>$Workstations)) ?>

<form action="<?php echo url_for('lan/scheduleinternetaccess') ?>" method="POST">

  <table>
    <?php echo $form ?>
	<tr>
      <td colspan="2">
         <input type="submit" name="save" value="<?php echo __('Schedule') ?>">
      </td>
    </tr>
  </table>
</form>

