<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'tickets/index'=>__('Tickets'),
  ),
  'current' => __('Edit ticket'),
  'title'=>$Ticket->__toString()
  ))
?>

<?php include_partial('content/flashes'); ?>

<?php include_partial('form', array('form' => $form)) ?>
