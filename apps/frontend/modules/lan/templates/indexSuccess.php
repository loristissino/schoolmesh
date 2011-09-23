<?php include_partial('content/breadcrumps', array(
  'current'=>__('Workstations of subnet «%subnet%»', array('%subnet%'=>$currentsubnet))
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
      <th><?php echo __('Enabled?') ?></th>
      <th><?php echo __('Time slots') ?></th>
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
      <td><?php echo $Workstation->getName() ?>
      <?php if($Workstation->getIpCidr()==$_SERVER['REMOTE_ADDR']): ?>
      <?php echo image_tag('star', array(
        'title'=>__('This is the workstation you are currently using')
        )
      ) ?>
      <?php endif ?></td>
      <td><?php echo $Workstation->getIsEnabled() ? __('Yes'): __('No') ?></td>
      <td><?php include_partial('queue', array('Workstation'=>$Workstation, 'tsc'=>$timeslotsContainer)) ?></td>
      <td><?php echo $Workstation->getSubnet() ?></td>
      <td>
      <ul class="sf_admin_td_actions">
      <?php if($Workstation->getIsEnabled()): ?>
        <?php if($sf_user->hasCredential('admin')): ?>
          <li class="sf_admin_action_internetaccessoff">
          <?php echo link_to(
                __('Disable Internet access'),
                'lan/disableinternetaccess?id='. $Workstation->getId().'&code='. Generic::b64_serialize(array('user'=>$Workstation->getUser(), 'type'=>'allday')),
                array(
                  'method'=>'post',
                  'confirm' => format_number_choice(__('[0]Are you sure?|[1]Are you sure?'), null, $sf_user->getProfile()->getIsMale()),
                  'title'=>__('Disable Internet access for workstation %name%', array('%name%'=>$Workstation->getName()))
                  ) 
                ) ?>
          </li>
        <?php elseif($sf_user->hasCredential('internet') && $sf_user->getProfile()->getUsername()==$Workstation->getUser()): ?>
          <li class="sf_admin_action_internetaccessoff">
          <?php echo link_to(
                __('Disable Internet access'),
                'lan/disableinternetaccess?id='. $Workstation->getId().'&code='. Generic::b64_serialize(array('user'=>$sf_user->getProfile()->getUsername(), 'type'=>'timeslot')),
                array(
                  'method'=>'post',
                  'confirm' => format_number_choice(__('[0]Are you sure?|[1]Are you sure?'), null, $sf_user->getProfile()->getIsMale()),
                  'title'=>__('Disable Internet access for workstation %name%', array('%name%'=>$Workstation->getName()))
                  ) 
                ) ?>
          </li>
        
        <?php endif ?>
      <?php else: ?>
        <?php if($sf_user->hasCredential('admin')): ?>
          <li class="sf_admin_action_internetaccesson">
          <?php echo link_to(
                __('Enable Internet access (day)'),
                'lan/adminenableinternetaccess?id='. $Workstation->getId(),
                array(
                  'method'=>'post',
                  'title'=>__('Enable Internet access for workstation %name% for the whole day', array('%name%'=>$Workstation->getName())),
                  ) 
                ) ?>
          </li>
        <?php endif ?>
        <?php if($sf_user->hasCredential('internet')): ?>
          <li class="sf_admin_action_internetaccesson">
          <?php echo link_to(
                __('Enable Internet access (timeslot)'),
                'lan/userenableinternetaccess?id='. $Workstation->getId(),
                array(
                  'method'=>'post',
                  'title'=>__('Enable Internet access for workstation %name% for the current timeslot', array('%name%'=>$Workstation->getName())),
                  ) 
                ) ?>
          </li>
        <?php endif ?>
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

<?php foreach($Subnets as $Subnet): ?>
<?php if($Subnet==$currentsubnet): ?>
  <strong><?php echo $Subnet ?></strong>
<?php else: ?>
  <?php echo link_to(
    $Subnet,
    'lan/selectsubnet?id=' . $Subnet->getId()
    )
  ?>
<?php endif ?>
<?php endforeach ?>

<?php if($currentsubnet!=$mysubnet): ?>
  <?php slot('general_alerts', __('You are currently working on subnet %subnet%, not on the one you are actually logged on.', array('%subnet%'=>$currentsubnet->__toString()))) ?>
<?php endif ?>