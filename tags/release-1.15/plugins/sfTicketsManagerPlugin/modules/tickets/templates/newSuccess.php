<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'tickets/index'=>__('Tickets'),
  ),
  'current'=>__('New ticket')
  ))
?>

<?php include_partial('content/flashes'); ?>

<p><?php echo __('This module is experimental.') ?></p>

<?php include_partial('form', array('form' => $form, 'referrer'=>$referrer)) ?>
