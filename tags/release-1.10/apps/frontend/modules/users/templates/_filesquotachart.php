<?php
$lightgreen = 'beebba';
$darkgreen = '1ec10f';
$lightred = 'f6b8be';
$darkred  = 'e41228';
$darkorange = 'ffb733';
$lightorange = 'ffe48d';
?> 
<?php echo $user->getProfile()->getFullName() ?> (<?php echo $stats[$user->getUsername()]['used_files'] ?>/<?php echo $stats[$user->getUsername()]['soft_files_quota'] ?>)<br />
  <?php $sfqw=round($stats[$user->getUsername()]['soft_files_quota']/$fpp) ?>
  <?php $hfqw=round(($stats[$user->getUsername()]['hard_files_quota'] - $stats[$user->getUsername()]['soft_files_quota'])/$fpp) ?>  
  <?php echo image_tag('phpixel.php?color=999999',
    array(
      'title'=>__('soft files quota: %quota%', array('%quota%'=>$stats[$user->getUsername()]['soft_files_quota'])), 
      'size'=>$sfqw.'x6')
      ) ?><?php echo image_tag('phpixel.php?color=666666', 
        array(
          'title'=>__('hard files quota: %quota%', array('%quota%'=>$stats[$user->getUsername()]['hard_files_quota'])),
          'size'=>$hfqw.'x6')) ?><br />
  <?php $ufw=round($stats[$user->getUsername()]['used_files']/$fpp) ?>
  <?php $nufw=$sfqw + $hfqw - $ufw ?>
  <?php $ratio=$stats[$user->getUsername()]['used_files']/$stats[$user->getUsername()]['soft_files_quota'] ?>
  <?php if($ratio <= .75)
  {
    $ucolor=$darkgreen; $ncolor=$lightgreen;
  }
  elseif($ratio <= 1)
  {
    $ucolor=$darkorange; $ncolor=$lightorange;
  }
  else
  {
    $ucolor=$darkred; $ncolor=$lightred;
  }
  ?>
  <?php $ucolor = $ratio <= .75 ? $darkgreen : ($ratio <= 1 ? $darkorange : $darkred) ?>
  <?php echo image_tag('phpixel.php?color=' . $ucolor, array('size'=>$ufw.'x12')) ?><?php echo image_tag('phpixel.php?color=' . $ncolor, array('size'=>$nufw.'x12')) ?><br />
