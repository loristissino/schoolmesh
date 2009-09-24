<?php

/**
 * Role form base class.
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 12815 2008-11-09 10:43:58Z fabien $
 */
class BaseRoleForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'male_description'   => new sfWidgetFormInput(),
      'female_description' => new sfWidgetFormInput(),
      'quality_code'       => new sfWidgetFormInput(),
      'posix_name'         => new sfWidgetFormInput(),
      'may_be_main_role'   => new sfWidgetFormInputCheckbox(),
      'default_guardgroup' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorPropelChoice(array('model' => 'Role', 'column' => 'id', 'required' => false)),
      'male_description'   => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'female_description' => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'quality_code'       => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'posix_name'         => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'may_be_main_role'   => new sfValidatorBoolean(array('required' => false)),
      'default_guardgroup' => new sfValidatorString(array('max_length' => 20, 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('role[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Role';
  }


}