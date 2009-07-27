<?php use_helper('Javascript') ?>
<?php slot('title', sprintf('%s --  %s', $workplan->__toString(),$workplan->getsfGuardUser()->getProfile()->getFullName() )) ?>
<?php slot('breadcrumbs',
	link_to(__("Plans and Reports"), "@plansandreports") . ' » ' . 
	link_to($workplan, 'plansandreports/fill?id=' . $workplan->getId()) . ' » ' .
	__('Workplan module import')
	)
	
	?><h1><?php echo __('Workplan module import') ?> - <?php echo $workplan ?></h1>

<h3><?php echo __('Import one of your modules') ?></h3>

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

<h3><?php echo __('Import a module of a colleague') ?></h3>

