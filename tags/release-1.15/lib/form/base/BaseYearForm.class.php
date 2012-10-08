<?php

/**
 * Year form base class.
 *
 * @method Year getObject() Returns the current form's model object
 *
 * @package    schoolmesh
 * @subpackage form
 * @author     Loris Tissino <loris.tissino@gmail.com>
 */
abstract class BaseYearForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'description' => new sfWidgetFormInputText(),
      'start_date'  => new sfWidgetFormDate(),
      'end_date'    => new sfWidgetFormDate(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorChoice(array('choices' => array($this->getObject()->getId()), 'empty_value' => $this->getObject()->getId(), 'required' => false)),
      'description' => new sfValidatorString(array('max_length' => 7, 'required' => false)),
      'start_date'  => new sfValidatorDate(array('required' => false)),
      'end_date'    => new sfValidatorDate(array('required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'Year', 'column' => array('description')))
    );

    $this->widgetSchema->setNameFormat('year[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Year';
  }


}
