<?php if($Workstation->getJobs()): ?>
  <?php foreach($Workstation->getJobs() as $time=>$job): ?>
    <?php echo $time ?>: <?php echo $job['status']?> (<?php echo $job['user']?>)
  <?php endforeach ?>
<?php endif ?>
<?php foreach($tsc->getSlots()->getRawValue() as $slot): ?>
  <?php print_r($slot) ?>
<?php endforeach ?>
<hr />
<?php echo $tsc->getBeginning() ?> - <?php echo $tsc->getEleventhHour() ?>

