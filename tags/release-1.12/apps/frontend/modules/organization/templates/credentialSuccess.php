<?php include_partial('content/breadcrumps', array(
  'breadcrumps'=>array(
    '@organization'=>__('Organization'),
    '_schoolmesh'=>'SchoolMesh',
    'organization/authorizations' => __('Authorizations'),
  ),
  'current'=>__('Credential «%name%»', array('%name%'=>$credential->getName())),
  ))
?>

<p><?php echo __('The following users have been individually granted this credential:') ?></p>

<?php include_partial('userpermissions', array('userpermissions'=>GuardSecurity::getsfGuardUserPermissions($credential->getRawValue()), 'credential'=>$credential, 'all'=>true)) ?>

