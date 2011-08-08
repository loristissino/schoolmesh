<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    '_users' => __("User's settings"),
    '_passwordreset' => __("Password reset")
    ),
  'current'=>__("Password reset confirmation")
  ))
?>

<?php include_partial('content/flashes'); ?>

  <table>
	<tr>
      <th><label><?php echo __('Username') ?></label></th>
	  <td>
		<?php echo $username ?>
      </td>
    </tr>
	<tr>
      <th><label><?php echo __('Account') ?></label></th>
	  <td>
		<?php echo $account ?>
      </td>
    </tr>
	<tr>
      <th><label><?php echo __('Temporary password') ?></label></th>
	  <td>
		<?php echo $password ?>
      </td>
    </tr>
  
  </table>

<hr />

<p><?php echo link_to(
	'Homepage',
	'@homepage'
	)
	?></p>