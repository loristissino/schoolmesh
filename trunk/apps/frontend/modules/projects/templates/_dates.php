<?php foreach(array('Approval', 'Financing', 'Confirmation') as $date): $method='get'.$date.'date' ?>
<?php if($project->$method()): ?>
  <?php echo image_tag('date_existing', array('size'=>'16x16', 'title'=>__($date. ' date')))?>:&nbsp;<?php echo $project->$method('d/m/y') ?>
<?php else: ?>
  <?php echo image_tag('date_missing', array('size'=>'16x16', 'title'=>__($date. ' date')))?>:&nbsp;<?php echo $project->$method('d/m/y') ?>
<?php endif ?><br />
<?php endforeach ?>
