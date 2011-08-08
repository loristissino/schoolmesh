<?php

/**
 * Term form base class.
 *
 * @method Term getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Your name here
 */
abstract class BaseTermForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                    => new sfWidgetFormInputHidden(),
      'description'           => new sfWidgetFormInputText(),
      'end_day'               => new sfWidgetFormInputText(),
      'has_formal_evaluation' => new sfWidgetFormInputCheckbox(),
    ));

    $this->setValidators(array(
      'id'                    => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'description'           => new sfValidatorString(array('max_length' => 100)),
      'end_day'               => new sfValidatorInteger(array('min' => -2147483648, 'max' => 2147483647)),
      'has_formal_evaluation' => new sfValidatorBoolean(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('term[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Term';
  }


}
