<?php include_partial('content/breadcrumps', array(
  'current'=>__("Workstations")
  ))
?>

<?php include_partial('content/flashes'); ?>

<div class="sf_admin_list">

<?php if(sizeof($Workstations)>0): ?>

<form action="<?php echo url_for('workstations/batch') ?>" method="get">

<table>
  <thead>
    <tr>
      <th id="sf_admin_list_batch_actions"><input id="sf_admin_list_batch_checkbox" type="checkbox" onclick="checkAll();" /></th>
      <th><?php echo __('Name') ?></th>
      <th><?php echo __('Mac address') ?></th>
      <th><?php echo __('Enabled?') ?></th>
      <th><?php echo __('Subnet') ?></th>
      <th><?php echo __('Actions') ?></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($Workstations as $Workstation): ?>
    <tr>
      <td>
      <input type="checkbox" name="ids[]" value="<?php echo $Workstation->getId() ?>" class="sf_admin_batch_checkbox" />
      </td>
      <td><?php echo $Workstation->getName() ?></td>
      <td><?php echo $Workstation->getMacAddress() ?></td>
      <td><?php echo $Workstation->getIsEnabled() ? __('Yes'): __('No') ?></td>
      <td><?php echo $Workstation->getSubnet() ?></td>
      <td>
      <ul class="sf_admin_td_actions">
      <?php if($Workstation->getIsEnabled()): ?>
	<li class="sf_admin_action_internetaccessoff">
	<?php echo link_to(
				__('Disable Internet access'),
				'workstations/toggleinternetaccess?id='. $Workstation->getId(),
				array(
          'title'=>__('Disable Internet access for workstation %name%', array('%name%'=>$Workstation->getName()))
          ) 
				) ?>
  </li>
  <?php else: ?>
	<li class="sf_admin_action_internetaccesson">
	<?php echo link_to(
				__('Enable Internet access'),
				'workstations/toggleinternetaccess?id='. $Workstation->getId(),
				array(
          'title'=>__('Enable Internet access for workstation %name%', array('%name%'=>$Workstation->getName())),
          ) 
				) ?>
  </li>
  <?php endif ?>
</ul>
</td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php include_partial('plansandreports/checkalljs') ?>
 <ul class="sf_admin_actions">
      <li class="sf_admin_batch_actions_choice">
  <select name="batch_action">

<?php echo optionsforselect(array(
  '0' => __('Choose an action'),
  'enableinternetaccess' => __('Enable Internet access'),
  'disableinternetaccess' => __('Disable Internet access'),
), 0) ?>
  </select>

<?php echo submittag(_('Ok')) ?>
</li>



<?php else: ?>
<p><?php echo __('No workstations defined.') ?></p>
<?php endif ?>
</div>

