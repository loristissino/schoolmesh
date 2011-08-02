<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'plansandreports/list' => "Manage appointments",
    '_workplan' => $appointment,
    ),
  'current'=> __('Reject document'),
  ))
?>   

<?php include_partial('content/flashes'); ?>

<form action="<?php echo url_for('plansandreports/reject?id='. $workplan->getId() . '&page='. $page) ?>" method="post">

  <table>
    <?php echo $form ?>
	<tr>
      <td colspan="2">
         <input type="submit" name="save" value="<?php echo __('Save') ?>">
      </td>
    </tr>
  </table>
  
</form>

