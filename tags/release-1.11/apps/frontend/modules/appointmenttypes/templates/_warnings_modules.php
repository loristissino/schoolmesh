<?php if(sizeof($WpitemTypes) and !$AppointmentType->getHasModules()): ?>
  <?php echo get_partial('content/dubious', array(
    'text'=>__('This appointment type has some didactic module fields associated with, but it looks like it should not.'), 
    'with_text'=>$with_text
    )) ?>
<?php endif ?>

<?php if(!sizeof($WpitemTypes) and $AppointmentType->getHasModules()): ?>
  <?php echo get_partial('content/dubious', array(
    'text'=>__('This appointment type has some didactic module fields associated with, but it looks like it should not.'),
    'with_text'=>$with_text
    )) ?>
<?php endif ?>
