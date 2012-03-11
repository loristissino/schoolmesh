<?php

/**
 * WpinfoType form base class.
 *
 * @method WpinfoType getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BaseWpinfoTypeForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                  => new sfWidgetFormInputHidden(),
      'title'               => new sfWidgetFormInputText(),
      'description'         => new sfWidgetFormInputText(),
      'rank'                => new sfWidgetFormInputText(),
      'code'                => new sfWidgetFormInputText(),
      'state_min'           => new sfWidgetFormInputText(),
      'state_max'           => new sfWidgetFormInputText(),
      'template'            => new sfWidgetFormTextarea(),
      'example'             => new sfWidgetFormTextarea(),
      'is_required'         => new sfWidgetFormInputCheckbox(),
      'is_confidential'     => new sfWidgetFormInputCheckbox(),
      'grade_min'           => new sfWidgetFormInputText(),
      'grade_max'           => new sfWidgetFormInputText(),
      'appointment_type_id' => new sfWidgetFormPropelChoice(array('model' => 'AppointmentType', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'id'                  => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'title'               => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'description'         => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'rank'                => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'code'                => new sfValidatorString(array('max_length' => 30, 'required' => false)),
      'state_min'           => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'state_max'           => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'template'            => new sfValidatorString(array('required' => false)),
      'example'             => new sfValidatorString(array('required' => false)),
      'is_required'         => new sfValidatorBoolean(array('required' => false)),
      'is_confidential'     => new sfValidatorBoolean(array('required' => false)),
      'grade_min'           => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'grade_max'           => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'appointment_type_id' => new sfValidatorPropelChoice(array('model' => 'AppointmentType', 'column' => 'id', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('wpinfo_type[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'WpinfoType';
  }


}
