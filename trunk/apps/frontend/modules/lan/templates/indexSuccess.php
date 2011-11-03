<?php include_partial('content/breadcrumps', array(
  'current'=>__('Workstations of subnet «%subnet%»', array('%subnet%'=>$currentsubnet))
  ))
?>

<?php include_partial('content/flashes') ?>

<div class="sf_admin_list">

<?php if(sizeof($Workstations)>0): ?>

<form action="<?php echo url_for('lan/batch') ?>" method="GET">

<table>
  <thead>
    <tr>
      <th id="sf_admin_list_batch_actions"><input id="sf_admin_list_batch_checkbox" type="checkbox" onclick="checkAll();" /></th>
      <th><?php echo __('Name') ?></th>
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
      <td><?php include_partial('queue', array('Workstation'=>$Workstation, 'tsc'=>$timeslotsContainer)) ?></td>
      <td><?php echo $Workstation->getSubnet() ?></td>
      <td>
      <ul class="sf_admin_td_actions">
      <?php if($Workstation->getIsEnabled()): ?>
        <?php if($sf_user->hasCredential('admin')): ?>
          <li class="sf_admin_action_internetaccessoff">
          <?php echo link_to(
                __('Web off (day)'),
                'lan/disableinternetaccess?id='. $Workstation->getId().'&code='. Generic::b64_serialize(array('user'=>$Workstation->getUser(), 'type'=>'allday')),
                array(
                  'method'=>'post',
                  'confirm' => format_number_choice(__('[0]Are you sure?|[1]Are you sure?'), null, $sf_user->getProfile()->getIsMale()),
                  'title'=>__('Disable web access for workstation %name% until the eleventh hour', array('%name%'=>$Workstation->getName()))
                  ) 
                ) ?>
          </li>
        <?php endif ?>
        <?php if($sf_user->hasCredential('internet') && $sf_user->getProfile()->getUsername()==$Workstation->getUser()): ?>
          <li class="sf_admin_action_internetaccessoff">
          <?php echo link_to(
                __('Web off (ts)'),
                'lan/disableinternetaccess?id='. $Workstation->getId().'&code='. Generic::b64_serialize(array('user'=>$sf_user->getProfile()->getUsername(), 'type'=>'timeslot')),
                array(
                  'method'=>'post',
                  'confirm' => format_number_choice(__('[0]Are you sure?|[1]Are you sure?'), null, $sf_user->getProfile()->getIsMale()),
                  'title'=>__('Disable web access for workstation %name% for the current timeslot', array('%name%'=>$Workstation->getName()))
                  ) 
                ) ?>
          </li>
        
        <?php endif ?>
      <?php else: ?>
        <?php if($sf_user->hasCredential('admin')): ?>
          <li class="sf_admin_action_internetaccesson">
          <?php echo link_to(
                __('Web on (day)'),
                'lan/adminenableinternetaccess?id='. $Workstation->getId(),
                array(
                  'method'=>'post',
                  'title'=>__('Enable web access for workstation %name% until the eleventh hour', array('%name%'=>$Workstation->getName())),
                  ) 
                ) ?>
          </li>
        <?php endif ?>
        <?php if($sf_user->hasCredential('internet')): ?>
          <li class="sf_admin_action_internetaccesson">
          <?php echo link_to(
                __('Web on (ts)'),
                'lan/userenableinternetaccess?id='. $Workstation->getId(),
                array(
                  'method'=>'post',
                  'title'=>__('Enable web access for workstation %name% for the current timeslot', array('%name%'=>$Workstation->getName())),
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

<?php echo optionsforselect($actions, 0) ?>
  </select>

<?php echo submittag(_('Ok')) ?>
</li>



<?php else: ?>
<p><?php echo __('No workstations defined.') ?></p>
<?php endif ?>
</div>

<?php include_partial('subnets', array('Subnets'=>$Subnets, 'currentsubnet'=>$currentsubnet, 'mysubnet'=>$mysubnet)) ?>

