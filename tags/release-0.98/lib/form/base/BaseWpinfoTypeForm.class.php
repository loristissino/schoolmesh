<?php

/**
 * WpinfoType form base class.
 *
 * @method WpinfoType getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseWpinfoTypeForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'              => new sfWidgetFormInputHidden(),
      'title'           => new sfWidgetFormInputText(),
      'description'     => new sfWidgetFormInputText(),
      'rank'            => new sfWidgetFormInputText(),
      'state'           => new sfWidgetFormInputText(),
      'template'        => new sfWidgetFormTextarea(),
      'example'         => new sfWidgetFormTextarea(),
      'is_required'     => new sfWidgetFormInputCheckbox(),
      'is_confidential' => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'              => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'title'           => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'description'     => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'rank'            => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'state'           => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647, 'required' => false)),
      'template'        => new sfValidatorString(array('required' => false)),
      'example'         => new sfValidatorString(array('required' => false)),
      'is_required'     => new sfValidatorBoolean(array('required' => false)),
      'is_confidential' => new sfValidatorBoolean(array('required' => false)),
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