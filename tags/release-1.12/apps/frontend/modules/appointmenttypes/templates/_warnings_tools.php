<?php if(sizeof($WptoolItemTypes) and !$AppointmentType->getHasTools()): ?>
  <?php echo get_partial('content/dubious', array(
    'text'=>__('This appointment type has some group of tools/methodologies associated with, but it looks like it should not.'), 
    'with_text'=>$with_text
    )) ?>
<?php endif ?>
<?php if(!sizeof($WptoolItemTypes) and $AppointmentType->getHasTools()): ?>
  <?php echo get_partial('content/dubious', array(
    'text'=>__('This appointment type does not have groups of tools/methodologies associated with, but it looks like it should.'), 
    'with_text'=>$with_text
    )) ?>
<?php endif ?>

