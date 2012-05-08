<?php if(sizeof($WpinfoTypes) and !$AppointmentType->getHasInfo()): ?>
  <?php echo get_partial('content/dubious', array(
    'text'=>__('This appointment type has some info fields associated with, but it looks like it should not.'),
    'with_text'=>$with_text
    )) ?>
<?php endif ?>

<?php if(!sizeof($WpinfoTypes) and $AppointmentType->getHasInfo()): ?>
  <?php echo get_partial('content/dubious', array(
    'text'=>__('This appointment type does not have info fields associated with, but it looks like it should.'),
    'with_text'=>$with_text
    )) ?>
<?php endif ?>
