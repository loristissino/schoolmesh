<?php if(sizeof($grouppermissions)): ?>
<ul class="simple_list">
<?php foreach($grouppermissions as $grouppermission): $group=sfGuardGroupPeer::retrieveByPK($grouppermission->getGroupId()) ?>
  <li><?php echo link_to_if($sf_user->hasCredential('users'), $group->getName(), url_for('users/list?query=guardgroups:'.$group->getName(). ' and active:true')) ?></li>
<?php endforeach ?>
</ul>
<?php endif ?>
