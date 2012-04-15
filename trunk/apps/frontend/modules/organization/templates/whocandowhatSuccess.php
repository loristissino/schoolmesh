<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    '@organization'=>__('Organization'),
    '_schoolmesh'=>'SchoolMesh',
  ),
  'current'=>__('«Who can do what» matrix'),
  'title'=>'SchoolMesh'
  ))
?>

<div class="sf_admin_list">

<h2><?php echo __('«Who can do what» matrix') ?></h2>

<table cellspacing="0">
  <thead>
    <tr>
      <th class="sf_admin_text"><?php echo __('Name') ?></th>
      <th class="sf_admin_text"><?php echo __('Description') ?></th>
      <th class="sf_admin_text"><?php echo __('Users') ?></th>
      <th class="sf_admin_text"><?php echo __('GuardGroups') ?></th>
    </tr>
  </thead>
  <tbody>
	<?php $i=0 ?>
  <?php foreach($credentials as $credential): ?>
    <tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
      <th><?php echo link_to_if($sf_user->hasCredential('users'), $credential->getName(), url_for('users/list?query=permissions:'.$credential->getName())) ?></th>
      <td><?php echo $credential->getDescription() ?></td>
      <td><?php include_partial('userpermissions', array('userpermissions'=>$credential->getsfGuardUserPermissions())) ?></td>
      <td><?php include_partial('grouppermissions', array('grouppermissions'=>$credential->getsfGuardGroupPermissions())) ?></td>
    </tr>
  <?php endforeach ?>
  </tbody>
</table>
