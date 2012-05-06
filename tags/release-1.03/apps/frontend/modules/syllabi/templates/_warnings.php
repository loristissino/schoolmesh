<?php if($focussed>=1): ?>
  <?php echo image_tag(
    'flag_green',
    array(
      'title'=>__('At least one module is focussed on this goal'),
      'size'=>'16x16',
      )
    )
  ?>
<?php elseif($partial>=1): ?>
  <?php echo image_tag(
    'dubious',
    array(
      'title'=>__('No module is focussed on this goal'),
      'size'=>'16x16',
      )
    )
  ?>
<?php else: ?>
  <?php echo image_tag(
    'flag_red',
    array(
      'title'=>__('No module deals with this goal'),
      'size'=>'16x16',
      )
    )
  ?>
<?php endif ?>