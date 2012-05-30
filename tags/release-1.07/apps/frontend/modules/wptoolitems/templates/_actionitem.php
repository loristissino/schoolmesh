<ul class="sf_admin_td_actions">
  <?php if(!$wptool_item->countWptoolAppointments()): ?>
    <li class="sf_admin_action_delete">
      <?php echo link_to(
    __('Delete'),
    'wptoolitems/delete?id=' . $wptool_item->getId(), 
    array('method' => 'delete')
    )?>
    </li>
  <?php endif ?>
</ul>
