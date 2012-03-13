<ul class="sf_admin_td_actions">
  <?php echo li_link_to_if(
    'td_action_edit',
    true,
    __('Edit'),
    url_for('appointmenttypes/edit?id=' . $AppointmentType->getId()),
    array('title'=>__('Edit this appointment type'))
  )?>
</ul>
