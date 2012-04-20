<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'users/index' =>__('User management'),
    'users/list'=>__('List/Search'),
    ),
    'current'=>__('New user'),
  ))
?>

<?php include_partial('content/flashes'); ?>

<form action="<?php echo url_for('users/prenew') ?>" method="POST">

<h2><?php echo __('Basic information') ?></h2>

  <table>
    <?php echo $userform ?>
	<tr>
      <td colspan="2">
         <input type="submit" name="save" value="<?php echo __('Continue') ?>">
      </td>
    </tr>
  </table>

