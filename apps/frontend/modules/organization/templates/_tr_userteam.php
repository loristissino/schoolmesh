<tr class="sf_admin_row <?php echo (++$i & 1)? 'odd':'even' ?>">
  <td>
    <?php echo link_to_if($sf_user->hasCredential('admin'), $role->getRoleDescriptionByGender($component->getSfGuardUser()->getProfile()->getIsMale()), url_for('roles/edit?id='.$role->getId()), array('title'=>__('Edit the role «%description%»', array('%description%'=>$role->getMaleDescription()))))
    ?>
    <?php include_partial('roles/minmaxcheck', array('Role'=>$role, 'number'=>$number)) ?>
  </td>
  <td><?php echo $role->getQualityCode() ?></td>
  <td<?php if(!$component->getsfGuardUser()->getIsActive()): ?> class="notcurrent"<?php endif ?>>
     <?php echo link_to_if($sf_user->hasCredential('admin'), $component->getSfGuardUser()->getProfile()->getFullname(), url_for('users/edit?id=' . $component->getSfGuardUser()->getId()))?></td>
  <td style="text-align: right"><?php include_partial('content/expiry', array('date'=>$component->getExpiry('U'))) ?></td>
  <?php if($sf_user->hasCredential('teams')): ?>
    <td><?php echo $component->getChargeReferenceNumber() ?></td>
    <td><?php echo $component->getConfirmationReferenceNumber() ?></td>
    <td><?php echo link_to_if($sf_user->hasCredential('teams'), $component->getTeam(), url_for('teams/show?id=' . $component->getTeam()->getId())) ?></td>
  <?php endif ?>
  
</tr>
