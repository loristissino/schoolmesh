<?php

/**
 * AppointmentType form base class.
 *
 * @method AppointmentType getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BaseAppointmentTypeForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'description' => new sfWidgetFormInputText(),
      'shortcut'    => new sfWidgetFormInputText(),
      'rank'        => new sfWidgetFormInputText(),
      'is_active'   => new sfWidgetFormInputCheckbox(),
      'has_info'    => new sfWidgetFormInputCheckbox(),
      'has_modules' => new sfWidgetFormInputCheckbox(),
      'has_tools'   => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'description' => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'shortcut'    => new sfValidatorString(array('max_length' => 10, 'required' => false)),
      'rank'        => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'is_active'   => new sfValidatorBoolean(array('required' => false)),
      'has_info'    => new sfValidatorBoolean(array('required' => false)),
      'has_modules' => new sfValidatorBoolean(array('required' => false)),
      'has_tools'   => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('appointment_type[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'AppointmentType';
  }


}
