<?php

/**
 * Role filter form base class.
 *
 * @package    schoolmesh
 * @subpackage filter
 * @author     Your name here
 */
abstract class BaseRoleFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'male_description'   => new sfWidgetFormFilterInput(),
      'female_description' => new sfWidgetFormFilterInput(),
      'quality_code'       => new sfWidgetFormFilterInput(),
      'posix_name'         => new sfWidgetFormFilterInput(),
      'may_be_main_role'   => new sfWidgetFormChoice(array('choices' => array('' => 'yes or no', 1 => 'yes', 0 => 'no'))),
      'default_guardgroup' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'male_description'   => new sfValidatorPass(array('required' => false)),
      'female_description' => new sfValidatorPass(array('required' => false)),
      'quality_code'       => new sfValidatorPass(array('required' => false)),
      'posix_name'         => new sfValidatorPass(array('required' => false)),
      'may_be_main_role'   => new sfValidatorChoice(array('required' => false, 'choices' => array('', 1, 0))),
      'default_guardgroup' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('role_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Role';
  }

  public function getFields()
  {
    return array(
      'id'                 => 'Number',
      'male_description'   => 'Text',
      'female_description' => 'Text',
      'quality_code'       => 'Text',
      'posix_name'         => 'Text',
      'may_be_main_role'   => 'Boolean',
      'default_guardgroup' => 'Text',
    );
  }
}