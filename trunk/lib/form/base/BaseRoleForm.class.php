<?php

/**
 * Role form base class.
 *
 * @method Role getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BaseRoleForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'male_description'    => new sfWidgetFormInputText(),
      'female_description'  => new sfWidgetFormInputText(),
      'quality_code'        => new sfWidgetFormInputText(),
      'posix_name'          => new sfWidgetFormInputText(),
      'may_be_main_role'    => new sfWidgetFormInputCheckbox(),
      'needs_charge_letter' => new sfWidgetFormInputCheckbox(),
      'default_guardgroup'  => new sfWidgetFormInputText(),
      'rank'                => new sfWidgetFormInputText(),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'male_description'    => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'female_description'  => new sfValidatorString(array('max_length' => 100, 'required' => false)),
      'quality_code'        => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'posix_name'          => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'may_be_main_role'    => new sfValidatorBoolean(array('required' => false)),
      'needs_charge_letter' => new sfValidatorBoolean(array('required' => false)),
      'default_guardgroup'  => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'rank'                => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
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
