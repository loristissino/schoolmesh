<?php include_partial('content/breadcrumps', array(
  'current'=>__('Dashboard')
  ))
?>

<?php include_partial('content/flashes'); ?>

<h2><?php echo __('Sections') ?></h2>
<ul class="sf_admin_actions">
  <?php echo li_link_to_if('actions_projects', true, __('Projects'), url_for('dashboard/projects')) ?>
  <?php echo li_link_to_if('actions_appointments', true, __('Appointments'), url_for('dashboard/appointments')) ?>
</ul>

<?php include_partial('content/year', array('year'=>$year, 'years'=>$years, 'back'=>'dashboard/index')) ?>
