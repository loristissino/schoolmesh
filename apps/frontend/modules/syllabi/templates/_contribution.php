<?php echo image_tag(
  $contribution['contribution']==WpmoduleSyllabusItemPeer::PARTIAL_CONTRIBUTION ? 'partialcontribution' : 'focussedcontribution',
  array(
    'title'=>$contribution['title']. ($appointment->getTeamId()? sprintf(' (%s)', __('this appointment is set only for some of the students')): ''),
    'size'=>'16x16',
    )
  )
?>
