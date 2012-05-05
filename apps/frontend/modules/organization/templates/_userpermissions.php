<?php if(sizeof($userpermissions)): $count=0; $andmore=false?>
<ul class="simple_list">
<?php foreach($userpermissions as $userpermission): $profile=sfGuardUserProfilePeer::retrieveByPK($userpermission->getUserId())?>
  <li><?php $count++; echo link_to_if($sf_user->hasCredential('users'), $profile, url_for('users/edit?id='.$profile->getUserId())) ?></li>
  <?php if(!$all && $count>=sfConfig::get('app_config_authorizations_max_users_per_page', 5)): ?>
    <?php $andmore=true ?>
    <?php break ?>
  <?php endif ?>
<?php endforeach ?>
</ul>
<?php if($andmore): $diff=sizeof($userpermissions)-$count+1 ?>
<em><?php echo link_to(format_number_choice('[1]... and one more|[1,+Inf]... and %number% more', array('%number%'=>$diff), $diff), url_for('organization/credential?id='. $credential->getId())) ?></em>
<?php endif ?>
<?php endif ?>
