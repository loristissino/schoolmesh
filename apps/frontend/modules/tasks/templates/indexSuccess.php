<?php include_partial('content/breadcrumps', array(
  'current'=>__('SchoolMesh tasks'),
  ))
?>

<?php include_partial('content/flashes'); ?>

<?php foreach($sf_user->getAttribute('tasks') as $pid=>$task): ?>
  <p>
  <?php echo date('H:i:s', $task['start']) ?> - 
  <?php if($task['running']): ?>
    <strong style="color: blue" ?><?php echo $pid ?></strong> (<?php echo ('running') ?>):
  <?php else: ?>
    <strong style="color: green"><?php echo $pid ?></strong> (<?php echo ('completed') ?>):
  <?php endif ?>
  <?php echo $task['command'] ?><br />
  <?php foreach(array('output', 'error') as $file): ?>
    <?php if($task[$file]): ?>
      <?php echo link_to($file, url_for('tasks/showfile?pid=' . $pid . '&type='. $file)) ?><br />
    <?php endif ?>
  <?php endforeach ?>
  <?php if($task['running']): ?>
    <span style="color: blue"><?php echo __('Running time: %seconds% seconds', array('%seconds%'=>time()-$task['start'])) ?></span>
    (<?php echo link_to(__('reload the page to update'), url_for('tasks/index')) ?>)
  <?php endif ?>
  </p>
<?php endforeach ?>

<hr />

<h2><?php echo __('Available tasks') ?></h2>

<ul class="sf_admin_actions">
<?php foreach($available_tasks as $code => $task): ?>
  <?php echo li_link_to_if('action_task', true, $task['description'], url_for('tasks/execute?code=' . $code)) ?>
<?php endforeach ?>
</ul>

<hr />

<h2><?php echo __('Actions') ?></h2>
<ul class="sf_admin_actions">
  <?php echo li_link_to_if('action_task', true, __('Clear'), url_for('tasks/clear'), array('method'=>'post')) ?>
</ul>
