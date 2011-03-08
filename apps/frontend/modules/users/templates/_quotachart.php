<?php if(array_key_exists($user->getUsername(), $stats->getRawValue())): ?>
<?php
$lightgreen = 'beebba';
$darkgreen = '1ec10f';
$lightred = 'f6b8be';
$darkred  = 'e41228';
$darkorange = 'ffb733';
$lightorange = 'ffe48d';
$lightyellow = 'ffff00';
$darkyellow = 'dddd00';

?>
<?php $messages=array(
  'blocks'=>$personal_profile?'You are using %usedspace% out of %availablespace% available.':'%name% is using %usedspace% out of %availablespace% available.',
  'files' =>$personal_profile?'You are using %usedfiles% files out of %availablefiles% available.':'%name% is using %usedfiles% files out of %availablefiles% available.'
  )
?>
<?php $title=__($messages[$chart],
    array(
      '%name%'=>$user->getProfile()->getFirstName(),
      '%usedspace%'=>Generic::getHumanReadableSize($stats[$user->getUsername()]['used_blocks']*sfConfig::get('app_config_posix_blocksize', 1024)),
      '%availablespace%'=>Generic::getHumanReadableSize($stats[$user->getUsername()]['info_soft_blocks_quota']*1024),
      '%usedfiles%'=>$stats[$user->getUsername()]['used_files'],
      '%availablefiles%'=>$stats[$user->getUsername()]['info_soft_files_quota'],
      )) ?>

<?php if(!$personal_profile): ?>
<td><?php echo $user->getProfile()->getFirstName() ?> <b><?php echo $user->getProfile()->getLastName() ?></b></td>
<td style="text-align: right"><?php echo $stats[$user->getUsername()]['used_' . $chart] ?></td>
<td>
<?php else: ?>
<p><?php echo $title ?><br />
<?php endif ?>

  <?php $isbqw=round($stats[$user->getUsername()]['info_soft_' . $chart . '_quota']/$bpp) ?>
  <?php $ihbqw=round(($stats[$user->getUsername()]['info_hard_' . $chart . '_quota'] - $stats[$user->getUsername()]['info_soft_' . $chart . '_quota'])/$bpp) ?>  
  <?php echo image_tag('phpixel.php?color=dddddd',
    array(
      'title'=>__('Actual soft ' . $chart . ' quota: %quota%', array('%quota%'=>$stats[$user->getUsername()]['info_soft_' . $chart . '_quota'])), 
      'size'=>$isbqw.'x4')
      ) ?><?php echo image_tag('phpixel.php?color=888888', 
        array(
          'title'=>__('Actual hard ' . $chart . ' quota: %quota%', array('%quota%'=>$stats[$user->getUsername()]['info_hard_' . $chart . '_quota'])),
          'size'=>$ihbqw.'x4')) ?><br />
  <?php $ssbqw=round($stats[$user->getUsername()]['setting_soft_' . $chart . '_quota']/$bpp) ?>
  <?php $shbqw=round(($stats[$user->getUsername()]['setting_hard_' . $chart . '_quota'] - $stats[$user->getUsername()]['setting_soft_' . $chart . '_quota'])/$bpp) ?>  
  <?php echo image_tag('phpixel.php?color='.($stats[$user->getUsername()][$chart . '_settings_changed']?$lightyellow: 'cccccc'),
    array(
      'title'=>__('Set soft ' . $chart . ' quota: %quota%', array('%quota%'=>$stats[$user->getUsername()]['setting_soft_' . $chart . '_quota'])), 
      'size'=>$ssbqw.'x4')
      ) ?><?php echo image_tag('phpixel.php?color='.($stats[$user->getUsername()][$chart . '_settings_changed']?$darkyellow: '777777'), 
        array(
          'title'=>__('Set hard ' . $chart . ' quota: %quota%', array('%quota%'=>$stats[$user->getUsername()]['setting_hard_' . $chart . '_quota'])),
          'size'=>$shbqw.'x4')) ?><br />

  <?php $ubw=round($stats[$user->getUsername()]['used_' . $chart]/$bpp) ?>
  <?php $tw = $isbqw + $ihbqw ?>
  <?php $nubw= $tw - $ubw ?>
  <?php $ratio=$stats[$user->getUsername()]['info_soft_' . $chart . '_quota']!=0 ? ($stats[$user->getUsername()]['used_' . $chart]/$stats[$user->getUsername()]['info_soft_' . $chart . '_quota']) : 0 ?>
  <?php if($ratio <= $quota_warning)
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
  <?php echo image_tag('phpixel.php?color=' . $ucolor, array(
    'title'=>$title,
    'size'=>$ubw.'x12')) ?><?php echo image_tag('phpixel.php?color=' . $ncolor, array('title'=>$title,'size'=>$nubw.'x12')) ?><br />
    <?php echo image_tag('phpixel.php?color=000000', array('size'=>$tw.'x1')) ?>
<?php if(!$personal_profile): ?>
</td>
<td>
  <ul class="sf_admin_td_actions">
  <?php if($sf_user->hasCredential('admin')):?>
    <li class="sf_admin_action_edit">
    <?php echo link_to(
          __('Edit'),
          'users/editaccount?id='. $stats[$user->getUsername()]['id'],
          array('title'=>__('Edit posix account of %user%', array('%user%'=>$user->getProfile()->getFullName())))
          )?>
    </li>
    <?php if ($stats[$user->getUsername()][$chart .'_settings_changed']): ?>
    <li class="sf_admin_action_userchecks">
    <?php echo link_to(
          __('Run user checks'),
          'users/runuserchecks?id='. $user->getId(),
          array('title'=>__('Run user checks for %user%', array('%user%'=>$user->getProfile()->getFullName())))
          )?>
    </li>
    <?php endif ?>
    <?php if ($stats[$user->getUsername()]['setting_soft_' . $chart . '_quota']>=$max_used): ?>
    <li class="sf_admin_action_applytoall">
    <?php echo link_to(
          __('Apply to all'),
          'users/copyaccountsettings?settings=' . $chart . '&from='. $stats[$user->getUsername()]['id']. '&to='. $accounts,
          array(
            'title'=>__('Apply these settings to all selected users\' accounts'),
            'method'=>'post', 
            'confirm' => format_number_choice(__('[0]Are you sure?|[1]Are you sure?'), null, $sf_user->getProfile()->getIsMale())
            )
          )?>
    </li>
    <?php endif ?>
  <?php endif ?>
  </ul>
</td>
<?php else: ?>
</p>
<?php endif ?>
<?php else: ?>
<td><?php echo $user->getProfile()->getFirstName() ?> <b><?php echo $user->getProfile()->getLastName() ?></b></td>
<td></td>
<td><?php echo __('No account information available.') ?></td>
<td></td>
<?php endif ?>
