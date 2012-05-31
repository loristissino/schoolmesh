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
      'is_key'              => new sfWidgetFormInputCheckbox(),
      'default_guardgroup'  => new sfWidgetFormInputText(),
      'min'                 => new sfWidgetFormInputText(),
      'max'                 => new sfWidgetFormInputText(),
      'forfait_retribution' => new sfWidgetFormInputText(),
      'charge_notes'        => new sfWidgetFormTextarea(),
      'confirmation_notes'  => new sfWidgetFormTextarea(),
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
      'is_key'              => new sfValidatorBoolean(array('required' => false)),
      'default_guardgroup'  => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'min'                 => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'max'                 => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'forfait_retribution' => new sfValidatorNumber(array('required' => false)),
      'charge_notes'        => new sfValidatorString(array('required' => false)),
      'confirmation_notes'  => new sfValidatorString(array('required' => false)),
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
