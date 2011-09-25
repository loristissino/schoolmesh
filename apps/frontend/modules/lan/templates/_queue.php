<?php
$lightgreen = 'beebba';
$darkgreen = '1ec10f';
$lightred = 'f6b8be';
$darkred  = 'e41228';
$darkorange = 'ffb733';
$lightorange = 'ffe48d';
$lightyellow = 'ffff00';
$darkyellow = 'dddd00';
$lightgray = 'cccccc';

?>
<?php $tsc->setPlanningInfo($Workstation->getRawValue()) ?>
<?php echo image_tag('phpixel.php?color=000000',
    array(
      'size'=>'1x16')
      ) ?><?php $count=-1; foreach($tsc->getSlots()->getRawValue() as $slot): $count++; 
$color = 
  $slot['state']=='past' ? 
    $lightgray
    : 
    ($slot['state']=='current' ? 
      ($Workstation->getIsEnabled() ? 
        $darkgreen 
        : 
        $darkred
      ) 
      :
      ($tsc->getPlannedStatus($count)=='on' ?
        $lightgreen
        :
        $lightred
      )
    ) 
?><?php if ($slot['newgroup']): ?><?php echo image_tag('phpixel.php?color=000000',
    array(
      'size'=>'2x16')
      ) ?><?php endif ?><?php echo image_tag('phpixel.php?color=' . $color,
    array(
      'title'=>__('%period%, %timeslot% (%begin%-%end%)', array(
        '%period%'=>$slot['period'],
        '%timeslot%'=>$slot['description'], 
        '%begin%'=>$slot['begin'],
        '%end%'=>$slot['end'])
        ). ' ' . $tsc->getPlannedUser($count), 
      'size'=>$slot['width'].'x16')
      ) ?><?php echo image_tag('phpixel.php?color=000000',
    array(
      'size'=>'1x16')
      ) ?><?php endforeach ?><?php echo image_tag('phpixel.php?color=000000',
    array(
      'size'=>'2x16')
      ) ?>

