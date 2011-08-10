<?php echo image_tag(
  $contribution['contribution']==WpmoduleSyllabusItemPeer::PARTIAL_CONTRIBUTION ? 'partialcontribution' : 'focussedcontribution',
  array(
    'title'=>$contribution['title'],
    'size'=>'16x16',
    )
  )
?>