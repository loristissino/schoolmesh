<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    '_users' => __("Users' settings"),
    ),
  'current'=>__("Password reset")
  ))
?>

<p><?php echo __('In this page you can reset the password of the students that might have forgot it.') ?></p>
<p><?php echo __('Teachers\' and staff\'s passwords can be reset only by an administrator.') ?></p>

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

