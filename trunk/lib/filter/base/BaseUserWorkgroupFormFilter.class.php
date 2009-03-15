<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * UserWorkgroup filter form base class.
 *
 * @package   schoolmesh
 * @subpackage filter
 * @author     Loris Tissino
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 13459 2008-11-28 14:48:12Z fabien $
 */
class BaseUserWorkgroupFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'      => new sfWidgetFormPropelChoice(array('model' => 'sfGuardUser', 'add_empty' => true)),
      'workgroup_id' => new sfWidgetFormPropelChoice(array('model' => 'Workgroup', 'add_empty' => true)),
      'role_id'      => new sfWidgetFormPropelChoice(array('model' => 'Role', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'user_id'      => new sfValidatorPropelChoice(array('required' => false, 'model' => 'sfGuardUser', 'column' => 'id')),
      'workgroup_id' => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Workgroup', 'column' => 'id')),
      'role_id'      => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Role', 'column' => 'id')),
    ));

    $this->widgetSchema->setNameFormat('user_workgroup_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'UserWorkgroup';
  }

  public function getFields()
  {
    return array(
      'id'           => 'Number',
      'user_id'      => 'ForeignKey',
      'workgroup_id' => 'ForeignKey',
      'role_id'      => 'ForeignKey',
    );
  }
}
