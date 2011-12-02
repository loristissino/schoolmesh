<?php //use_javascripts_for_form($form) ?>

<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'users/index' => __("Users"),
    ),
  'current'=>__('Add to a team')
    )
  )
?>

<?php include_partial('content/flashes'); ?>

<p>
  <?php echo __('Choose the team to add these users to:') ?>
</p>

<?php include_partial('userlist', array('userlist'=>$userlist)) ?>

<form action="<?php echo url_for('users/confirmadduserstoteam?ids=' . $sf_request->getParameter('ids')) ?>" method="POST">

  <table>
    <?php echo $form ?>
	<tr>
      <td colspan="2">
         <input type="submit" name="save" value="<?php echo __('Add') ?>">
      </td>
    </tr>
  </table>
</form>
