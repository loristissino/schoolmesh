<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    'tickets/index'=>__('Tickets'),
  ),
  'current'=>$Ticket->__toString()
  ))
?>

<?php include_partial('content/flashes'); ?>

<table>
  <tbody>
    <tr>
      <th><?php echo __('Id') ?>:</th>
      <td><?php echo $Ticket->getId() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Referrer') ?>:</th>
      <td><?php echo link_to($Ticket->getReferrer(), $Ticket->getReferrer()) ?></td>
    </tr>
    <tr>
      <th><?php echo __('Ticket type') ?>:</th>
      <td><?php echo $Ticket->getTicketType() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Content') ?>:</th>
      <td><?php echo $Ticket->getContent() ?></td>
    </tr>
    <tr>
      <th><?php echo __('Last update') ?></th>
      <td><?php echo $Ticket->getUpdatedAt() ?></td>
    </tr>
    <tr>
      <th><?php echo __('State') ?>:</th>
      <td><?php echo $Ticket->getState() ?></td>
    </tr>
  </tbody>
</table>

<hr />

<a href="<?php echo url_for('tickets/edit?id='.$Ticket->getId()) ?>">Edit</a>
&nbsp;
<a href="<?php echo url_for('tickets/index') ?>">List</a>
