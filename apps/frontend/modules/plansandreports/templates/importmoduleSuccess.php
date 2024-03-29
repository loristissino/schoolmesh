<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    '@plansandreports' => "Plans and Reports",
    'plansandreports/fill?id=' . $workplan->getId() => $workplan,
    ),
  'current'=>__('Workplan module import'),
  'title' => __('Workplan module import') . ' - ' . $workplan
  ))
?>

<h2><?php echo __('Import one of your modules') ?></h2>

<?php if(sizeof($s_modules)>0): ?>

  <div class="sf_admin_list">

  <table cellspacing="0">
    <thead>
      <tr>
        <th class="sf_admin_text"><?php echo __('Period') ?></th>
        <th class="sf_admin_text"><?php echo __('Title') ?></th>
        <th class="sf_admin_text"><?php echo __('Last update') ?></th>
        <th class="sf_admin_text"><?php echo __('Class') ?></th>
        <th class="sf_admin_text"><?php echo __('Actions') ?></th>
      </tr>
    </thead>
    <tbody>
    <?php $i=0 ?>
    <?php foreach($s_modules as $wpmodule): ?>
      <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
      <?php /* WARNING: Since we use PDO directly, objects are raw and we don't have Getters here: */ ?>
        <td><?php  echo $wpmodule->period ?></td>
        <td><?php  echo $wpmodule->title ?></td>
        <td><?php  echo Generic::datetime($wpmodule->last_update, $sf_context) ?></td>
        <td><?php  echo $wpmodule->schoolclass_id ?></td>
      <td><?php include_partial('actionmoduleimport', array('wpmodule'=>$wpmodule, 'workplan'=>$workplan))?></td>
    </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>

  </div>

<?php else: ?>

<div>
<p><?php echo __('No module found.') ?></p>
</div>

<?php endif ?>

<h2><?php echo __('Import a module of a colleague') ?></h2>

<p>
<?php echo __('You can import one of the following public modules.') ?>
</p>
<p>
<?php echo __('Modules are considered public when: a) they belong to a workplan already approved; or b) when they are explicitly published by the owner before workplan submission.') ?>
</p>

<ul class="sf_admin_actions">
<?php if(!$allsubjects): ?>
  <li class="sf_admin_action_all">
  <?php echo link_to(
    __('Show all subjects'),
    'plansandreports/importmodule?id=' . $workplan->getId() . '&allsubjects=true'
    )
  ?>
<?php else: ?>
  <li class="sf_admin_action_restrict">
  <?php echo link_to(
    __('Show only my subject'),
    'plansandreports/importmodule?id=' . $workplan->getId() . '&allsubjects=false'
    )
  ?>
<?php endif ?>
</ul>

<?php if (sizeof($c_modules)>0): ?>

<div class="sf_admin_list">

<table cellspacing="0">
  <thead>
    <tr>
      <th class="sf_admin_text"><?php echo __('Period') ?></th>
      <th class="sf_admin_text"><?php echo __('Title') ?></th>
      <th class="sf_admin_text"><?php echo __('Last update') ?></th>
      <th class="sf_admin_text"><?php echo __('Teacher') ?></th>
      <th class="sf_admin_text"><?php echo __('Class') ?></th>
      <th class="sf_admin_text"><?php echo __('Actions') ?></th>
    </tr>
  </thead>
  <tbody>
	<?php $i=0 ?>
	<?php foreach($c_modules as $wpmodule): ?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
		<?php /* WARNING: Since we use PDO directly, objects are raw and we don't have Getters here: */ ?>
      <td><?php  echo $wpmodule->period ?></td>
      <td><?php  echo $wpmodule->title ?></td>
      <td><?php  echo Generic::datetime($wpmodule->last_update, $sf_context) ?></td>
      <td><?php  echo $wpmodule->teacher ?></td>
      <td><?php  echo $wpmodule->schoolclass ?></td>
	  <td><?php include_partial('actionmoduleimport', array('wpmodule'=>$wpmodule, 'workplan'=>$workplan))?></td>
	</td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

</div>
<?php else: ?>
<?php echo __('No module found.') ?>
<?php endif ?>
