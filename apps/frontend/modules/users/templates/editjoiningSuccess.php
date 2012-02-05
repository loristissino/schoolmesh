<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'users/edit?id='.$current_user->getUserId()=>$current_user->__toString(),
    'teams/show?id=' . $team->getId() => $team->__toString(),
    ),
  'current'=>__('Joining change'),
  'title'=>__('Team joining change'),
  ))
?>

<?php include_partial('content/flashes'); ?>

<p><?php echo __('You are changing the joining of user %user% to team «%team%».', array('%user%'=>$current_user->getFullname(), '%team%'=>$team->__toString())) ?></p>

<form action="<?php echo url_for('users/editjoining?referer='.Generic::b64_serialize($referer)) ?>" method="post">

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

