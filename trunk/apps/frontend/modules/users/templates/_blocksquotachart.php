<?php
$lightgreen = 'beebba';
$darkgreen = '1ec10f';
$lightred = 'f6b8be';
$darkred  = 'e41228';
$darkorange = 'ffb733';
$lightorange = 'ffe48d';
?> 

<?php if($sf_user->hasCredential('admin')):?>
<?php echo link_to($user->getProfile()->getFullName(), url_for('users/editaccount?id='. $stats[$user->getUsername()]['id'])) ?>
<?php else: ?>
<?php echo $user->getProfile()->getFullName() ?>
 <?php endif ?>
 (<?php echo $stats[$user->getUsername()]['used_blocks'] ?>/<?php echo $stats[$user->getUsername()]['soft_blocks_quota'] ?>)
 
 <br />
  <?php $sbqw=round($stats[$user->getUsername()]['soft_blocks_quota']/$bpp) ?>
  <?php $hbqw=round(($stats[$user->getUsername()]['hard_blocks_quota'] - $stats[$user->getUsername()]['soft_blocks_quota'])/$bpp) ?>  
  <?php echo image_tag('phpixel.php?color=999999',
    array(
      'title'=>__('soft blocks quota: %quota%', array('%quota%'=>$stats[$user->getUsername()]['soft_blocks_quota'])), 
      'size'=>$sbqw.'x6')
      ) ?><?php echo image_tag('phpixel.php?color=666666', 
        array(
          'title'=>__('hard blocks quota: %quota%', array('%quota%'=>$stats[$user->getUsername()]['hard_blocks_quota'])),
          'size'=>$hbqw.'x6')) ?><br />
  <?php $ubw=round($stats[$user->getUsername()]['used_blocks']/$bpp) ?>
  <?php $nubw=$sbqw + $hbqw - $ubw ?>
  <?php $ratio=$stats[$user->getUsername()]['used_blocks']/$stats[$user->getUsername()]['soft_blocks_quota'] ?>
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
  <?php $title=__('using %usedspace% out of %availablespace% available',
    array(
      '%usedspace%'=>Generic::getHumanReadableSize($stats[$user->getUsername()]['used_blocks']*1024),
      '%availablespace%'=>Generic::getHumanReadableSize($stats[$user->getUsername()]['soft_blocks_quota']*1024)
      )) ?>
  <?php $ucolor = $ratio <= .75 ? $darkgreen : ($ratio <= 1 ? $darkorange : $darkred) ?>
  <?php echo image_tag('phpixel.php?color=' . $ucolor, array(
    'title'=>$title,
    'size'=>$ubw.'x12')) ?><?php echo image_tag('phpixel.php?color=' . $ncolor, array('title'=>$title,'size'=>$nubw.'x12')) ?>
