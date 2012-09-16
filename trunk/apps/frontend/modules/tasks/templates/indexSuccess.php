<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'projects/index' =>__('SchoolMesh Tasks')
    ),
  'current'=>__('List of called tasks'),
  ))
?>

<?php include_partial('content/flashes'); ?>

<?php foreach($sf_user->getAttribute('tasks') as $pid=>$task): ?>
  <p>
  <strong style="color: <?php echo $task['running'] ? 'blue': 'red' ?>"><?php echo $pid ?>:</strong>
  <?php echo $task['task'] ?><br />
  <?php foreach(array('output', 'error') as $file): ?>
    <?php if($task[$file]): ?>
      <?php echo link_to($file, 'tasks/showfile?pid=' . $pid . '&type='. $file) ?><br />
    <?php endif ?>
  <?php endforeach ?>
  </p>
<?php endforeach ?>

<hr />

<p><?php echo link_to(__('Execute'), url_for('tasks/execute'), array('method'=>'post')) ?></p>
<p><?php echo link_to(__('Clear'), url_for('tasks/clear'), array('method'=>'post')) ?></p>
