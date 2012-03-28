<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    '_users' => __("Users' settings"),
    '_passwordreset' => __("Password reset")
    ),
  'current'=>__("Confirm password reset")
  ))
?>

<?php include_partial('content/flashes'); ?>

<p>
<strong>
<?php echo __('You are about to reset the password for this account.') ?>
</strong> 
</p>
<p>
         <?php echo __('Is it OK to proceed?') ?>
</p>

<form action="<?php echo url_for('passwordreset/confirm') ?>" method="post">

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
  
    <?php echo $form ?>
	<tr>
      <td colspan="2">
         <input type="submit" name="Confirm" value="<?php echo __('Confirm') ?>">
		<?php echo link_to(
			__('Cancel'),
			$referer
			);
		?>
      </td>
    </tr>
  </table>


