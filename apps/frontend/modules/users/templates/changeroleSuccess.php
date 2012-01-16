<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'users/edit?id='.$current_user->getUserId()=>$current_user->__toString(),
    '_team'=>$team->__toString(),
    ),
  'current'=>__('Role change'),
  ))
?>

<?php include_partial('content/flashes'); ?>


<p><?php echo __('You are changing the role of user %user%.', array('%user%'=>$current_user->getFullname())) ?></p>

<form action="<?php echo url_for('users/changerole') ?>" method="post">

  <table>
	<tr>
		<th><label><?php echo __('Team') ?></label></th>
		<td>
			<?php echo $team ?>
		</td>
	</tr>
    <?php echo $form ?>
	<tr>
      <td colspan="2">
         <input type="submit" name="save" value="<?php echo __('Save') ?>">
      </td>
    </tr>
  </table>
  
</form>

