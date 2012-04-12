<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'users/index' =>__('Users'),
    'users/list' => __('List/Search'),
    'users/edit?id=' . $current_user->getUserId() =>$current_user->getFullname(),
    ),
  'current'=>__('Add appointment')
  ))
?>

<?php include_partial('content/flashes'); ?>

<p><?php echo __('You are going to add an appointment for %user%.', array('%user%'=>$current_user->getFullname())) ?></p>

<form action="<?php echo url_for('users/addappointment?user='. $current_user->getUserId()) ?>" method="post">

  <table>
    <?php echo $form ?>
	<tr>
      <td colspan="2">
         <input type="submit" name="save" value="<?php echo __('Save') ?>">
      </td>
    </tr>
  </table>
  
</form>

