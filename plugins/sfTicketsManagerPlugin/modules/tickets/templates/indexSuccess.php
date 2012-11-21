<?php include_partial('content/breadcrumps', array(
  'current'=>__('Tickets')
  ))
?>

<?php include_partial('content/cooperate') ?>
<?php /*
<table>
  <thead>
    <tr>
      <th><?php echo __('Id') ?></th>
      <th><?php echo __('Ticket type') ?></th>
      <th><?php echo __('Content') ?></th>
      <th><?php echo __('Last update') ?></th>
      <th><?php echo __('State') ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($Tickets as $Ticket): ?>
    <tr>
      <td><a href="<?php echo url_for('tickets/show?id='.$Ticket->getId()) ?>"><?php echo $Ticket->getId() ?></a></td>
      <td><?php echo $Ticket->getTicketType() ?></td>
      <td><?php echo $Ticket->getContent() ?></td>
      <td><?php echo $Ticket->getUpdatedAt() ?></td>
      <td><?php echo $Ticket->getState() ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

*/ ?>
