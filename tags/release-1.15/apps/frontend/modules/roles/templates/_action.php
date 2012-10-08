<ul class="sf_admin_td_actions">
  <?php echo li_link_to_if(
    'td_action_edit',
    true,
    __('Edit'),
    url_for('roles/edit?id=' . $Role->getId()),
    array('title'=>__('Edit information about this role'))
  )?>
</ul>
