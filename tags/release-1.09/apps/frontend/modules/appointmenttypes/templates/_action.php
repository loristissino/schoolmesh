<ul class="sf_admin_td_actions">
  <?php echo li_link_to_if(
    'td_action_view',
    true,
    __('Show'),
    url_for('appointmenttypes/show?id=' . $AppointmentType->getId()),
    array('title'=>__('Show information concerning this appointment type'))
  )?>
</ul>
