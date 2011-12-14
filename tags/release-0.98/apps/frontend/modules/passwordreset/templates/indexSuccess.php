<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    '_users' => __("User's settings"),
    ),
  'current'=>__("Password reset")
  ))
?>

<p><?php echo __('This page is for resetting the password of the students that might have forgot it.') ?></p>
<p><?php echo __('Teachers\'s and staff\'s passwords can be reset only by an administrator.') ?></p>

<?php include_partial('content/flashes'); ?>

<form action="<?php echo url_for('passwordreset/confirm') ?>" method="get">

  <table>
    <?php echo $form ?>
	<tr>
      <td colspan="2">
         <input type="submit" name="choose" value="<?php echo __('Choose') ?>">
      </td>
    </tr>
  </table>

