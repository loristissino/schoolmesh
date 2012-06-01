<?php if($date): ?>
  <?php if($date<Generic::todayAtMidnight()): ?>
    <?php echo image_tag('dubious', array('title'=>__('Expiry passed'), 'size'=>'16x16')) ?>
  <?php endif ?>
  <?php echo date('d/m/Y', $date) /*date must be in seconds from epoch*/ ?>
<?php endif ?>
