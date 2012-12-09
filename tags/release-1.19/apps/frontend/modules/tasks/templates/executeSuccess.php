<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'tasks/index' =>__('SchoolMesh Tasks')
    ),
  'current'=>__('Task execution'),
  ))
?>

<?php include_partial('content/flashes'); ?>

<p><?php echo __('You are going to execute the following task:') ?></p>

<p><strong><?php echo sprintf('symfony %s%s', ($task['namespace']?$task['namespace'].':':''), $task['task']) ?></strong></p>

<form action="<?php echo url_for('tasks/execute?code='. $task['code']) ?>" method="POST">
  <table>
      <?php echo $form ?>
      <tr>
        <td colspan="2">
           <input type="submit" name="save" value="<?php echo __('Execute') ?>">
        </td>
      </tr>
  </table>
</form>
