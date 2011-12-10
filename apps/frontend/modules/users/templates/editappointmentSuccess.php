<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'users/index' =>__('Users'),
    'users/list' => __('List/Search'),
    'users/edit?id=' . $current_user->getUserId() => $current_user->getFullname(),
    ),
  'current'=>__('Edit appointment'),
  ))
?>

<?php include_partial('content/flashes'); ?>

<form action="<?php echo url_for('users/editappointment?id='. $appointment->getId()) ?>" method="post">

  <table>
    <?php echo $form ?>
	<tr>
      <td colspan="2">
         <input type="submit" name="save" value="<?php echo __('Save') ?>">
      </td>
    </tr>
  </table>
  
</form>

