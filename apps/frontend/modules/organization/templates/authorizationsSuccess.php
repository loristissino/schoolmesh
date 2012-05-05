<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    '@organization'=>__('Organization'),
    '_schoolmesh'=>'SchoolMesh',
  ),
  'current'=>__('Authorizations'),
  'title'=>'SchoolMesh'
  ))
?>

<div class="sf_admin_list">

<h2><?php echo __('Authorizations') ?></h2>

<table cellspacing="0">
  <thead>
    <tr>
      <th class="sf_admin_text"><?php echo __('Name') ?></th>
      <th class="sf_admin_text"><?php echo __('Description') ?></th>
      <th class="sf_admin_text"><?php echo __('Users') ?></th>
      <th class="sf_admin_text"><?php echo __('GuardGroups') ?></th>
      <th class="sf_admin_text"><?php echo __('Actions') ?></th>
    </tr>
  </thead>
  <tbody>
	<?php $i=0 ?>
  <?php foreach($credentials as $credential): ?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
      <th><?php echo $credential->getName() ?></th>
      <td><?php echo $credential->getDescription() ?></td>
      <td><?php include_partial('userpermissions', array('userpermissions'=>GuardSecurity::getsfGuardUserPermissions($credential->getRawValue()), 'credential'=>$credential, 'all'=>false)) ?></td>
      <td><?php include_partial('grouppermissions', array('grouppermissions'=>$credential->getsfGuardGroupPermissions())) ?></td>
      <td><ul class="sf_admin_td_actions"><?php echo li_link_to_if('td_action_users', $sf_user->hasCredential('users'), __('Find'), url_for('users/list?query=permissions:'.$credential->getName(). ' and active:true'), array('title'=>__('Find all active users that are granted this credential (individually or inherited)'))) ?></ul></td>
    </tr>
  <?php endforeach ?>
  </tbody>
</table>
