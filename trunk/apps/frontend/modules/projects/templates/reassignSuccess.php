<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'projects/monitor' => __("Projects management"),
    ),
  'current'=>__("Reassign"),
  'title'=>__("Projects reassignment")
  ))
?>

<?php include_partial('content/flashes'); ?>

<div class="sf_admin_list">

<p>
<?php echo __('You are going to change the coordinator of the following projects:') ?>
</p>
<ul>
<?php foreach($projects as $project): ?>
  <li><?php echo $project ?></li>
<?php endforeach ?>
</ul>

<form action="<?php echo url_for('projects/reassign') ?>" method="post">

  <table>
    <?php echo $form ?>
	<tr>
      <td colspan="2">
         <input type="submit" name="save" value="<?php echo __('Save') ?>">
      </td>
    </tr>
  </table>
  
</form>
