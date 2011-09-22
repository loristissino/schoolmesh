<?php if($Workstation->getJobs()): ?>
  <?php foreach($Workstation->getJobs() as $time=>$job): ?>
    <?php echo $time ?>: <?php echo $job['status']?> (<?php echo $job['user']?>)
  <?php endforeach ?>
<?php endif ?>

