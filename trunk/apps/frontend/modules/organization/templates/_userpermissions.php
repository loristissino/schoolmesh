<?php if(sizeof($userpermissions)): ?>
<ul>
<?php foreach($userpermissions as $userpermission): $profile=sfGuardUserProfilePeer::retrieveByPK($userpermission->getUserId())?>
  <li><?php echo link_to_if($sf_user->hasCredential('users'), $profile, url_for('users/edit?id='.$profile->getUserId())) ?></li>
<?php endforeach ?>
</ul>
<?php endif ?>
