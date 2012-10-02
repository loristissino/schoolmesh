<?php include_partial('content/breadcrumps', array(
  'current'=>__('Appointments recapitulation'),
  ))
?>

<?php include_partial('content/flashes'); ?>

<div class="sf_admin_list">

<?php if(sizeof($teachershours)>0): ?>

<h2><?php echo __('Recapitulation for teachers') ?></h2>

<table cellspacing="0">
  <thead>
    <tr>
      <th class="sf_admin_text"><?php echo __('Name') ?></th>
      <th class="sf_admin_text"><?php echo __('Hours') ?></th>
    </tr>
  </thead>
  <tbody>
	<?php $i=0 ?>
    <?php foreach ($teachershours as $row): ?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
      <td><?php echo link_to($row->FIRST_NAME, url_for('users/edit?id=' . $row->USER_ID) . '#appointments') ?> <strong><?php echo link_to($row->LAST_NAME, url_for('users/edit?id=' . $row->USER_ID) . '#appointments') ?></strong></td>
      <td style="text-align: right" <?php if($row->WEEKLY_HOURS<>sfConfig::get('app_config_teachers_hours_per_week', 18)) echo 'class="warning"' ?>><?php echo $row->WEEKLY_HOURS ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php endif ?>

<?php if(sizeof($schoolclasseshours)>0): ?>

<h2><?php echo __('Recapitulation for classes') ?></h2>

<table cellspacing="0">
  <thead>
    <tr>
      <th class="sf_admin_text"><?php echo __('Class') ?></th>
      <th class="sf_admin_text"><?php echo __('Hours') ?></th>
    </tr>
  </thead>
  <tbody>
	<?php $i=0 ?>
    <?php foreach ($schoolclasseshours as $row): ?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
      <td><?php echo $row->SCHOOLCLASS_ID ?></td>
      <td style="text-align: right" <?php if($row->WEEKLY_HOURS<>sfConfig::get('app_config_schoolclasses_hours_per_week', 32)) echo 'class="warning"' ?>><?php echo $row->WEEKLY_HOURS ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php endif ?>

