<ul class="sf_admin_td_actions">
  <?php echo li_link_to_if(
    'td_action_view',
    true,
    __('View'),
    url_for('projects/view?id=' . $project->getId()),
    array('title'=>__('See the report for this project'))
    )
  ?>

  <?php echo li_link_to_if(
    'td_action_email',
    $project->isReadyForEmail(),
    __('Email'),
    url_for('projects/email?id=' . $project->getId()),
    array('title'=>__('Prepare and send an email to the coordinator of this project'))
    )
  ?>

  <?php echo li_link_to_if(
    'td_action_edit',
    true,
    __('Edit'),
    url_for('projects/edit?id=' . $project->getId() . '&back=monitor'),
    array('title'=>__('Edit administrative information about this project'))
    )
  ?>

  <?php echo li_link_to_if(
    'td_action_export',
    true,
    __('Export'),
    url_for('projects/export?id=' . $project->getId()),
    array('title'=>__('Export documentation from this project'))
    )
  ?>

  <?php echo li_link_to_if(
    'td_action_budget',
    $project->hasBudget(),
    __('Budget'),
    url_for('projects/checkbudgetcompatibility?id=' . $project->getId()),
    array('title'=>__('Check whether the amounts of activities recognized is compatible with the ones approved'))
    )
  ?>
</ul>
