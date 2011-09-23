<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'lan/index' => __("Local Area Network"),
    '_subnet' => $currentsubnet->getName(),
    ),
  'current'=>__('Schedule Internet access'),
  'title'=>__('Internet access schedule for subnet «%name%»', array('%name%'=>$currentsubnet->getName())),
    )
  )
?>

<?php include_partial('content/flashes'); ?>

<p><?php echo __('You are scheduling Internet access for the following workstations:') ?></p>
<ul>
  <?php foreach($Workstations as $Workstation): ?>
    <li><?php echo $Workstation->getName() ?></li>
  <?php endforeach ?>
</ul>

<form action="<?php echo url_for('lan/scheduleinternetaccess') ?>" method="POST">

  <table>
    <?php echo $form ?>
	<tr>
      <td colspan="2">
         <input type="submit" name="save" value="<?php echo __('Save') ?>">
      </td>
    </tr>
  </table>
</form>

